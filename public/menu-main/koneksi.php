<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "balokmangwiro";


// Membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "balokmangwiro");
$koneksi = mysqli_connect($host, $username, $password, $database);



// Cek koneksi
// if (!$koneksi) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// } else {
//     echo"koneksi berhasil";
// }

// Jika koneksi berhasil, Anda bisa lanjutkan proses lainnya di sini
// echo "Koneksi berhasil";
?>
