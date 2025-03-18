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
<div class="container bg-white shadow-sm border-0 rounded mt-3 mb-5 p-4">
    <h4 class="border-bottom text-center pb-3 mt-5">PRODUK UNGGULAN</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mt-4 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card border-0 shadow-sm mb-3">
                <img src="{{ $item->getFirstMediaUrl('thumbnail') }}" class="img-fluid" alt="imgcard">

                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                    <p class="card-text text-muted">Harga: Rp{{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                    <p class="card-text">{{ $product->deskripsi_produk }}</p>
                    <a href="{{ route('produkshow', $product->slug) }}" class="btn btn-primary stretched-link">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach

        {{ $products->links() }}
    </div>
</div>
@endsection
