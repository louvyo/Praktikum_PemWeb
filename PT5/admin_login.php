<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek apakah data dikirimkan melalui POST

    // Ambil data dari formulir
    $Username = $_POST['popup-username']; // Ganti menjadi $Username
    $Password = $_POST['popup-password']; // Ganti menjadi $Password

    // Ganti dengan validasi autentikasi admin yang sesuai di sini
    if ($Username === 'admin' && $Password === 'admin123') {
        // Autentikasi berhasil, sesi admin dapat ditetapkan di sini
        session_start();
        $_SESSION['admin_logged_in'] = true;

        header('Location: admin_panel.php');
        exit;
    } else {
        // Autentikasi gagal, tampilkan pesan kesalahan
        $error_message = 'Login gagal. Silakan coba lagi.';
    }
}
?>