<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new PendudukImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data penduduk berhasil diimport!');
    }
}

