<?php
// Cek apakah data dikirimkan melalui POST
if (isset($_POST['popup-username']) && isset($_POST['popup-password'])) {
    // Ambil data dari formulir
    $Username = $_POST['popup-username']; // Ganti menjadi $Username
    $Password = $_POST['popup-password']; // Ganti menjadi $Password

    // Ganti dengan validasi autentikasi admin yang sesuai di sini
    if ($Username === 'admin' && $Password === 'admin123') {
        // Autentikasi berhasil, sesi admin dapat ditetapkan di sini
        session_start();
        $_SESSION['admin_logged_in'] = true;

        // Redirect ke halaman admin setelah login berhasil
        header('Location: admin_panel.php');
        exit;
    } else {
        // Autentikasi gagal
        echo 'Login gagal. Coba lagi.';
    }
}
?>
