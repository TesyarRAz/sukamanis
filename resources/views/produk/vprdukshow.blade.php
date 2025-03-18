@extends('layouts.app')

@section('title', $product->nama_produk)

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk Unggulan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->nama_produk }}</li>
        </ol>
    </nav>
</div>
<div class="container bg-white shadow-sm border-0 rounded mt-3 mb-5 p-4">
    <div class="row">
        <div class="col-md-6">
            {{-- Menampilkan gambar produk atau fallback ke gambar default --}}
            <img src="{{ asset('storage' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" width="200">
        </div>
        <div class="col-md-6">
            {{-- Menampilkan informasi produk --}}
            <h2>{{ $product->nama_produk }}</h2>
            <p class="text-muted">Harga: Rp{{ number_format($product->harga_produk, 0, ',', '.') }}</p>
            <p>{{ $product->deskripsi_produk }}</p>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali ke Daftar Produk</a>
        </div>
    </div>
</div>
@endsection
