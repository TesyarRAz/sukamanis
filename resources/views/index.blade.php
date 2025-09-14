@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('title', 'Desa Sukamanis')

@section('content')

<!-- Hero Carousel -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $carousel->image) }}" 
                     class="d-block w-100 carousel-img" 
                     alt="Carousel Image">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- Section Template -->
<div class="container bg-white p-5 shadow rounded-4 my-5">
    <div class="section-title">
        <h5 class="fw-bold text-uppercase">Berita Desa</h5>
        <div class="title-divider"></div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
        @foreach ($beritas as $item)
        <div class="col">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden berita-card">
                <img src="{{ $item->getFirstMediaUrl('thumbnail') }}" class="card-img-top berita-img" alt="gambar berita">
                <div class="card-body">
                    <p class="fw-semibold">{{ $item->headline }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container bg-white p-5 shadow rounded-4 my-5">
    <div class="section-title">
        <h5 class="fw-bold text-uppercase">Agenda Desa</h5>
        <div class="title-divider"></div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @foreach ($galleries as $item)
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card">
                <img src="{{ $item->getFirstMediaUrl('gallery') }}" class="card-img-top" style="height:250px; object-fit:cover;" alt="gambar">
                <div class="card-body text-center">
                    <p class="fw-semibold m-0">{{ $item->name }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container bg-white p-5 shadow rounded-4 my-5">
    <div class="section-title">
        <h5 class="fw-bold text-uppercase">Aparatur Desa</h5>
        <div class="title-divider"></div>
    </div>
    <div class="row row-cols-2 row-cols-md-6 g-4 mt-3 text-center">
        @foreach ($aparaturs as $item)
        <div class="col">
            <div class="card border-0 shadow-sm p-3 rounded-4 aparatur-card">
                <img src="{{ $item->getFirstMediaUrl('photo') }}" class="rounded-circle mx-auto" style="width:100px; height:100px; object-fit:cover;" alt="gambar aparatur">
                <div class="card-body">
                    <p class="fw-bold mb-1">{{ $item->name }}</p>
                    <p class="text-muted small">{{ $item->jabatan }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

<style>
/* Section Title */
.section-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.title-divider {
    flex-grow: 1;
    height: 3px;
    border-radius: 5px;
    background-color: #295004;
}


/* Berita Card */
.berita-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.berita-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.berita-img {
    transition: transform 0.4s ease;
}
.berita-card:hover .berita-img {
    transform: scale(1.05);
}

/* Gallery Card */
.gallery-card {
    transition: transform 0.3s ease;
}
.gallery-card:hover {
    transform: scale(1.03);
}

/* Aparatur Card */
.aparatur-card {
    transition: transform 0.3s ease;
}
.aparatur-card:hover {
    background-color: #f9fafb;
    transform: translateY(-5px);
}
.carousel-img {
    max-height: 1000px;   /* atur sesuai keinginan */
    object-fit: contain; /* gambar utuh, tidak dipotong */
    background-color: #ffffff; /* kasih background biar rapi */
}


</style>
