<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "kuebalok";

// Gunakan variabel $koneksi agar konsisten dengan file lain
$koneksi = mysqli_connect($hostname, $username, $password, $database_name);

if (!$koneksi) {
    echo "Koneksi database rusak";
    die("error: " . mysqli_connect_error());
}

// echo "koneksi berhasil";
?>
