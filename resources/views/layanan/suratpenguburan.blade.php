@extends('layouts.app')

@section('title', 'Surat Penguburan')

@section('content')
    <div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
        <h2 class="text-center mt-3">SURAT PENGUBURAN</h2>
        <h6 class="text-center text-muted">(Untuk Melengkapi Persyaratan Administrasi)</h6>
        <hr />
        <form class="row g-3 d-flex justify-content-center align-items-center mt-4" method="POST"
            action="{{ route('surat.store', 'surat-penguburan') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-sm-8">
                <label class="form-label">pada hari</label>
                <input name="pada_hari" type="text" class="form-control @error('pada_hari') is-invalid @enderror" required>
                @error('pada_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">tanggal</label>
                <input name="tanggal" type="text" class="form-control @error('tanggal') is-invalid @enderror" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">bulan</label>
                <input name="bulan" type="text" class="form-control @error('bulan') is-invalid @enderror" required>
                @error('bulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">tahun</label>
                <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" required>
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-8">
                <label class="form-label">Nama</label>
                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label class="form-label">Tempat Lahir</label>
                <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                    required>
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-2">
                <label class="form-label">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                    required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-8">
                <label class="form-label">NIK</label>
                <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" required>
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-8">
                <label class="form-label">Pekerjaan</label>
                <input name="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                    required>
                @error('pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-8">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="l" selected>Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-8">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required></textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">kampung</label>
                <textarea name="kampung" class="form-control @error('kampung') is-invalid @enderror" required></textarea>
                @error('kampung')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">RT</label>
                <textarea name="rt" class="form-control @error('rt') is-invalid @enderror" required></textarea>
                @error('rt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="col-sm-8">
                <label class="form-label">RW</label>
                <textarea name="rw" class="form-control @error('rw') is-invalid @enderror" required></textarea>
                @error('rw')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-success" type="submit">Submit Form</button>
            </div>
        </form>
    </div>
@endsection