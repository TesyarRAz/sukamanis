<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showSejarah()
    {
        // Ambil data halaman berdasarkan slug
        $page = Page::where('slug', 'sejarah-desa')->first();

        // Jika halaman tidak ditemukan, tampilkan error 404
        if (!$page) {
            abort(404, 'Halaman tidak ditemukan');
        }

        // Kirim data ke view
        return view('pages.sejarah-desa', compact('page'));
    }
}

