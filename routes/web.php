<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PemerintahanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ItemController;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
Route::get('/peta', [ProfilController::class, 'peta'])->name('peta');
Route::get('/visimisi', [PemerintahanController::class, 'visimisi'])->name('visimisi');
Route::get('/struktur', [PemerintahanController::class, 'struktur'])->name('struktur');
Route::get('/berita', [InformasiController::class, 'berita'])->name('berita');
Route::get('/gambar', [InformasiController::class, 'gambar'])->name('gambar');
Route::get('/produk/gambar', [ProdukController::class, 'vgambar'])->name('produk.gambar');
Route::get('/berita/{berita:slug}', [InformasiController::class, 'beritashow'])->name('beritashow');
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');




// Auth
//Route::get('/login/admin', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->middleware('guest')->name('postLogin');
Route::get('/login/user', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'postRegistrasi'])->name('postRegistrasi');
Route::middleware('auth')->group(function () {
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




    
    Route::get('/surat', [LayananController::class, 'surat'])->name('surat');
    Route::get('/surat1', [LayananController::class, 'surat1'])->name('surat1');
    Route::get('/surat2', [LayananController::class, 'surat2'])->name('surat2');
    Route::get('/surat3', [LayananController::class, 'surat3'])->name('surat3');
    Route::get('/surat4', [LayananController::class, 'surat4'])->name('surat4');
    Route::get('/surat5', [LayananController::class, 'surat5'])->name('surat5');
    Route::get('/surat6', [LayananController::class, 'surat6'])->name('surat6');
    Route::get('/surat7', [LayananController::class, 'surat7'])->name('surat7');
    Route::get('/surat8', [LayananController::class, 'surat8'])->name('surat8');
    Route::get('/surat9', [LayananController::class, 'surat9'])->name('surat9');



    Route::get('/penduduk', [PendudukController::class, 'index']);
    Route::post('/penduduk/upload', [PendudukController::class, 'upload'])->name('penduduk.upload');
    Route::get('/penduduk/search', [PendudukController::class, 'search']);
    Route::delete('/items/{id}', [ItemController::class, 'deleteItem'])->name('items.delete');
    Route::get('/penduduk/getByNik', [PendudukController::class, 'getByNik'])->name('penduduk.getByNik');
    Route::post('/import-penduduk', [PendudukController::class, 'import'])->name('import.penduduk');


    Route::post('/surat/{surat:slug}', [LayananController::class, 'postSurat'])->name('surat.store');
});
