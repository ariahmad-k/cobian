<!-- NAH PROSES INI TIDAK DIPAKAI BESTT
INI PROSES YG DARI WIAM -->

<?php
session_start();
include 'service/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['tipe_user'] = $data['tipe_user'];

        switch ($data['tipe_user']) {
            case 'owner':
                header("Location: owner/index_owner.php");
                break;
            case 'admin':
                header("Location: admin/index_admin.php");
                break;
            case 'kasir':
                header("Location: kasir/index_kasir.php");
                break;
        }
    } else {
        $error = "Username atau password salah.";
    }
}
?>