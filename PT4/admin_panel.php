<?php
// Mengecek apakah sesi admin ada dan benar
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect ke halaman login jika belum login
    exit;
}

// Jika sesi admin benar, tampilkan halaman admin
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>

<body class="admin">
    <div id="admin-panel">
        <p>Selamat datang di admin panel</p>
    </div>


    <!-- Formulir Input untuk Menambahkan Barang -->
    <section class="input-form" id="input-form">
        <h2>Tambah Barang</h2>
        <form id="add-product-form" method="POST" action="process_product.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product-name">Nama Barang:</label>
                <input type="text" id="product-name" name="product-name" class="input-field" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="product-price">Harga (IDR):</label>
                <input type="number" id="product-price" name="product-price" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="product-image">Gambar Barang:</label>
                <input type="file" id="product-image" name="product-image" accept="image/*" class="input-field" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Tambah Barang</button>
            </div>
            <a href="index.html" id="logout-button" class="btn">Keluar</a>
        </form>
    </section>


    <!-- Container untuk Daftar Barang -->
    <div id="product-list-container">
        <!-- Product items will be displayed here -->
    </div>


</body>

</html>