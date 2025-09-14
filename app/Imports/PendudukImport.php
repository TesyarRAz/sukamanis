
<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PendudukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info('Data yang diterima:', $row); // Debugging untuk melihat data dari file Excel

        return new Penduduk([
            'nkk'            => $row['nkk'] ?? null,
            'nik'            => $row['nik'] ?? null,
            'nama'           => $row['nama'] ?? null,
            'tempat_lahir'   => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'  => $this->convertDate($row['tanggal_lahir'] ?? null),
            'alamat'         => $row['alamat'] ?? null,
            'jenis_kelamin'  => $this->convertGender($row['jenis_kelamin'] ?? null),
            'rt'             => $row['rt'] ?? null,
            'rw'             => $row['rw'] ?? null,
            'pekerjaan'      => $row['pekerjaan'] ?? null,
        ]);
    }

    private function convertDate($date)
    {
        if (empty($date)) {
            return null; // Biarkan NULL jika tidak ada tanggal
        }

        // Jika format angka (Excel timestamp)
        if (is_numeric($date)) {
            return Date::excelToDateTimeObject($date)->format('Y-m-d');
        }

        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            try {
                return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
            } catch (\Exception $e) {
                try {
                    return Carbon::parse($date)->format('Y-m-d');
                } catch (\Exception $e) {
                    Log::error('Gagal mengonversi tanggal: ' . $date); // Logging untuk debugging
                    return null;
                }
            }
        }
    }

    private function convertGender($gender)
    {
        $gender = strtolower(trim($gender ?? ''));

        // Debugging untuk data gender yang tidak valid
        if (!in_array($gender, ['laki-laki', 'l', 'perempuan', 'p'])) {
            Log::error('Data gender tidak valid: ' . $gender);
            return null;
        }

        return ($gender === 'laki-laki' || $gender === 'l') ? 'L' : 'P';
    }
}
