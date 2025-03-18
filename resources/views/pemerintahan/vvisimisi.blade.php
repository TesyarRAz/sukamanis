@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Visi & Misi</li>
        </ol>
    </nav>
</div>
<div class="container bg-white p-5 shadow-sm mt-3 mb-5 rounded">
    <h2 class="text-center mt-3">VISI</h2>
    <p class="text-center">"Terwujudnya Desa Sukamanis yang Mandiri, Sejahtera, dan Berbudaya Berlandaskan Gotong Royong."</p>
    <h2 class="text-center mt-5">MISI</h2>
    <div class="row row-cols-1 row-cols-md-2 g-4 fs-5">
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="border rounded-end d-inline-block p-4 bg-primary text-white">1</h5>
                    <p class="border border-2 p-4">Mengembangkan sektor ekonomi melalui pemberdayaan masyarakat, peningkatan hasil pertanian, UMKM, dan produk unggulan desa.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="border rounded-end d-inline-block p-4 bg-primary text-white">2</h5>
                    <p class="border border-2 p-4">Mewujudkan sistem pelayanan desa yang transparan, cepat, dan akuntabel untuk memenuhi kebutuhan masyarakat.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="border rounded-end d-inline-block p-4 bg-primary text-white">3</h5>
                    <p class="border border-2 p-4">Memperbaiki dan membangun infrastruktur yang mendukung kesejahteraan masyarakat, seperti jalan, fasilitas umum, dan sarana pendidikan.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="border rounded-end d-inline-block p-4 bg-primary text-white">4</h5>
                    <p class="border border-2 p-4">Mengembangkan kegiatan yang menjaga budaya lokal agar tetap hidup dan diwariskan kepada generasi mendatang.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="border rounded-end d-inline-block p-4 bg-primary text-white">5</h5>
                    <p class="border border-2 p-4">Mewujudkan lingkungan desa yang bersih, hijau, dan sehat melalui program-program pelestarian lingkungan.app</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection