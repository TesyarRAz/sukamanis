<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Carousel; // <-- tambahkan ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::query()->latest()->limit(4)->get();
        $galleries = Gallery::query()->latest()->get();
        $aparaturs = Aparatur::query()->latest()->get();
        $carousels = Carousel::query()->latest()->get(); // ambil data carousel

        return view('index', compact('beritas', 'galleries', 'aparaturs', 'carousels'));
    }
}
