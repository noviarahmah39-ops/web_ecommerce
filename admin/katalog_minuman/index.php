<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_login'])) { header("Location: ../login.php"); exit; }

$result = mysqli_query($conn, "SELECT * FROM minuman");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-cup-straw"></i> Daftar Menu Minuman</h3>
            <div>
                <a href="tambah.php" class="btn btn-primary">+ Tambah Minuman</a>
                <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Minuman</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><img src="../../assets/img/<?= $row['gambar_minuman']; ?>" width="70" class="rounded"></td>
                            <td><?= $row['nama_minuman']; ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus minuman ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>