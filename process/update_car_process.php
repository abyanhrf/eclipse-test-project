<?php
require_once '../config/database.php';

$id = $_POST['id'];
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
$gambar = $_FILES['gambar'];
$gambar_lama = $_POST['gambar_lama'];

$sql = "
UPDATE cars SET nama_mobil = ?, merek = ?, tipe_mobil = ?, harga = ?, tahun = ?, stok = ?,
bahan_bakar = ?, kapasitas_mesin = ?, transmisi = ?, warna = ?, kilometer = ?, deskripsi = ?
WHERE id = ?
";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare gagal: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "sssiiissssisi",
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
    $id
);

if (mysqli_stmt_execute($stmt)) {

    if ($gambar['error'] == 0) {

    $namaFile = time() . "_" . basename($gambar['name']);

    $target = "../uploads/" . $namaFile;

        if (!move_uploaded_file(
            $gambar['tmp_name'],
            $target
                )) {
            die("Gagal upload gambar baru");
            }

        $fileLama = "../uploads/" . $gambar_lama;

        if (file_exists($fileLama)) {
            unlink($fileLama);
        }

        $sqlImg = "
            UPDATE cars_img
            SET gambar = ?
            WHERE car_id = ?
        ";

        $stmtImg = mysqli_prepare($conn, $sqlImg);

        mysqli_stmt_bind_param(
            $stmtImg,
            "si",
            $namaFile,
            $id
        );

    mysqli_stmt_execute($stmtImg);
    }
    header("Location: ../dashboard/dashbarang.php");
    exit;
    
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

