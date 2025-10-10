@extends('layouts.app')

@section('title', 'Surat KTM')

@section('content')
    <div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
        <h2 class="text-center mt-3">SURAT KETERANGAN TIDAK MAMPU</h2>
        <h6 class="text-center text-muted">(Untuk Melengkapi Persyaratan Administrasi)</h6>
        <hr />
        <form class="row g-2 d-flex justify-content-center align-items-center mt-4" method="POST"
            action="{{ route('surat.store', 'surat-keterangan-tidak-mampu') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-md-center mb-3">
                <div class="col-sm-8">
                    <label class="form-label">NIK (nomor induk keluarga)</label>
                    <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-3">
                <div class="col-sm-8">
                    <label class="form-label">NKK (nomor kartu keluarga)</label>
                    <input name="nkk" type="text" class="form-control @error('nkk') is-invalid @enderror" required>
                    @error('nkk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-3">
                <div class="col-sm-8">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Tempat Lahir</label>
                    <input name="tempat_lahir" type="text"
                        class="form-control @error('tempat_lahir') is-invalid @enderror" required>
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="date"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-3">
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
                    <label class="form-label">Pekerjaan</label>
                    <input name="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                        required>
                    @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-3">
                <div class="col-sm-8">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-8" style="display: none">
                    <label class="form-label">Tanggal Pengajuan</label>
                    <input name="tanggal_pengajuan" type="text"
                        class="form-control @error('tanggal_pengajuan') is-invalid @enderror">
                    @error('tanggal_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-success" type="submit">Submit Form</button>
            </div>
        </form>
    </div>
@endsection
