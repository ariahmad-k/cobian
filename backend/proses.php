<!-- PROSES INI YANG DIPAKAI BEST -->
<!-- RENDICT DARI LOGIN.PHP -->



<?php
include 'service/koneksi.php';

session_start();
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'login') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);

        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
        $cek = mysqli_num_rows($query);

        if ($cek > 0) {
            $row = mysqli_fetch_assoc($query);
            if ($row['password'] == $hash_password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['tipe_user'] = strtolower($row['tipe_user']);

                switch ($_SESSION['tipe_user']) {
                    case 'admin':
                        header("Location: admin/index_admin.php");
                        break;
                    case 'kasir':
                        header("Location: kasir/index_kasir.php");
                        break;
                    case 'owner':
                        header("Location: owner/index_owner.php");
                        break;
                    case 'customer':
                        header("Location: customer/index_customer.php");
                        break;
                    default:
                        echo "<script>alert('Tipe user tidak dikenal'); window.location='login.php';</script>";
                }
                exit;
            } else {
                echo "<script>alert('Password salah'); window.location='login.php';</script>"; //pas dimasukkin owner muncul ini 
                exit;
            }
        } else {
            echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Form login belum lengkap.'); window.location='login.php';</script>";
        exit;
    }
} else if ($action == "logout") {
    unset($_SESSION['username']);
    unset($_SESSION['tipe_user']);
    session_destroy();
    echo "<script>alert('Anda berhasil logout. Terima kasih');window.location='index.php'</script>";
    exit;
} else if ($action == 'buat_akun') {
    if (isset($_POST['username'], $_POST['password'], $_POST['tipe_user'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = $_POST['password'];
        $tipe_user = strtolower($_POST['tipe_user']);
        $hash_password = hash('sha256', $password);

        if (!empty($username) && !empty($password) && !empty($tipe_user)) {
            $stmt = $koneksi->prepare("INSERT INTO users (username, password, tipe_user) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hash_password, $tipe_user);
            if ($stmt->execute()) {
                echo "<script>alert('Registrasi berhasil sebagai $tipe_user, silakan login.'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal, username mungkin sudah digunakan.'); window.location='register.php';</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Semua data wajib diisi.'); window.location='register.php';</script>";
        }
    } else {
        echo "<script>alert('Form registrasi belum lengkap.'); window.location='register.php';</script>";
    }
}
?>
