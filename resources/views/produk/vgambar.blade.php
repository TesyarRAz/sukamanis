@extends('layouts.app')

@section('title', 'Produk Unggulan')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk Unggulan</li>
        </ol>
    </nav>
</div>
<div class="container bg-white p-5 shadow-sm mt-3 mb-5 rounded">
    <div class="row row-cols-1 row-cols-md-2 g-1 mt-2">
        @foreach ($products as $produk)
            <div>
                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" width="200">
                <h3>{{ $produk->nama_produk }}</h3>
                <p>Harga: {{ $produk->harga_produk }}</p>
                <p>Deskripsi: {{ $produk->deskripsi_produk }}</p>
                {{-- <img src="{{ $produk->getFirstMediaUrl('gambar') }}" alt="{{ $produk->nama_produk }}" width="200"> --}}
            </div>
        @endforeach
    </div>
</div>
<style>
    .location-title {
        font-size: 1.5em;
        font-weight: bold;
        text-decoration: none;
        z-index: 1;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity .5s;
        background: rgb(216, 216, 216, 0.4);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .location-listing:hover .location-title {
        opacity: 1;
    }

    .location-listing:hover .location-image img {
        filter: blur(2px);
    }


    /* for touch screen devices */
    @media (hover: none) {
        .location-title {
            opacity: 1;
        }

        .location-image img {
            filter: blur(2px);
        }
    }
</style>
@endsection
