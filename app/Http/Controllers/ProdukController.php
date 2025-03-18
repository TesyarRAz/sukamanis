<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'gambar_produk' => 'required|image',
        ]);

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
        ]);

        if ($request->hasFile('gambar_produk')) {
            $produk->addMedia($request->file('gambar_produk'))->toMediaCollection('gambar');
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function vgambar()
    {
        $data = Produk::with('media')->get();

        return view('produk.vgambar', ['products' => $data]);
    }
}
