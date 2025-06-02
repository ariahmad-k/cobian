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
    include '../koneksi.php'
        ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">



                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Daftar Menu</h3>
                                <div class="row">
                                    <?php
                                    // Ambil semua produk dari database
                                    $query_produk = "SELECT p.id_produk, p.nama_produk, p.harga_produk, p.poto_produk, p.kategori, sp.stok_produk 
                                     FROM produk p
                                     LEFT JOIN stok_produk sp ON p.id_produk = sp.id_produk
                                     ORDER BY p.kategori, p.nama_produk";
                                    $result_produk = $koneksi->query($query_produk);

                                    if ($result_produk->num_rows > 0) {
                                        $current_kategori = '';
                                        while ($row = $result_produk->fetch_assoc()) {
                                            // Tampilkan judul kategori jika kategori berubah
                                            if ($row['kategori'] != $current_kategori) {
                                                echo '<div class="col-12 mt-4">';
                                                echo '<h4>' . strtoupper($row['kategori']) . '</h4>';
                                                echo '</div>';
                                                $current_kategori = $row['kategori'];
                                            }
                                            ?>
                                            <div class="col-md-3 mb-4">
                                                <div class="card product-card"
                                                    data-product-id="<?php echo $row['id_produk']; ?>"
                                                    data-product-name="<?php echo htmlspecialchars($row['nama_produk']); ?>"
                                                    data-product-price="<?php echo $row['harga_produk']; ?>"
                                                    data-product-stock="<?php echo $row['stok_produk']; ?>">
                                                    <img src="../gambar/<?php echo $row['poto_produk']; ?>"
                                                        class="card-img-top" alt="<?php echo $row['nama_produk']; ?>">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title"><?php echo $row['nama_produk']; ?></h5>
                                                        <p class="card-text">Rp
                                                            <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?>
                                                        </p>
                                                        <?php if ($row['stok_produk'] > 0): ?>
                                                            <button class="btn btn-primary btn-sm add-to-cart-btn">Pilih</button>
                                                        <?php else: ?>
                                                            <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<div class="col-12"><p>Belum ada produk terdaftar.</p></div>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="col-md-4">
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">Detail Pesanan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="cart-items">
                                            <p class="text-muted text-center" id="empty-cart-message">Keranjang kosong.
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong>Sub-Total:</strong>
                                            <span id="subtotal-display">Rp 0</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4>Total:</h4>
                                            <h4 id="total-display">Rp 0</h4>
                                        </div>

                                        <form id="orderForm" action="../admin/process_pesanan.php" method="POST">
                                            <input type="hidden" name="cart_data" id="cart-data-input">
                                            <input type="hidden" name="total_amount" id="total-amount-input">
                                            <input type="hidden" name="user_id_kasir"
                                                value="<?php //echo $_SESSION['user_id']; ?>">

                                            <div class="form-group mb-3">
                                                <label for="nama_pemesan">Nama Pemesan (Opsional):</label>
                                                <input type="text" class="form-control" id="nama_pemesan"
                                                    name="nama_pemesan" placeholder="Nama Pelanggan">
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="jenis_pesanan">Jenis Pesanan:</label>
                                                <select class="form-control" id="jenis_pesanan" name="jenis_pesanan"
                                                    required>
                                                    <option value="take away">Take Away</option>
                                                    <option value="dine in">Dine In</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="metode_pembayaran">Metode Pembayaran:</label>
                                                <select class="form-control" id="metode_pembayaran"
                                                    name="metode_pembayaran" required>
                                                    <option value="tunai">Tunai</option>
                                                    <option value="transfer">Transfer Bank</option>
                                                    <option value="ewallet">E-Wallet</option>
                                                </select>
                                            </div>

                                            <button type="button" class="btn btn-danger btn-block mb-2"
                                                id="clear-cart-btn">Clear Pesanan</button>
                                            <button type="submit" class="btn btn-success btn-block" id="charge-btn"
                                                disabled>Charge Rp 0</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <script>
                    // JavaScript untuk mengelola keranjang
                    let cart = {}; // Objek untuk menyimpan item di keranjang {productId: {name, price, quantity, stock}}

                    function saveCartToLocalStorage() {
                        localStorage.setItem('kasir_cart', JSON.stringify(cart));
                    }

                    function loadCartFromLocalStorage() {
                        const storedCart = localStorage.getItem('kasir_cart');
                        if (storedCart) {
                            cart = JSON.parse(storedCart);
                        }
                    }
                    function updateCartDisplay() {
                        const cartItemsDiv = document.getElementById('cart-items');
                        cartItemsDiv.innerHTML = ''; // Kosongkan tampilan keranjang

                        let subtotal = 0;
                        let hasItems = false;

                        for (const productId in cart) {
                            if (cart.hasOwnProperty(productId)) {
                                hasItems = true;
                                const item = cart[productId];
                                const itemSubtotal = item.price * item.quantity; // <-- Cek nilai ini
                                subtotal += itemSubtotal;

                                const itemHtml = `
                    <div class="d-flex justify-content-between align-items-center mb-2 cart-item-row" data-product-id="${productId}">
                        <div>
                            <span>${item.name}</span>
                            <div class="input-group input-group-sm mt-1" style="width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary btn-sm minus-btn" type="button">-</button>
                                </div>
                                <input type="text" class="form-control text-center quantity-input" value="${item.quantity}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm plus-btn" type="button">+</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span>Rp ${numberFormat(itemSubtotal)}</span> 
                            <button class="btn btn-sm btn-danger remove-item-btn ml-2">X</button>
                        </div>
                    </div>
                `;
                                cartItemsDiv.innerHTML += itemHtml;
                            }
                        }
                        // ... (bagian bawah fungsi ini untuk subtotal/total keseluruhan)
                        document.getElementById('subtotal-display').textContent = 'Rp ' + numberFormat(subtotal);
                        document.getElementById('total-display').textContent = 'Rp ' + numberFormat(subtotal);
                        document.getElementById('total-amount-input').value = subtotal;
                        document.getElementById('charge-btn').textContent = 'Charge Rp ' + numberFormat(subtotal);
                    }

                    // Fungsi numberFormat
                    function numberFormat(amount) {
                        return new Intl.NumberFormat('id-ID').format(amount);
                    }

                    // Event Listener untuk tombol "Pilih" pada produk
                    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                        button.addEventListener('click', function () {
                            const card = this.closest('.product-card');
                            const productId = card.dataset.productId;
                            const productName = card.dataset.productName;
                            const productPrice = parseInt(card.dataset.productPrice);
                            const productStock = parseInt(card.dataset.productStock);

                            if (cart[productId]) {
                                if (cart[productId].quantity < productStock) {
                                    cart[productId].quantity++;
                                } else {
                                    alert('Stok ' + productName + ' tidak cukup!');
                                }
                            } else {
                                if (productStock > 0) {
                                    cart[productId] = {
                                        name: productName,
                                        price: productPrice,
                                        quantity: 1,
                                        stock: productStock // Menyimpan stok juga di objek keranjang
                                    };
                                } else {
                                    alert('Stok ' + productName + ' tidak tersedia!');
                                }
                            }
                            updateCartDisplay();
                        });
                    });

                    // Event Listener untuk tombol plus, minus, dan remove pada item di keranjang (delegasi event)
                    document.getElementById('cart-items').addEventListener('click', function (event) {
                        const target = event.target;
                        const row = target.closest('.cart-item-row');
                        if (!row) return;

                        const productId = row.dataset.productId;

                        if (target.classList.contains('plus-btn')) {
                            if (cart[productId].quantity < cart[productId].stock) {
                                cart[productId].quantity++;
                            } else {
                                alert('Stok ' + cart[productId].name + ' tidak cukup!');
                            }
                        } else if (target.classList.contains('minus-btn')) {
                            if (cart[productId].quantity > 1) {
                                cart[productId].quantity--;
                            } else {
                                // Jika kuantitas jadi 0, hapus dari keranjang
                                delete cart[productId];
                            }
                        } else if (target.classList.contains('remove-item-btn')) {
                            delete cart[productId];
                        }
                        updateCartDisplay();
                    });

                    // Event Listener untuk tombol Clear Pesanan
                    document.getElementById('clear-cart-btn').addEventListener('click', function () {
                        if (confirm('Anda yakin ingin menghapus semua item dari pesanan ini?')) {
                            cart = {}; // Kosongkan keranjang
                            updateCartDisplay();
                        }
                    });

                    // Inisialisasi: Muat keranjang dari local storage saat halaman dimuat
                    document.addEventListener('DOMContentLoaded', function () {
                        loadCartFromLocalStorage();
                        updateCartDisplay();
                    });

                    // Tambahkan event listener untuk submit form
                    document.getElementById('orderForm').addEventListener('submit', function (e) {
                        if (Object.keys(cart).length === 0) {
                            alert('Keranjang pesanan masih kosong!');
                            e.preventDefault(); // Batalkan submit
                        } else {
                            // Pastikan data keranjang terisi sebelum submit
                            document.getElementById('cart-data-input').value = JSON.stringify(cart);
                        }
                    });

                </script>
            </div>
        </main>

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