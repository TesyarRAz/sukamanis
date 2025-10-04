<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class SignDocumentController extends Controller
{
    public function index(Request $request)
    {
        $pengajuan_surat_id = $request->query('pengajuan_surat_id');
        $signature_code = str()->random(10);

        $pengajuanSurat = PengajuanSurat::findOrFail($request->pengajuan_surat_id);
        $fileUrl = $pengajuanSurat->getFirstMediaUrl('cached_berkas');

        return view('sign_document.index', compact('pengajuan_surat_id', 'signature_code', 'fileUrl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_surat_id' => 'required',
            'pdfFile' => 'required|mimes:pdf|max:20480', // Maksimal 20MB
            'signature_code' => 'required|string',
        ]);

        $pengajuanSurat = PengajuanSurat::findOrFail($request->pengajuan_surat_id);

        $pdfFile = $request->file('pdfFile');
        $filePath = $pdfFile->store('signatures', 'public');

        $pengajuanSurat->signSurats()->create([
            'name' => str()->random(10),
            'original_filename' => $pdfFile->getClientOriginalName(),
            'original_filepath' => $filePath,
            'signatured_filepath' => $filePath, // Sesuaikan jika ada file tanda tangan terpisah
            'signature_code' => $request->signature_code,
        ]);

        return response()->json([
            'redirect_url' => route('filament.admin.resources.pengajuan-surats.view', ['record' => $request->pengajuan_surat_id]),
        ]);
    }

    public function showSignedDocument($code)
    {
        $signedDocument = \App\Models\SignSurat::where('signature_code', $code)->firstOrFail();
        $fileUrl = asset('storage/' . $signedDocument->original_filepath);

        return response()->file(storage_path('app/public/' . $signedDocument->original_filepath));
    }
}
