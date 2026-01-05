<?php
session_start();

// Menghapus session spesifik admin agar tidak bisa akses dashboard lagi
unset($_SESSION['admin_login']);
unset($_SESSION['admin_user']);

// Menghancurkan seluruh session
session_destroy();

// Mengarahkan kembali ke halaman login admin
header("Location: login.php");
exit;
?>