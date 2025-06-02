<?php 
include "service/koneksi.php";
session_start();

$register_message = "";

if(isset($_POST["register"])){
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $no_tlp = $_POST["no_tlp"];
    $alamat = $_POST["alamat"];
    $email = $_POST["email"];
    $tipe_user = $_POST["tipe_user"];
    $terms = isset($_POST["termsCheck"]);

    if(empty($username) || empty($password) || empty($tipe_user)){
        $register_message = "<div class='alert alert-warning'>Semua field harus diisi.</div>";
    } elseif(!$terms){
        $register_message = "<div class='alert alert-warning'>Anda harus menyetujui syarat & ketentuan.</div>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $register_message = "<div class='alert alert-warning'>Format email tidak valid.</div>";
    } else {
        // Cek email/username sudah ada
        $cek = $koneksi->prepare("SELECT id FROM users WHERE username=? OR email=? LIMIT 1");
        $cek->bind_param("ss", $username, $email);
        $cek->execute();
        $cek->store_result();
        if ($cek->num_rows > 0) {
            $register_message = "<div class='alert alert-warning'>Username atau email sudah digunakan.</div>";
        } else {
            // Hash password menggunakan SHA-256
            $hash_password = hash('sha256', $password);

            $stmt = $koneksi->prepare("INSERT INTO users (username, password, no_tlp, alamat, email, tipe_user) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $hash_password, $no_tlp, $alamat, $email, $tipe_user);

            if ($stmt->execute()) {
                header("Location: login.php?register=success");
                exit();
            } else {
                $register_message = "<div class='alert alert-danger'>Daftar gagal, silakan coba lagi.</div>";
            }
            $stmt->close();
        }
        $cek->close();
    }
    $koneksi->close();
}
?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>register</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
</head>
<body>
    <form class="form-signin" action="register2.php" method="POST">
    <div class="text-center mb-4">
        <img class="mb-4" src="assets/brand/kue-balok.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Form Register</h1>
        <i><?= $register_message ?></i>  <!--ini bener ga sih message nya-->
        
    </div>
        <div class="form-label-group">
            <input type="text" class="form-control" name="username" id="username" placeholder="username" required autofocus>
            <label for="username">Username</label>
        </div>
        <div class="form-label-group">
            <input type="password"  class="form-control" name="password" id="paassword" placeholder="Masukkan Password" required>
            <label for ="passsword">Password</label>
        </div>
        <div class="form-label-group">
            <input type="text"  class="form-control" name="no_tlp"  id="no_tlp" placeholder="Masukkan Nomor telepon" required>
            <label for="no_tlp">No. Telepon</label>
        </div>
        <div class="form-label-group">
            <input type="text"  class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat" required>
            <label for="alamat" > Alamat</label>
        </div>
        <div class="form-label-group">
            <input type="email"  class="form-control" name="email"  id="email" placeholder="Masukkan Email" required>
            <label for="email"> Email</label>
        </div>
        <div class="form-group">
            <label for="tipe_user">Tipe User</label>
            <select class="form-control" name="tipe_user" id="tipe_user" required>
                <option value="">-- Pilih Tipe User --</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
                <option value="customer">Customer</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="termsCheck" name="termsCheck">
            <label class="form-check-label" for="termsCheck">Saya setuju dengan syarat & ketentuan</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register2">Register</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Kue Balok Mang Wiro 2025</p>
    </form>
</body>
</html>
