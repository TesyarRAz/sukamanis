<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <a href="{{ route('produk.create') }}">Tambah Produk</a>

    <table border="1">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->harga_produk }}</td>
                    <td>{{ $produk->deskripsi_produk }}</td>
                    <td>
                        <img src="{{ $produk->gambar_product() }}" alt="Gambar Produk" width="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
