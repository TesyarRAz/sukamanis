@extends('layouts.app')

@section('title', 'Berita Desa')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Berita Desa</li>
        </ol>
    </nav>
</div>
<div class="container bg-white shadow-sm border-0 rounded mt-3 mb-5 p-4">
    <h4 class="border-bottom text-center pb-3 mt-5">BERITA TERBARU</h4>
    <div class="row row-cols-1 row-cols-md-1 mt-4 g-4">
        @foreach ($data as $item)
        <div class="col">
            <div class="card border-0 shadow-sm mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $item->getFirstMediaUrl('thumbnail') }}" class="img-fluid" alt="imgcard">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text"><small class="text-muted"><i class="bi bi-person-check"></i> {{ $item->published_by }} </p>
                            <p class="card-text">{{ $item->headline }}<a href="{{ route('beritashow', $item->slug) }}" class="ms-1 stretched-link">Lihat Selengkapnya</a></p>
                            <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-check"></i> {{ $item->published_at->diffInDay(now()) > 7 ? $item->published_at->format('d-m-Y') : $item->published_at->diffForHumans(now())  }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{ $data->links() }}
    </div>
</div>
@endsection