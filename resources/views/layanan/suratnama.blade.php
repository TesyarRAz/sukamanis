@extends('layouts.app')

@section('title', 'Surat Beda Nama')

@section('content')
<div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
    <h2 class="text-center mt-3">SURAT BEDA NAMA</h2>
    <h6 class="text-center text-muted">(Untuk Melengkapi Persyaratan Administrasi)</h6>
    <hr />
    <form class="row g-3 justify-content-center mt-4" method="POST" action="{{ route('surat.store', 'surat-beda-nama') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="col-md-8">
            <label class="form-label">Nama</label>
            <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Tempat Lahir</label>
            <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" required>
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-4">
            <label class="form-label">Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
            @error('tanggal_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-8">
            <label class="form-label">NIK</label>
            <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" required>
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-4">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="l" selected>Laki-laki</option>
                <option value="p">Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Agama</label>
            <input name="agama" type="text" class="form-control @error('agama') is-invalid @enderror" required>
            @error('agama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Pekerjaan</label>
            <input name="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror">
            @error('pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <p class="text-center text-muted mt-4">(Dalam.................................................................) </p>
            <hr />
        
        <div class="col-md-8">
            <label class="form-label">Nama1</label>
            <input name="nama1" type="text" class="form-control @error('nama1') is-invalid @enderror" required>
            @error('nama1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Tempat Lahir</label>
            <input name="tempat_lahir1" type="text" class="form-control @error('tempat_lahir1') is-invalid @enderror" required>
            @error('tempat_lahir1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-4">
            <label class="form-label">Tanggal Lahir</label>
            <input name="tanggal_lahir1" type="date" class="form-control @error('tanggal_lahir1') is-invalid @enderror" required>
            @error('tanggal_lahir1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-8">
            <label class="form-label">NIK</label>
            <input name="nik1" type="text" class="form-control @error('nik1') is-invalid @enderror" required>
            @error('nik1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-4">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin1" class="form-select @error('jenis_kelamin1') is-invalid @enderror" required>
                <option value="l" selected>Laki-laki</option>
                <option value="p">Perempuan</option>
            </select>
            @error('jenis_kelamin1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Agama</label>
            <input name="agama1" type="text" class="form-control @error('agama1') is-invalid @enderror" required>
            @error('agama1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Pekerjaan</label>
            <input name="pekerjaan1" type="text" class="form-control @error('pekerjaan1') is-invalid @enderror">
            @error('pekerjaan1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-8">
            <label class="form-label">Alamat</label>
            <textarea name="alamat1" class="form-control @error('alamat1') is-invalid @enderror"></textarea>
            @error('alamat1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Tanggal Pengajuan</label>
            <input name="tanggal_pengajuan" type="text" class="form-control @error('tanggal_pengajuan') is-invalid @enderror">
            @error('tanggal_pengajuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        <div class="col-md-8 text-center">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
