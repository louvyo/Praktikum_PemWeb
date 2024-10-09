<?php
require "koneksi.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Username = $_POST['register-username'];
    $Email = $_POST['register-email'];
    $Password = $_POST['register-password'];

    // Validasi email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Alamat email tidak valid. Silakan coba lagi.')</script>";
    } else {
        // Validasi username
        $check_username_query = mysqli_query($conn, "SELECT * FROM `account` WHERE username = '$Username'");
        if (mysqli_num_rows($check_username_query) > 0) {
            echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.'); window.location.href = 'index.php#registerPopup';</script>";
        } else {
            // Jika email dan username tersedia, tambahkan data ke database
            $insert_query = mysqli_query($conn, "INSERT INTO `account` (username, email, password) VALUES ('$Username', '$Email', '$Password')");
            
            if ($insert_query) {
                echo "<script>alert('Pendaftaran berhasil. Anda akan dialihkan ke halaman login.'); window.location.href = 'index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.'); window.location.href = 'index.php#registerPopup';</script>";
            }
        }
    }
}
