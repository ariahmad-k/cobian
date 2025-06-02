<?php
include '../backend/koneksi.php';

// Ambil data stok harian terbaru hari ini
$tanggal = date('Y-m-d');
$query = mysqli_query($koneksi, "
    SELECT sh.id_produk, sh.stok_produk, p.nama_produk, p.harga_produk, p.poto_produk AS gambar
    FROM stok_produk sh
    JOIN produk p ON sh.id_produk = p.id_produk
    WHERE sh.tanggal = '$tanggal' AND sh.stok_produk > 0
");

$menu = [];
while ($row = mysqli_fetch_assoc($query)) {
    $menu[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesan Menu</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h2 {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            border-radius: 8px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        }

        .menu-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .qty-control {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .qty-control button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }

        .qty-control .jumlah {
            width: 30px;
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #pesanBtn {
            background: #333;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Nama:</h2>
    <input type="text" id="namaPemesan" placeholder="Masukkan nama Anda">

    <h2>Menu:</h2>
    <div class="menu-grid">
        <?php foreach ($menu as $item): ?>
            <div class="menu-card" data-id="<?= $item['id'] ?>" data-harga="<?= $item['harga'] ?>">
                <img src="assets/img/<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>" class="menu-img">
                <p><?= $item['nama'] ?></p>
                <p><?= number_format($item['harga'], 0, ',', '.') ?></p>
                <div class="qty-control">
                    <button class="kurang">-</button>
                    <span class="jumlah">0</span>
                    <button class="tambah">+</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer">
        <div class="total">
            <strong>Total:</strong> Rp <span id="total">0</span>
        </div>
        <button id="pesanBtn">Pesan</button>
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.menu-card');
    let totalHarga = 0;

    cards.forEach(card => {
        let jumlahEl = card.querySelector('.jumlah');
        let tambahBtn = card.querySelector('.tambah');
        let kurangBtn = card.querySelector('.kurang');
        let harga = parseInt(card.dataset.harga);

        tambahBtn.onclick = () => {
            let jml = parseInt(jumlahEl.textContent);
            jumlahEl.textContent = jml + 1;
            totalHarga += harga;
            updateTotal();
        };

        kurangBtn.onclick = () => {
            let jml = parseInt(jumlahEl.textContent);
            if (jml > 0) {
                jumlahEl.textContent = jml - 1;
                totalHarga -= harga;
                updateTotal();
            }
        };
    });

    function updateTotal() {
        document.getElementById('total').textContent = totalHarga.toLocaleString('id-ID');
    }
</script>
</body>
</html>
