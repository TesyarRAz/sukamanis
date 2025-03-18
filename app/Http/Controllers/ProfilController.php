<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profil()
    {
        $page = Page::firstWhere('name', 'profile');

        return view('profil.vprofil', compact('page'));
    }

    public function sejarah()
    {
        $page = Page::firstWhere('name', 'sejarah');

        return view('profil.vsejarah', compact('page'));
    }

    public function peta()
    {
        return view('profil.vpeta');
    }
}
