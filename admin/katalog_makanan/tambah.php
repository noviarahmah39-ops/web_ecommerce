<?php
session_start();
include '../../config/config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_makanan'];
    $harga = $_POST['harga'];
    
    // Proses Upload Gambar
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp_file, "../../assets/img/" . $nama_file);

    mysqli_query($conn, "INSERT INTO produk (nama_makanan, harga, gambar) VALUES ('$nama', '$harga', '$nama_file')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h4>Tambah Menu Baru</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3"><label>Nama Makanan</label><input type="text" name="nama_makanan" class="form-control" required></div>
                    <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
                    <div class="mb-3"><label>Foto Makanan</label><input type="file" name="gambar" class="form-control" required></div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan Menu</button>
                    <a href="index.php" class="btn btn-link w-100 text-secondary mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>