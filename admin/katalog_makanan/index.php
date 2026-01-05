<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_login'])) { header("Location: ../login.php"); exit; }

$result = mysqli_query($conn, "SELECT * FROM produk");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h3>Manajemen Katalog Makanan</h3>
            <div>
                <a href="tambah.php" class="btn btn-success">+ Tambah Menu</a>
                <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Makanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><img src="../../assets/img/<?= $row['gambar']; ?>" width="80"></td>
                    <td><?= $row['nama_makanan']; ?></td>
                    <td>Rp <?= number_format($row['harga']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus menu ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>