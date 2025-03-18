<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
</head>
<body>
    <h1>Data Penduduk</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload CSV</button>
    </form>
    

    <h2>Daftar Penduduk</h2>
    <table border="1">
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
        </tr>
        @foreach($penduduks as $penduduk)
        <tr>
            <td>{{ $penduduk->nik }}</td>
            <td>{{ $penduduk->nama }}</td>
            <td>{{ $penduduk->alamat }}</td>
            <td>{{ $penduduk->jenis_kelamin }}</td>
            <td>{{ $penduduk->tanggal_lahir }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
