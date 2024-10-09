<?php
// Mengecek apakah sesi admin ada dan benar
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Jika sesi admin tidak ada atau tidak benar, kembali ke halaman login
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data barang yang dikirim dari formulir
    $productName = $_POST['product-name'];
    $productPrice = $_POST['product-price'];

    // Validasi data atau lakukan operasi lain yang diperlukan
    // Misalnya, menyimpan data barang ke basis data

    // Setelah berhasil menyimpan data barang, berikan respons ke JavaScript
    $response = array("message" => "Barang berhasil ditambahkan.");
    echo json_encode($response);
} else {
    // Jika bukan permintaan POST, kembali ke halaman admin
    header('Location: admin_panel.php');
    exit;
}
?>
