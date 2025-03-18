@extends('layouts.app')

@section('title', 'Profile Desa')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita Desa</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $berita->title }}</li>
        </ol>
    </nav>
</div>
<div class="container bg-white p-5 shadow-sm rounded mt-3 mb-5" style="overflow: hidden;">
    <h3>{{ $berita->title }}</h3>
    <p class="text-muted"><i class="bi bi-person-fill"></i>{{ $berita->published_by }}, <i class="bi bi-calendar-check-fill"></i> {{ $berita->published_at->format('d-m-Y') }}</p>
    <div>
        <img src="{{ $berita->getFirstMediaUrl('thumbnail') }}" class="card-img-top" height="500" alt="imghighlight">
        {!! $berita->content !!}
    </div>
</div>
@endsection