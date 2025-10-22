<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    function berita()
    {
        $data = Berita::query()->latest()->paginate(10);

        return view('informasi.vberita', compact('data'));
    }

    function beritashow(Berita $berita)
    {
        return view('informasi.vberitashow', compact('berita'));
    }

    function gambar()
    {
        $data = Gallery::with('media')->get();

        return view('informasi.vgambar', compact('data'));
    }

    function gambarshow(Gallery $gambar)
    {
        return view('informasi.vgambarshow', compact('gambar'));
    }
}
