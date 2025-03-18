@extends('layouts.app')

@section('title', 'Struktur Pemerintahan Desa')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Struktur Desa</li>
        </ol>
    </nav>
</div>
<div class="container bg-white p-5 shadow-sm mt-3 mb-5 rounded">
    <img src="assets/gambar/struktur.jpg" alt="Struktur Organisasi" width="100%">
</div>
@endsection