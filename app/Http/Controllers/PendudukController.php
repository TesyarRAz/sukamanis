<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class PendudukController extends Controller
{
    public function formUpload()
    {
        return view('penduduk.upload');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,txt',
        ]);

        // Ambil file CSV
        $file = $request->file('csv');
        $csvData = file($file->getRealPath()); // langsung baca isi file

        $header = str_getcsv(array_shift($csvData)); // ambil baris pertama sebagai header

        foreach ($csvData as $line) {
            $row = str_getcsv($line);
            $data = array_combine($header, $row);

            // Simpan ke database
            Penduduk::updateOrCreate(
                ['nik' => $data['nik']], 
                [
                    'nkk' => $data['nkk'],
                    'nama' => $data['nama'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'alamat' => $data['alamat'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'rt' => $data['rt'],
                    'rw' => $data['rw'],
                    'pekerjaan' => $data['pekerjaan'] ?? null,
                    'kk' => $data['kk'] ?? null,
                    'ktp' => $data['ktp'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data penduduk berhasil diimport!');
    }
}
