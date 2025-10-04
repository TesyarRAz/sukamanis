<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\Surat;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    function surat(Request $request)
    {
        $data = $request->user()->pengajuans()->with([
            'signSurats' => fn($query) => $query->latest()->take(1),
        ])->latest()->cursorPaginate(10);

        return view('layanan.surat', compact('data'));
    }

    function surat1()
    {
        return view('layanan.suratktm1');
    }

    function surat2()
    {
        return view('layanan.suratktm2');
    }

    function surat3()
    {
        return view('layanan.suratnama');
    }

    function surat4()
    {
        return view('layanan.suratsurvei');
    }

    function surat5()
    {
        return view('layanan.suratusaha');
    }

    function surat6()
    {
        return view('layanan.suratkematian'); // Ganti nama view sesuai kebutuhan
    }

    function surat7()
    {
        return view('layanan.suratpenguburan'); // Ganti nama view sesuai kebutuhan
    }
    function surat8()
    {
        return view('layanan.suratdomisili'); // Ganti nama view sesuai kebutuhan
    }
    function surat9()
    {
        return view('layanan.suratkelahiran'); // Ganti nama view sesuai kebutuhan
    }

    public function postSurat(Request $request, Surat $surat)
    {
        $input_format = collect($surat->input_format);
        $rules = $input_format->where('type', 'form')->flatMap(fn($e) => [
            $e['data']['key'] => $e['data']['rules'],
        ]);

        $values = $request->validate($rules->toArray());

        $forms = collect($values)->flatMap(fn($v, $k) => [
            $k => $v,

            
        ]);

        $surat->pengajuans()->create([
            'user_id' => auth()->id(),
            'status' => 'requested',
            'data' => $forms,
            'tanggal_pengajuan' => now(), // Tambahkan ini

        ]);

        alert('Informasi', 'Berhasil membuat pengajuan', 'success');

        return to_route('surat');
    }
}
