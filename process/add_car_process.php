<?php
require_once '../config/database.php';

$nama_mobil = $_POST['nama_mobil'];
$merek = $_POST['merek'];
$tipe_mobil = $_POST['tipe_mobil'];
$harga = $_POST['harga'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$bahan_bakar = $_POST['bahan_bakar'];
$kapasitas_mesin = $_POST['kapasitas_mesin'];
$transmisi = $_POST['transmisi'];
$warna = $_POST['warna'];
$kilometer = $_POST['kilometer'];
$deskripsi = $_POST['deskripsi'];

$sql ="INSERT INTO cars (nama_mobil, merek, tipe_mobil, harga, tahun, stok, bahan_bakar, kapasitas_mesin, transmisi, warna, kilometer, deskripsi)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssiiissssis",
    $nama_mobil,
    $merek,
    $tipe_mobil,
    $harga,
    $tahun,
    $stok,
    $bahan_bakar,
    $kapasitas_mesin,
    $transmisi,
    $warna,
    $kilometer,
    $deskripsi,
);

if (mysqli_stmt_execute($stmt)) {

    $car_id = mysqli_insert_id($conn);

    $x = count($_FILES['gambar']['name']);
    $batas_maksimal = min($x, 5); // Ambil angka terkecil antara jumlah file atau 5

    for ($i = 0; $i < $batas_maksimal; $i++) { 
        $namaFile = time() . "_" . $i . "_" . basename($_FILES['gambar']['name'][$i]);

    $target = "../uploads/" . $namaFile;

    if (move_uploaded_file(
        $_FILES['gambar']['tmp_name'][$i],
        $target
        )
    ) {
        $gambar_utama = ($i == 0) ? 1 : 0;

        $sqlImg = "INSERT INTO cars_img (car_id, gambar, gambar_utama)
        VALUES (?, ?, ?)";

        $stmtImg = mysqli_prepare($conn, $sqlImg);

        mysqli_stmt_bind_param(
            $stmtImg,
            "isi",
            $car_id,
            $namaFile,
            $gambar_utama
        );

        mysqli_stmt_execute($stmtImg);
        }
    }

    header("Location: ../dashboard/dashbarang.php");
    exit;

} else {
    echo "Error: " . mysqli_error($conn);
}