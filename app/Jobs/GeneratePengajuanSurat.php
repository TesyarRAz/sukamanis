<?php

namespace App\Jobs;

use App\Models\PengajuanSurat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use NcJoes\OfficeConverter\OfficeConverter;

class GeneratePengajuanSurat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $id,
        public string $outputFormat = 'pdf'
    ) {}

    public function handle(): void
    {
        $pengajuanSurat = PengajuanSurat::find($this->id);

        if (!$pengajuanSurat) {
            Log::error("PengajuanSurat dengan ID {$this->id} tidak ditemukan.");
            return;
        }

        $surat = $pengajuanSurat->surat;
        if (!$surat) {
            Log::error("Surat terkait tidak ditemukan.");
            return;
        }

        $templatePath = $surat->getFirstMediaPath('file');
        if (!$templatePath || !file_exists($templatePath)) {
            Log::error("File template tidak ditemukan di: {$templatePath}");
            return;
        }

        Log::info("Menggunakan template: {$templatePath}");

        $forms = collect($pengajuanSurat->data + [
            'nomor' => $pengajuanSurat->nomor,
            'verified_at' => ($pengajuanSurat->verified_at ?? now())->format('d-m-Y'),
        ]);

        $value_format = collect($surat->value_format);

        $forms = $forms->flatMap(function ($v, $k) use ($value_format) {
            if (isset($value_format[$k])) {
                [$dirt, $between] = $this->string_between_two_string($value_format[$k], '${', '}');

                if (filled($dirt)) {
                    $ext = explode(':', $between);
                    $type = 'text';
                    $valFn = fn($val) => $val;

                    if (count($ext) >= 3) {
                        [$attr, $type, $val] = $ext;
                    } elseif (count($ext) === 2) {
                        [$attr, $val] = $ext;
                    } else {
                        $attr = $ext[0];
                        $val = null;
                    }

                    switch ($type) {
                        case "enum":
                            $val = explode('|', $val);
                            $val = collect($val)->flatMap(fn($v) => explode('=', $v))->toArray();
                            $valFn = fn($e) => $val[$e] ?? $e;
                            break;
                        case "date":
                            $valFn = fn($e) => Date::parse($e)->format($val);
                            break;
                    }

                    $v = $valFn($v);
                    return [$k => str($value_format[$k])->replace($dirt, $v)->toString()];
                }
            }

            return [$k => $v];
        });

        try {
            $template = new TemplateProcessor($templatePath);
            $template->setValues($forms->toArray());

            $dir = "surat/pengajuan/{$surat->id}";
            Storage::disk('public')->makeDirectory($dir);

            // ==== Simpan Word ====
            $baseFilename = str()->random(10);
            $docxFilename = $baseFilename . '.docx';
            $docxFilepath = storage_path("app/public/{$dir}/{$docxFilename}");
            $template->saveAs($docxFilepath);

            if (!file_exists($docxFilepath)) {
                Log::error("Gagal menyimpan file surat.");
                return;
            }
            Log::info("Surat berhasil disimpan: {$docxFilepath}");

            // ==== Convert ke PDF langsung via PhpWord ====
            if ($this->outputFormat === 'pdf' || $this->outputFormat === 'both') {
                // Set PDF renderer
                Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
                Settings::setPdfRendererPath(base_path('vendor/tecnickcom/tcpdf'));

                // $phpWord = IOFactory::load($docxFilepath);
                $pdfFilename = $baseFilename . '.pdf';
                $pdfDir = storage_path("app/public/{$dir}");
                $pdfFilepath = storage_path("app/public/{$dir}/{$pdfFilename}");

                // pastikan folder ada
                if (!file_exists($pdfDir)) {
                    mkdir($pdfDir, 0777, true);
                }

                $converter = new OfficeConverter($docxFilepath, $pdfDir);
                $converter->convertTo($pdfFilename);

                // $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                // $pdfWriter->save($pdfFilepath);

                if (file_exists($pdfFilepath)) {
                    Log::info("Surat berhasil dikonversi ke PDF: {$pdfFilepath}");
                    $pengajuanSurat->addMediaFromDisk("{$dir}/{$pdfFilename}", 'public')
                        ->toMediaCollection('cached_berkas');
                } else {
                    Log::error("Gagal mengonversi surat ke PDF.");
                }
            }

            // ==== Simpan Word ke media jika 'docx' atau 'both' ====
            if ($this->outputFormat === 'docx' || $this->outputFormat === 'both') {
                $pengajuanSurat->addMediaFromDisk("{$dir}/{$docxFilename}", 'public')
                    ->toMediaCollection('cached_berkas');
                Log::info("File Word berhasil disimpan ke media collection: {$docxFilename}");
            }

        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan saat membuat surat: " . $e->getMessage());
        }
    }

    private function string_between_two_string($str, $starting_word, $ending_word)
    {
        $substring_start = strpos($str, $starting_word);
        $ending_word_end = strpos($str, $ending_word) + strlen($ending_word);
        $dirt = substr($str, $substring_start, $ending_word_end);
        $substring_start += strlen($starting_word);
        $size = strpos($str, $ending_word, $substring_start) - $substring_start;
        $between = substr($str, $substring_start, $size);

        return [$dirt, $between];
    }
}

