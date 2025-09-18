    @extends('layouts.app')

    @section('title', 'Surat kematian')

    @section('content')
        <div class="container bg-white p-5 shadow mt-3 mb-5 rounded">
            <h2 class="text-center mt-3">SURAT KEMATIAN</h2>
            <h6 class="text-center text-muted">(Untuk Melengkapi Persyaratan Administrasi)</h6>
            <hr />
            <form class="row g-3" method="POST" action="{{ route('surat.store', 'surat-kematian') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="form-label">nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">nik</label>
                            <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">tempat lahir</label>
                                <input name="tempat_lahir" type="text"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror" required>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Tanggal lahir</label>
                                <input name="tanggal_lahir" type="date"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                required>
                                <option value="l" selected>Laki-laki</option>
                                <option value="p">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">pekerjaan</label>
                            <input name="pekerjaan" type="text"
                                class="form-control @error('pekerjaan') is-invalid @enderror" required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">alamat</label>
                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <p class="text-center text-muted mt-4">Telah meninggal dunia pada ::</p>
                    <hr />


                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">hari</label>
                            <input name="hari" type="text" class="form-control @error('hari') is-invalid @enderror"
                                required>
                            @error('hari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label">pada tanggal</label>
                            <input name="pada_tanggal" type="date"
                                class="form-control @error('pada_tanggal') is-invalid @enderror" required>
                            @error('pada_tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">bertempat di</label>
                            <input name="bertempat_di" type="text"
                                class="form-control @error('bertempat_di') is-invalid @enderror" required>
                            @error('bertempat_di')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">penyebab kematian</label>
                            <input name="penyebab_kematian" type="text"
                                class="form-control @error('penyebab_kematian') is-invalid @enderror" required>
                            @error('penyebab_kematian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <p class="text-center text-muted mt-4">BIODATA BAPAK :</p>
                <hr />
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="form-label">Nama pelapor</label>
                        <input name="nama_pelapor" type="text"
                            class="form-control @error('nama_pelapor') is-invalid @enderror" required>
                        @error('nama_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">nik pelapor</label>
                        <input name="nik_pelapor" type="text"
                            class="form-control @error('nik_pelapor') is-invalid @enderror" required>
                        @error('nik_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="form-label">tempat lahir pelapor</label>
                        <input name="tempat_lahir_pelapor" type="text"
                            class="form-control @error('tempat_lahir_pelapor') is-invalid @enderror" required>
                        @error('tempat_lahir_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">pada tanggal pelapor</label>
                        <input name="pada_tanggal_pelapor" type="date"
                            class="form-control @error('pada_tanggal_pelapor') is-invalid @enderror" required>
                        @error('pada_tanggal_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label class="form-label">pekerjaan</label>
                        <textarea name="pekerjaan_pelapor" class="form-control @error('pekerjaan_pelapor') is-invalid @enderror" required></textarea>
                        @error('pekerjaan_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">hubungan pelapor dengan yang meninggal</label>
                            <textarea name="hubungan_pelapor_dengan_yang_meninggal"
                                class="form-control @error('hubungan_pelapor_dengan_yang_meninggal') is-invalid @enderror" required></textarea>
                            @error('hubungan_pelapor_dengan_yang_meninggal')
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
