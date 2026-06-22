<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "showroom_mobil";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function loadEnv($path) {

    if (!file_exists($path)) {
        return false;
    }

    // Baca file baris per baris, abaikan baris kosong
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {

        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            $_ENV[$name] = $value;
            putenv("{$name}={$value}");
        }
    }
}

loadEnv(__DIR__ . '/../private/.env');
