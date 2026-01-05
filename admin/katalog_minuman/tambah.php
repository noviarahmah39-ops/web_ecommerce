<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_login'])) { header("Location: ../login.php"); exit; }

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_minuman'];
    $harga = $_POST['harga'];
    
    $nama_gambar = $_FILES['gambar_minuman']['name'];
    $tmp_name = $_FILES['gambar_minuman']['tmp_name'];
    
    // Upload ke folder assets/img
    move_uploaded_file($tmp_name, "../../assets/img/" . $nama_gambar);

    mysqli_query($conn, "INSERT INTO minuman (nama_minuman, gambar_minuman, harga) VALUES ('$nama', '$nama_gambar', '$harga')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center"><h5>Tambah Minuman Baru</h5></div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3"><label>Nama Minuman</label><input type="text" name="nama_minuman" class="form-control" required></div>
                    <div class="mb-3"><label>Harga (Rp)</label><input type="number" name="harga" class="form-control" required></div>
                    <div class="mb-3"><label>Upload Gambar</label><input type="file" name="gambar_minuman" class="form-control" required></div>
                    <button type="submit" name="simpan" class="btn btn-primary w-100">Simpan</button>
                    <a href="index.php" class="btn btn-light w-100 mt-2 text-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>