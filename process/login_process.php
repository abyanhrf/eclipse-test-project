<?php

require_once('../config/database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if ($user) {
    if (password_verify($password, $user['password'])) {
        
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: ../dashboard/dashboard.php");
            } 
        else {
                header("Location: ../home/home.php");
            }

        exit;
    }

    else {
        echo "Password salah!";
    }
} else {
    echo "Email tidak ditemukan!";
}