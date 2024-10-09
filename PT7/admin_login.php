<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Username = $_POST['popup-username']; 
    $Password = $_POST['popup-password']; 

    // Ganti dengan validasi autentikasi admin yang sesuai di sini
    $sql = "SELECT * FROM account WHERE username = '$Username' AND password = '$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Autentikasi berhasil, sesi admin dapat ditetapkan di sini
        session_start();
        $_SESSION['admin_logged_in'] = true;

        header('Location: admin_panel.php');
        exit;
    } else {
        // Autentikasi gagal, tampilkan pesan kesalahan
        $error_message = 'Login gagal. Silakan coba lagi.';
    }

    $conn->close(); // Tutup koneksi ke database
}
?>
