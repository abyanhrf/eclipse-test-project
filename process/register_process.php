<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak valid");
}

$nama = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$domisili = $_POST['domisili'];

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (nama, email, password, domisili) VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password_hash, $domisili);

if (mysqli_stmt_execute($stmt)) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . mysqli_error($conn);
}