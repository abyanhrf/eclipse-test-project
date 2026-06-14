<?php
require_once '../config/database.php';

$nama_mobil = $_POST['nama_mobil'];
$merek = $_POST['merek'];
$tipe_mobil = $_POST['tipe_mobil'];
$harga = $_POST['harga'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$gambar = $_FILES['gambar'];

$namaFile = time() . "_" . basename($gambar['name']);

$target = "../uploads/" . $namaFile;

if ($gambar['error'] != 0) {
    die("Upload gambar gagal");
}

if (!move_uploaded_file(
    $gambar['tmp_name'],
    $target
)) {
    die("Gagal menyimpan gambar");
}

$sql ="INSERT INTO cars (nama_mobil, merek, tipe_mobil, harga, tahun, stok, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssiiis",
    $nama_mobil,
    $merek,
    $tipe_mobil,
    $harga,
    $tahun,
    $stok,
    $deskripsi
);

if (mysqli_stmt_execute($stmt)) {

    $car_id = mysqli_insert_id($conn);

    $sqlImg = "INSERT INTO car_img (car_id, gambar)
            VALUES (?, ?)";

    $stmtImg = mysqli_prepare($conn, $sqlImg);

    mysqli_stmt_bind_param(
        $stmtImg,
        "is",
        $car_id,
        $namaFile
    );

    mysqli_stmt_execute($stmtImg);

    header("Location: ../dashboard/dashbarang.php");
    exit;

} else {
    echo "Error: " . mysqli_error($conn);
}