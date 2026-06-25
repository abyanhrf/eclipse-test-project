<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak valid");
}

$nama = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$domisili = $_POST['domisili'];

// ==========================================================
// 1. CEK DULU: Apakah email sudah terdaftar di database?
// ==========================================================
$cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

if (mysqli_num_rows($cek_email) > 0) {
    // Jika email sudah ada, langsung munculkan pop-up peringatan dan hentikan proses
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <title>Memproses...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body style='background-color: #0b0b0b;'>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Email Sudah Terdaftar!',
                text: 'Email ini sudah digunakan oleh akun lain. Silakan gunakan email berbeda atau lakukan Login.',
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#f59e0b'
            }).then(() => {
                window.history.back(); // Kembali ke form register tanpa mereset isian user
            });
        </script>
    </body>
    </html>";
    exit; // Hentikan script di sini agar tidak error saat mencoba INSERT
}

// ==========================================================
// 2. JIKA EMAIL AMAN (Belum terdaftar), lanjutkan registrasi
// ==========================================================
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Menggunakan try-catch agar jika ada error database lain, PHP tidak memunculkan tulisan merah
try {
    $sql = "INSERT INTO users (nama, email, password, domisili) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password_hash, $domisili);
    mysqli_stmt_execute($stmt);

    // --- POP-UP JIKA REGISTRASI SUKSES ---
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <title>Memproses...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body style='background-color: #0b0b0b;'>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Welcome to ECLIPSE!',
                text: 'Akun Anda berhasil didaftarkan. Silakan login untuk melanjutkan.',
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#38bdf8'
            }).then(() => {
                window.location.href = '../login/login.php'; 
            });
        </script>
    </body>
    </html>";

} catch (mysqli_sql_exception $e) {
    // --- POP-UP JIKA ADA ERROR DATABASE LAINNYA ---
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <title>Memproses...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body style='background-color: #0b0b0b;'>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                text: 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.',
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#ef4444'
            }).then(() => {
                window.history.back(); 
            });
        </script>
    </body>
    </html>";
}
?>