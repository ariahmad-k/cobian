<?php

session_start ();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['tipe_user']);
// unset($_SESSION['nama']);


session_destroy();
echo "<script>alert('Anda telah keluar dari halaman');document.location='index.php'</script>";


?>