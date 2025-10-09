    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- BOOTSTRAP ICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
            rel="stylesheet">
    </head>

    <nav class="navbar sticky-top navbar-expand-lg shadow-sm navbar-dark navbar-custom">
        <div class="container-sm"> <!-- lebih kecil dari container-md -->
            <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="/">
                <img src="{{ asset('assets/gambar/logo.png') }}" alt="Logo Desa" width="100" height="75"
                    class="me-2">
                <span style="color: #fefefe; font-weight: bold;">DESA SUKAMANIS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link hover-active" href="/">BERANDA</a>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle hover-active" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            PROFIL DESA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profil') }}">PROFIL DESA SUKAMANIS</a></li>
                            <li><a class="dropdown-item" href="{{ route('sejarah') }}">SEJARAH DESA SUKAMANIS</a></li>
                            <li><a class="dropdown-item" href="{{ route('peta') }}">PETA DESA SUKAMANIS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle hover-active" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            PEMERINTAHAN DESA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('visimisi') }}">VISI & MISI</a></li>
                            <li><a class="dropdown-item" href="{{ route('struktur') }}">STRUKTUR PEMERINTAHAN DESA</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle hover-active" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            INFORMASI DESA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('berita') }}">BERITA / WISATA DESA</a></li>
                            <li><a class="dropdown-item" href="{{ route('gambar') }}">AGENDA DESA</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.gambar') }}">PRODUK UNGGULAN DESA</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle hover-active" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            LAYANAN MANDIRI
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('surat') }}">PENGAJUAN SURAT</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat1') }}">SURAT KETERANGAN TIDAK MAMPU</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('surat2') }}">SURAT KEMATIAN</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat3') }}">SURAT BEDA NAMA</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat4') }}">SURAT BERITA ACARA/SURVEI</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('surat5') }}">SURAT USAHA</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat7') }}">SURAT PENGUBURAN</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat8') }}">SURAT DOMISILI</a></li>
                            <li><a class="dropdown-item" href="{{ route('surat9') }}">SURAT KELAHIRAN</a></li>


                        </ul>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle hover-active" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            LOGIN
                        </a>
                        <ul class="dropdown-menu">
                            @auth
                                @if (auth()->user()->hasRole('admin'))
                                    <li><a class="dropdown-item"
                                            href="{{ route('filament.admin.pages.dashboard') }}">DASHBOARD</a></li>
                                @else
                                    <li><a class="dropdown-item" onclick="document.querySelector('#btnLogout').click()"
                                            href="javascript:void(0)">LOGOUT SEBAGAI USER</a></li>
                                @endif

                                <form class="d-none" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" id="btnLogout"></button>
                                </form>
                            @else
                                <li><a class="dropdown-item" href="/admin">LOGIN SEBAGAI ADMIN</a></li>
                                <li><a class="dropdown-item" href="{{ route('login') }}">LOGIN SEBAGAI USER</a></li>
                            @endauth
                        </ul>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link hover-active" href="{{ route('kontak') }}">KONTAK</a>
                    </li>

                    </li>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mt-4 text-justify">
                    <b>PROFILE</b>
                    <hr />
                    <p class="text-white" style="text-align: justify;">
                        Desa Sukamanis merupakan salah satu desa di Kecamatan Kadudampit, Kabupaten Sukabumi, Jawa
                        Barat. Desa ini dikenal dengan keindahan alamnya yang masih asri, udara yang sejuk, serta
                        lokasinya yang dekat dengan Jembatan Situ Gunung dan Taman Nasional Gunung Gede Pangrango.
                        Keindahan alam serta ekosistem yang masih terjaga menjadikan desa ini sebagai salah satu tujuan
                        wisata alam yang menarik.
                        <a href="{{ route('profil') }}" class="btn btn-primary">
                            Selengkapnya
                        </a>


                    </p>
                </div>
                <div class="col-lg-4 mt-4 text-justify">
                    <b>MENU</b>
                    <hr />
                    <ul class="list-unstyled">
                        <li><a href="https://www.jabarprov.go.id/" class="text-white" target="_blank">Website
                                Provinsi Jabar</a></li>
                        <li><a href="https://sukabumikab.go.id/" class="text-white" target="_blank">Pemerintah Kab.
                                Sukabumi</a></li>
                        <li><a href="https://www.instagram.com/desa_sukamanis?igsh=MTdicWp0N3pudG0waw=="
                                class="text-white" target="_blank">Instagram Desa Sukamanis</a></li>
                        <li><a href="https://bpjs-kesehatan.go.id/#/"" class="text-white" target="_blank">Daftar
                                Kartu Indonesia Sehat</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mt-4">
                    <b>INFORMASI</b>
                    <hr />
                    <p><i class="bi bi-building-fill"></i> <a href="#" class="text-white">JL.Raya Cisarua Km.1
                            no.2 Kadudampit Kab Sukabumi Kode Pos 43153</a></p>
                    <p><i class="bi bi-telephone-fill"></i> 085863840858</p>
                    <p><i class="bi bi-envelope"></i> desasukamanis@gmail.com</p>
                    <li>
                        <a href="https://www.google.com/maps/place/Sukamanis,+Kec.+Kadudampit,+Kabupaten+Sukabumi,+Jawa+Barat/@-6.8438805,106.8762566,13z/data=!3m1!4b1!4m6!3m5!1s0x2e684a76cf528c55:0x75b654b8b25eb385!8m2!3d-6.8684985!4d106.9029352!16s%2Fg%2F122jkpq0?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D"
                            class="text-white" target="_blank">
                            <i class="bi bi-geo-alt-fill me-2"></i> Lokasi Desa Sukamanis
                        </a>
                    </li>

                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2025 Copyright: <a href="#" class="text-white">UBSI</a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @include('sweetalert::alert')
    <style type="text/css">
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .nav-link,
        .dropdown-item {
            font-size: 14px;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #000000;
        }

        .biru {
            background-color: #295004;
        }

        <style>.navbar-custom .container {
            max-width: 960px;
            /* bisa kamu kecilkan lagi, misalnya 900px */
        }

        .navbar-custom {
            background-color: #295004 !important;
            /* warna hijau tua */
        }

        .hover-show {
            transition: transform .2s;
        }

        .hover-show:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .roboto-medium {
            font-family: "Roboto", sans-serif;
            font-weight: 500;
        }

        .roboto-regular {
            font-family: "Roboto", sans-serif;
            font-weight: 400;
        }

        footer .text-secondary {
            color: #757575;
        }

        footer .text-warning {
            text-decoration: none;
        }

        footer .text-warning:hover {
            text-decoration: underline;
        }

        .navbar-custom .container {
            max-width: 1100px;
            /* atur sesuai kebutuhan, misalnya 800px / 700px */
        }
    </style>
    </body>

    </html>
