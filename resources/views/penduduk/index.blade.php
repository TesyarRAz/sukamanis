<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="mb-4">📋 Data Penduduk</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Upload --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                @csrf
                <input type="file" name="file" class="form-control" required>
                <button type="submit" class="btn btn-primary">Upload CSV</button>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Penduduk --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Daftar Penduduk</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penduduks as $penduduk)
                            <tr>
                                <td>{{ $penduduk->nik }}</td>
                                <td>{{ $penduduk->nama }}</td>
                                <td>{{ $penduduk->alamat }}</td>
                                <td>{{ $penduduk->jenis_kelamin }}</td>
                                <td>{{ $penduduk->tanggal_lahir }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
