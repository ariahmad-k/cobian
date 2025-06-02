<?php
// session_start();


$host = "localhost";
$username = "root";
$password = "";
$database = "kuebalok";


// isi nama host, username mysql, dan password mysql anda
$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk mengamankan inputan dari user
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: kasir/dashboard.php");
        echo "<script>alert('Login Berhasil!');</script>";
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>
