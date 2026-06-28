<?php
session_start();
$error = isset($_GET['error']) && $_GET['error'] == 'true';
?>
<?php
session_start(); 

require_once('../config/database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Jika email ditemukan, cek password
    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: ../dashboard/dashboard.php");
        } else {
            header("Location: ../home/home.php");
        }
        exit;

    } else {
        // PERBAIKAN: Jika PASSWORD SALAH, kembalikan ke login.php dengan error
        header("Location: ../login/login.php?error=true");
        exit;
    }
} else {
    // PERBAIKAN: Jika EMAIL TIDAK DITEMUKAN, kembalikan ke login.php dengan error
    header("Location: ../login/login.php?error=true");
    exit;
}