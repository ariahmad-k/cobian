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
        <main>
            <div class="container-fluid px-4">
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="">
                            <!-- input  -->
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Default form</h4>
                                        <p class="card-description">
                                            Basic form layout
                                        </p>
                                        <?php
                                        include "../koneksi.php";

                                        // Ambil data berdasarkan ID barang
                                        $id_produk = $_GET['id'];
                                        $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                                        $data = mysqli_fetch_array($query);
                                        ?>

                                        <form class="forms-sample" method="post" action="../../proses.php?action=edit" enctype="multipart/form-data">
                                            <!-- Hidden Kode Barang untuk ID -->
                                            <input type="hidden" name="kd_barang" value="<?php echo $data['id_produk']; ?>">

                                            <div class="form-group">
                                                <label for="kd_barang_display">Kode Barang</label>
                                                <input type="text" class="form-control" id="kd_barang_display" value="<?php echo $data['id_produk']; ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="kode_jenis">Kode Jenis Barang</label>
                                                <select class="form-control" id="kode_jenis" name="kode_jenis">
                                                    <?php
                                                    $query_jenis = mysqli_query($koneksi, "SELECT * FROM produk");
                                                    while ($data_jenis = mysqli_fetch_array($query_jenis)) {
                                                        $selected = $data_jenis["kategori"] == $data["kategori"] ? "selected" : "";
                                                        echo "<option value='{$data_jenis["kategori"]}' $selected>{$data_jenis["kategori"]} - {$data_jenis["kategori"]}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $data['nama_produk']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $data['stok']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual</label>
                                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $data['harga_produk']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Gambar Produk Lama</label><br>
                                                <img src="../gambar/<?php echo $data['poto_produk']; ?>" style="width: 200px;" alt="Gambar Lama">
                                            </div>

                                            <div class="form-group">
                                                <label for="gambar_produk">Ganti Gambar Produk (opsional)</label>
                                                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <a href="data_barang.php" class="btn btn-secondary">Batal</a>
                                        </form>
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