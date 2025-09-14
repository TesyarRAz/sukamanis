<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class WordToPdfController extends Controller
{
    public function convert()
    {
        // Path file Word (docx)
        $wordFile = storage_path('app/public/contoh.docx');

        // Cek apakah file ada
        if (!file_exists($wordFile)) {
            abort(404, "File Word tidak ditemukan di: {$wordFile}");
        }

        // Load Word document
        $phpWord = IOFactory::load($wordFile);

        // Konversi ke HTML sementara
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $htmlFile   = storage_path('app/public/temp.html');
        $htmlWriter->save($htmlFile);

        // Ambil konten HTML
        $htmlContent = file_get_contents($htmlFile);

        // Convert ke PDF pakai DomPDF
        $pdf = Pdf::loadHTML($htmlContent);

        // Download PDF
        return $pdf->download('hasil.pdf');
    }
}
