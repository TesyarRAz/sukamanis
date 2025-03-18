@extends('layouts.app')

@section('title', $produk->nama_produk)

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk Unggulan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
        </ol>
    </nav>
</div>

<div class="container bg-white p-5 shadow-sm mt-3 mb-5 rounded">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $produk->nama_produk }}</h1>
            <h4 class="text-danger">Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}</h4>
            <p>{{ $produk->deskripsi_produk }}</p>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
