@extends('layouts.app')

@section('title', 'Peta Desa')

@section('content')
<section class="bg-white vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('postRegistrasi') }}">
                    @csrf
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">REGISTRASI</p>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label">NIK</label>
                        <input value="{{ old('nik') }}" name="nik" type="text" class="form-control form-control-lg @error('nik') is-invalid @enderror" placeholder="Masukan nomor NIK anda" required />
                        @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label">Nama</label>
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Masukan nama anda" required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label">Email address</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Masukan email address anda" required />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <label class="form-label" >Password</label>
                        <input name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Masukan password" required />
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input name="password_confirmation" type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Masukan password" required />
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-success">Registrasi</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>
@endsection