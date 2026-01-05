<?php
session_start();
include '../config/config.php';

// Proteksi halaman: Cek apakah yang masuk adalah admin
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

// Opsional: Ambil jumlah data untuk ditampilkan di ringkasan (stats)
$query_user = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$total_user = mysqli_fetch_assoc($query_user)['total'];

$query_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$total_produk = mysqli_fetch_assoc($query_produk)['total'];

$minuman_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM minuman");
$total_produkMinuman = mysqli_fetch_assoc($minuman_produk)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Panel Kendali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-shield-lock"></i> Admin Panel</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">Halo, Admin</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h2>Dashboard Utama</h2>
                <p class="text-muted">Kelola data pengguna dan katalog makanan Anda di sini.</p>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-primary text-white p-3 rounded">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="card-title text-muted mb-1">Total Pengguna</h5>
                                <h2 class="mb-0"><?= $total_user; ?></h2>
                            </div>
                        </div>
                        <hr>
                        <a href="infoUser.php" class="btn btn-primary w-100">Kelola Pengguna</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-success text-white p-3 rounded">
                                <i class="bi bi-cart-fill fs-3"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="card-title text-muted mb-1">Total Menu Makanan</h5>
                                <h2 class="mb-0"><?= $total_produk; ?></h2>
                            </div>
                        </div>
                        <hr>
                        <a href="katalog_makanan/index.php" class="btn btn-success w-100">Kelola Minuman</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-success text-white p-3 rounded">
                                <i class="bi bi-cart-fill fs-3"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="card-title text-muted mb-1">Total Menu Minuman</h5>
                                <h2 class="mb-0"><?= $total_produkMinuman; ?></h2>
                            </div>
                        </div>
                        <hr>
                        <a href="katalog_minuman/index.php" class="btn btn-success w-100">Kelola Minuman</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-warning border-0 shadow-sm">
                    <strong>Informasi:</strong> Perubahan pada katalog makanan akan langsung terlihat secara real-time di