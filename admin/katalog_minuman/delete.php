<?php
include '../../config/config.php';
$id = $_GET['id'];

// Ambil data untuk hapus file gambarnya dari folder
$data = mysqli_query($conn, "SELECT gambar_minuman FROM minuman WHERE id=$id");
$row = mysqli_fetch_assoc($data);
unlink("../../assets/img/" . $row['gambar_minuman']);

// Hapus dari database
mysqli_query($conn, "DELETE FROM minuman WHERE id=$id");
header("Location: index.php");
?>