<?php
include '../koneksi.php';

function showTable($title, $query, $koneksi)
{
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<h3>$title</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        while ($field = mysqli_fetch_field($result)) {
            echo "<th>" . ucfirst(str_replace('_', ' ', $field->name)) . "</th>";
        }
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $data) {
                echo "<td>$data</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "<p><strong>Tidak ada data ditemukan.</strong></p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kasir KueBalok MangWiro</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include 'includes/navbar.php';
    include 'includes/sidebar.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Riwayat Pesanan
                    </div>
                    <div class="card-body">

                        <h2>Laporan Penjualan Harian</h2>
                        <form method="POST">
                            <label>Pilih Tanggal:
                                <input type="date" name="tanggal" value="<?php echo $_POST['tanggal'] ?? ''; ?>" required>
                            </label>
                            <button type="submit">Tampilkan</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['tanggal'])) {
                            $tanggal = $_POST['tanggal'];
                            $query = "
            SELECT id_pesanan, nama_pemesan, tgl_pesanan, total_hargaall, status_pesanan
            FROM pesanan
            WHERE status_pesanan = 'selesai' AND tgl_pesanan = '$tanggal'
            ORDER BY tgl_pesanan ASC";
                            showTable("Daftar Pesanan Selesai Tanggal $tanggal", $query, $koneksi);
                        }

                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>