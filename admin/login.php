<?php
session_start();
include '../config/config.php';

if (isset($_POST['login_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek di tabel admins (Tabel baru khusus admin)
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin_login'] = true;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login Admin Gagal!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 card p-4 shadow">
                <h4 class="text-center">Admin Login</h4>
                <form method="POST">
                    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <button type="submit" name="login_admin" class="btn btn-danger w-100">Login Admin</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>