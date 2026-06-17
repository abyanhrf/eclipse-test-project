<?php
session_start();

// 1. Pengaturan Koneksi Database (Disamakan dengan gambar struktur showroom_mobil)
$host     = "localhost";
$username = "root";     
$password = "";         
$database = "showroom_mobil"; // <-- Menggunakan nama database yang benar

$conn = mysqli_connect($host, $username, $password, $database);

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// 2. Memproses Data Saat Form Dikirim via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Mengamankan input data dari celah SQL Injection
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    // Validasi sederhana memastikan form tidak dikirim dalam keadaan kosong
    if (empty($nama) || empty($email) || empty($pesan)) {
        echo "<script>
                alert('Semua kolom form wajib diisi!');
                window.location.href = '../contact/contact.php';
              </script>";
        exit();
    }

    // 3. Query Insert data menuju tabel feedback
    $query = "INSERT INTO feedback (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil disimpan, munculkan notifikasi sukses
        echo "<script>
                alert('Pesan Anda berhasil dikirim! Terima kasih atas saran atau kritik Anda.');
                window.location.href = '../contact/contact.php';
              </script>";
    } else {
        // Jika ada kesalahan pada query SQL
        echo "<script>
                alert('Gagal mengirim pesan: " . mysqli_error($conn) . "');
                window.location.href = '../contact/contact.php';
              </script>";
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>