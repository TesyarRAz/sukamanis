<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('vlogin');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'  => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->filled('remember')))
        {
            $request->session()->regenerate();

            if (auth()->user()->hasRole('admin'))
            {
                return to_route('filament.admin.pages.dashboard');
            }
            
            return to_route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function registrasi()
    {
        return view('vregistrasi');
    }

    public function postRegistrasi(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = User::query()->create($data);

        $user->assignRole('user');

        alert('Informasi', 'Berhasil mendaftar', 'success');

        return to_route('login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        

        return to_route('home');
    }
}
