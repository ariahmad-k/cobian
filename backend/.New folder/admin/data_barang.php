<?php
include '../koneksi.php';
session_start();

function formatRupiah($angka)
{
    if ($angka) {
        return 'Rp ' . number_format($angka, 0, ',', '.');
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
    <link href="../kasir/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include '../kasir/includes/navbar.php';
    include '../kasir/includes/sidebar.php';
    ?>
    <div id="layoutSidenav_content">

        <div class="main-panel">
            <div class="container-fluid px-4">
<div class="content-wrapper">
                <div class="">
                    <!-- input  -->
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Default form</h4>
                                    <p class="card-description">
                                        Basic form layout
                                    </p>
                                    <form class="forms-sample" method="post" action="../../proses.php?action=add_barang" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="kd_barang">Kode Barang</label>
                                            <input type="text" class="form-control" id="kd_barang" placeholder="kode barang" name="kd_barang">
                                        </div>

                                        <div class="form-group">
                                            <label for="kode_jenis">Kode jenis Barang</label>
                                            <select class="form-control" id="kode_jenis" name="kode_jenis">
                                                <?php
                                                include "../koneksi.php";
                                                $query_mysql = mysqli_query($koneksi, "SELECT * FROM produk");
                                                $nomor = 1;
                                                while ($data = mysqli_fetch_array($query_mysql)) {
                                                ?>
                                                    <option value="<?php echo $data["kategori"]; ?>">
                                                        <?php echo $data["kategori"] . " - " . $data["id_produk"]; ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" class="form-control" id="nama_barang" placeholder="nama barang" name="nama_barang">
                                        </div>


                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stok" placeholder="0" name="stok">
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_beli">harga beli</label>
                                            <input type="text" class="form-control" id="harga_beli" placeholder="nama barang" name="harga_beli">
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_jual">harga jual</label>
                                            <input type="text" class="form-control" id="harga_jual" placeholder="harga beli" name="harga_jual">
                                        </div>


                                        <div class="form-group">
                                            <label for="gambar_produk">gambar produk</label>
                                            <input type="file" class="form-control" id="gambar_produk" placeholder="gambar produk" name="gambar_produk">
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- tabel -->
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Inverse table</h4>
                                    <p class="card-description">
                                        <!-- Add class <code>.table-dark</code> -->
                                    </p>
                                    <div class="table-responsive pt-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Kode Jenis</th>
                                                    <th>Nama Barang</th>
                                                    <th>Stok</th>
                                                    <th>Harga Beli</th>
                                                    <th>Harga Jual</th>
                                                    <th>Gambar Produk</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include "../koneksi.php";
                                                $query_mysql = mysqli_query($koneksi, "SELECT * FROM produk");
                                                $nomor = 1;
                                                while ($data = mysqli_fetch_array($query_mysql)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?= $data["id_produk"]; ?></td>
                                                        <td><?= $data["kategori"]; ?></td>
                                                        <td><?= $data["nama_produk"]; ?></td>
                                                        <td><?= $data["stok"]; ?></td>
                                                        <td><?= formatRupiah($data["harga_produk"]); ?></td>
                                                        <td>
                                                            <?php if (!empty($data["gambar_produk"])): ?>
                                                                <img src="../gambar/<?= $data["poto_produk"]; ?>" alt="Gambar Produk" style="width: 200px; height: auto; border-radius: 4px;">
                                                            <?php else: ?>
                                                                <em>Tidak ada gambar</em>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a href="data_barang_edit.php?id=<?= $data["id_produk"]; ?>">Edit</a> |
                                                            <a href="../proses.php?action=delete_barang&kd_barang=<?= $data["id_produk"]; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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