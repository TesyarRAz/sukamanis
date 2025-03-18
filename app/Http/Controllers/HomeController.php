<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::query()->latest()->limit(4)->get();
        $galleries = Gallery::query()->latest()->get();
        $aparaturs = Aparatur::query()->latest()->get();
        
        return view('index', compact('beritas', 'galleries', 'aparaturs'));
    }
}
