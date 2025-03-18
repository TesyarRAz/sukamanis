@extends('layouts.app')

@section('title', 'Surat Kelahiran')

@section('content')
<div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
    <h2 class="text-center mt-3">SURAT KETERANGAN KELAHIRAN</h2>
    <h6 class="text-center text-muted">(Untuk Melengkapi Persyaratan Administrasi)</h6>
    <hr />
    <form class="row g-3" method="POST" action="{{ route('surat.store', 'surat-kelahiran') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Hari</label>
                <input name="hari" type="text" class="form-control @error('hari') is-invalid @enderror" required>
                @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Tanggal</label>
                <input name="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" required>
                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Tempat Kelahiran</label>
                <input name="tempat_kelahiran" type="text" class="form-control @error('tempat_kelahiran') is-invalid @enderror" required>
                @error('tempat_kelahiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="l" selected>Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Anak Ke</label>
                <input name="anak_ke" type="text" class="form-control @error('anak_ke') is-invalid @enderror" required>
                @error('anak_ke')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Nama Anak</label>
                <input name="nama_anak" type="text" class="form-control @error('nama_anak') is-invalid @enderror" required>
                @error('nama_anak')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <p class="text-center text-muted mt-4">BIODATA IBU :</p>
        <hr />


        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Nama Lengkap Ibu</label>
                <input name="nama_lengkap_ibu" type="text" class="form-control @error('nama_lengkap_ibu') is-invalid @enderror" required>
                @error('nama_lengkap_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Umur Ibu</label>
                <input name="umur_ibu" type="text" class="form-control @error('umur_ibu') is-invalid @enderror" required>
                @error('umur_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Agama Ibu</label>
                <input name="agama_ibu" type="text" class="form-control @error('agama_ibu') is-invalid @enderror" required>
                @error('agama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Pekerjaan Ibu</label>
                <input name="pekerjaan_ibu" type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" required>
                @error('pekerjaan_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-12">
                <label class="form-label">Alamat Ibu</label>
                <textarea name="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror" required></textarea>
                @error('alamat_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <p class="text-center text-muted mt-4">BIODATA BAPAK :</p>
        <hr />
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Nama Lengkap bapak</label>
                <input name="nama_lengkap_bapak" type="text" class="form-control @error('nama_lengkap_bapak') is-invalid @enderror" required>
                @error('nama_lengkap_bapak')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Umur bapak</label>
                <input name="umur_bapak" type="text" class="form-control @error('umur_bapak') is-invalid @enderror" required>
                @error('umur_bapak')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">Agama bapak</label>
                <input name="agama_bapak" type="text" class="form-control @error('agama_bapak') is-invalid @enderror" required>
                @error('agama_bapak')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label class="form-label">Pekerjaan bapak</label>
                <input name="pekerjaan_bapak" type="text" class="form-control @error('pekerjaan_bapak') is-invalid @enderror" required>
                @error('pekerjaan_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-12">
                <label class="form-label">Alamat bapak</label>
                <textarea name="alamat_bapak" class="form-control @error('alamat_bapak') is-invalid @enderror" required></textarea>
                @error('alamat_bapak')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-8">
            <label class="form-label">Tanggal Pengajuan</label>
            <input name="tanggal_pengajuan" type="text" class="form-control @error('tanggal_pengajuan') is-invalid @enderror">
            @error('tanggal_pengajuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="row mb-3 text-center">
            <div class="col-sm-12">
                <button class="btn btn-success" type="submit">Submit Form</button>
            </div>
        </div>
    </form>
</div>
@endsection