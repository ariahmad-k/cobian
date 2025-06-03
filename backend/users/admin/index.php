<?php
include('../../koneksi.php');

// session_start(); // Jika perlu, aktifkan session
?>
<!DOCTYPE html>
<html lang="id">

<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Admin</title>
        <!-- link css  -->
        <link rel="stylesheet" href="style.css" />
        <!-- Bootstrap core CSS -->
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Optional: Font Awesome untuk ikon -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

</head>

<body>



        <div class="container-fluid">
                <?php include('navbar.php'); ?>
                <div class="row">

                        <nav id="sidebarMenu" class="col-md-2 d-none d-md-block bg-light sidebar">
                                <?php include('sidebar.php'); ?>
                        </nav>

                        <!-- Main Content -->
                        <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 py-4">
                                <h1 class="h2">Dashboard Admin</h1>
                                <p>Selamat datang di halaman dashboard admin.</p>

                                <!-- Tombol logout -->
                                <form class="d-flex ms-auto" action="../logout.php" method="POST">
                                        <button class="btn btn-danger" type="submit">
                                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </button>
                                </form>

                                <!-- Contoh kartu info -->
                                <div class="row">
                                        <div class="col-md-4 mb-3">
                                                <div class="card text-white bg-primary">
                                                        <div class="card-body">
                                                                <h5 class="card-title">Data Users</h5>
                                                                <p class="card-text fs-4">3</p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                                <div class="card text-white bg-success">
                                                        <div class="card-body">
                                                                <h5 class="card-title">Transaksi Kasir</h5>
                                                                <p class="card-text fs-4">53</p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                                <div class="card text-white bg-warning">
                                                        <div class="card-body">
                                                                <h5 class="card-title">Transaksi Online</h5>
                                                                <p class="card-text fs-4">20</p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <!-- Contoh tabel aktivitas terbaru -->
                                <h3>Recent Activity</h3>
                                <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                                <thead>
                                                        <tr>
                                                                <th>#</th>
                                                                <th>User</th>
                                                                <th>Activity</th>
                                                                <th>Date</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr>
                                                                <td>1</td>
                                                                <td>John Doe</td>
                                                                <td>Login</td>
                                                                <td>2025-05-22</td>
                                                        </tr>
                                                        <tr>
                                                                <td>2</td>
                                                                <td>Jane Smith</td>
                                                                <td>Added new product</td>
                                                                <td>2025-05-21</td>
                                                        </tr>
                                                        <tr>
                                                                <td>3</td>
                                                                <td>Michael Lee</td>
                                                                <td>Updated settings</td>
                                                                <td>2025-05-20</td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                </div>
                        </main>
                </div>
        </div>

        <!-- Bootstrap JS Bundle (Popper + Bootstrap JS) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>