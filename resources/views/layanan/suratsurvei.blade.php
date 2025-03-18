@extends('layouts.app')

@section('title', 'Surat Berita Acara/Survei Lapangan')

@section('content')
<div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
    <h2 class="text-center mt-3">SURAT BERITA ACARA PEMERIKSAAN/SURVEI LAPANGAN</h2>
    <hr />
    <form class="row g-3 d-flex justify-content-center align-items-center mt-4" method="POST" action="{{ route('surat.store', 'survey') }}">
        @csrf
        <div class="col-md-8">
            <label class="form-label">Nama</label>
            <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Nomor KK (Kartu Keluarga)</label>
            <input name="no_kk" type="text" class="form-control @error('no_kk') is-invalid @enderror" required>
            @error('no_kk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Jenis Kelamin</label>
            <input name="jenis_kelamin" type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
            <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" required>
            @error('nik')
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
        <div class="col-md-2">
            <label class="form-label">Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
            @error('tanggal_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Pekerjaan</label>
            <input name="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" required>
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
        <p class="text-center text-muted mt-4">Tim/Petugas Survei</p>
        <div class="col-md-8">
            <label class="form-label">Nama Ketua RT</label>
            <input name="nama_ketua_rt" type="text" class="form-control @error('nama_ketua_rt') is-invalid @enderror" required>
            @error('nama_ketua_rt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Ketua RT</label>
            <input name="ketua_rt" type="text" class="form-control @error('ketua_rt') is-invalid @enderror" required>
            @error('ketua_rt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama Ketua RW</label>
            <input name="nama_ketua_rw" type="text" class="form-control @error('nama_ketua_rw') is-invalid @enderror" required>
            @error('nama_ketua_rw')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Ketua RW</label>
            <input name="ketua_rw" type="text" class="form-control @error('ketua_rw') is-invalid @enderror" required>
            @error('ketua_rw')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama Kader Posyandu</label>
            <input name="nama_kader_posyandu" type="text" class="form-control @error('nama_kader_posyandu') is-invalid @enderror" required>
            @error('nama_kader_posyandu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Kader Posyandu</label>
            <input name="kader_posyandu" type="text" class="form-control @error('kader_posyandu') is-invalid @enderror" required>
            @error('kader_posyandu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama Puskesos Desa</label>
            <input name="nama_puskesos_desa" type="text" class="form-control @error('nama_puskesos_desa') is-invalid @enderror" required>
            @error('nama_puskesos_desa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Puskesos Desa</label>
            <input name="puskesos_desa" type="text" class="form-control @error('puskesos_desa') is-invalid @enderror" required>
            @error('puskesos_desa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Tanggal Pengajuan</label>
            <input name="tanggal_pengajuan" type="text" class="form-control @error('tanggal_pengajuan') is-invalid @enderror">
            @error('tanggal_pengajuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8 text-center">
            <button class="btn btn-success" type="submit">Submit Form</button>
        </div>
    </form>
</div>
@endsection
