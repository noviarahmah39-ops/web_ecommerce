<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_login'])) { header("Location: ../login.php"); exit; }

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM minuman WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_minuman'];
    $harga = $_POST['harga'];
    $gambar_lama = $_POST['gambar_lama'];

    if ($_FILES['gambar_minuman']['error'] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = $_FILES['gambar_minuman']['name'];
        move_uploaded_file($_FILES['gambar_minuman']['tmp_name'], "../../assets/img/" . $gambar);
    }

    mysqli_query($conn, "UPDATE minuman SET nama_minuman='$nama', harga='$harga', gambar_minuman='$gambar' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-header bg-warning text-center"><h5>Edit Minuman</h5></div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="gambar_lama" value="<?= $data['gambar_minuman']; ?>">
                    <div class="mb-3"><label>Nama Minuman</label><input type="text" name="nama_minuman" class="form-control" value="<?= $data['nama_minuman']; ?>" required></div>
                    <div class="mb-3"><label>Harga (Rp)</label><input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required></div>
                    <div class="mb-3">
                        <label>Gambar Sekarang</label><br>
                        <img src="../../assets/img/<?= $data['gambar_minuman']; ?>" width="100" class="mb-2 rounded">
                        <input type="file" name="gambar_minuman" class="form-control">
                    </div>
                    <button type="submit" name="update" class="btn btn-warning w-100">Update Data</button>
                    <a href="index.php" class="btn btn-light w-100 mt-2 text-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>