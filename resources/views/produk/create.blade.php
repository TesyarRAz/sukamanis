<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" required>
        </div>
        <div>
            <label for="harga_produk">Harga Produk:</label>
            <input type="number" id="harga_produk" name="harga_produk" required>
        </div>
        <div>
            <label for="deskripsi_produk">Deskripsi Produk:</label>
            <textarea id="deskripsi_produk" name="deskripsi_produk" required></textarea>
        </div>
        <div>
            <label for="gambar">Gambar Produk:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
