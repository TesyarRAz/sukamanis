@extends('layouts.app')

@section('title', 'Surat keterangan Usaha')

@section('content')
<div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
    <h2 class="text-center mt-3">SURAT KETERANGAN USAHA</h2>
    <hr />
    <form class="row g-2 d-flex justify-content-center align-items-center mt-4" method="POST" action="{{ route('surat.store', 'usaha') }}">
        @csrf
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" required>
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <label class="form-label">Nama</label>
                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-6">
                <label class="form-label">Tempat Lahir</label>
                <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" required>
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2">
                <label class="form-label">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-2">
                
            </div>
            <div class="col-sm-3">
                <label class="form-label">tahun</label>
                <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" required>
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <label class="form-label">Pekerjaan</label>
                <input name="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" required>
                @error('pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <label class="form-label">Jenis Usaha (Di bidang apa)</label>
                <textarea name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror"></textarea>
                @error('jenis_usaha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-8">
            <label class="form-label">Tanggal Pengajuan</label>
            <input name="tanggal_pengajuan" type="text" class="form-control @error('tanggal_pengajuan') is-invalid @enderror">
            @error('tanggal_pengajuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8">
                <button class="btn btn-success" type="submit">Submit form</button>
            </div>
        </div>
    </form>
</div>
@endsection