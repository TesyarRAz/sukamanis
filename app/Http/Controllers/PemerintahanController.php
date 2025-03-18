<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemerintahanController extends Controller
{
    function visimisi()
    {
        return view('pemerintahan.vvisimisi');
    }

    function struktur()
    {
        return view('pemerintahan.vstruktur');
    }
}
