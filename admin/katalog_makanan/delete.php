<?php
include '../../config/config.php';
$id = $_GET['id'];

// Ambil nama file gambar agar bisa dihapus dari folder (opsional)
$data = mysqli_query($conn, "SELECT gambar FROM produk WHERE id=$id");
$row = mysqli_fetch_assoc($data);
unlink("../../assets/img/" . $row['gambar']); // Hapus file dari folder

mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
header("Location: index.php");
?>