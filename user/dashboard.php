<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); exit;
}

// Ambil Data dari dua tabel berbeda
$query_makanan = mysqli_query($conn, "SELECT * FROM produk");
$query_minuman = mysqli_query($conn, "SELECT * FROM minuman");
$no_wa = "6285693672730";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Menu Resto - Makanan & Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .section-title { border-bottom: 2px solid #dee2e6; padding-bottom: 10px; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-3 mb-4 shadow">
        <span class="navbar-brand">Resto Online</span>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </nav>

    <div class="container">
        <h3 class="section-title text-primary"><i class="bi bi-egg-fried"></i> Katalog Makanan</h3>
        <div class="row mb-5">
            <?php while($row = mysqli_fetch_assoc($query_makanan)) : 
                $pesan = "Halo Admin, saya ingin memesan Makanan: " . $row['nama_makanan'] . " (Rp " . number_format($row['harga']) . ")";
            ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/img/<?= $row['gambar']; ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6><?= $row['nama_makanan']; ?></h6>
                        <p class="text-success fw-bold">Rp <?= number_format($row['harga']); ?></p>
                        <a href="https://wa.me/<?= $no_wa ?>?text=<?= urlencode($pesan) ?>" target="_blank" class="btn btn-success btn-sm w-100">
                            <i class="bi bi-whatsapp"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <h3 class="section-title text-info"><i class="bi bi-cup-straw"></i> Katalog Minuman</h3>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($query_minuman)) : 
                $pesan = "Halo Admin, saya ingin memesan Minuman: " . $row['nama_minuman'] . " (Rp " . number_format($row['harga']) . ")";
            ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-info">
                    <img src="../assets/img/<?= $row['gambar_minuman']; ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6><?= $row['nama_minuman']; ?></h6>
                        <p class="text-success fw-bold">Rp <?= number_format($row['harga']); ?></p>
                        <a href="https://wa.me/<?= $no_wa ?>?text=<?= urlencode($pesan) ?>" target="_blank" class="btn btn-info text-white btn-sm w-100">
                            <i class="bi bi-whatsapp"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>