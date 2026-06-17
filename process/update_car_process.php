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

    $sql = 
    " UPDATE cars SET nama_mobil = ?, merek = ?, tipe_mobil = ?, harga = ?, tahun = ?, stok = ?, 
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

    if (!empty($_FILES['gambar_baru']['name'][0])) {
        
        $x = count($_FILES['gambar_baru']['name']);
        
        for ($i = 0; $i < $x; $i++) { 
            $namaFile = time() . "_" . $i . "_" . basename($_FILES['gambar_baru']['name'][$i]);
            $target = "../uploads/" . $namaFile;
            
            if (move_uploaded_file($_FILES['gambar_baru']['tmp_name'][$i],$target)) {
                $gambar_utama = 0;
                $sqlImg = "INSERT INTO cars_img (car_id, gambar,gambar_utama) VALUES (?, ?, ?)";

                $stmtImg = mysqli_prepare($conn, $sqlImg);

                mysqli_stmt_bind_param(
                $stmtImg,
                "isi",
                $id,
                $namaFile,
                $gambar_utama
                );

                mysqli_stmt_execute($stmtImg);
            }
        }
    }

    header("Location: ../dashboard/dashbarang.php");
    exit;
    
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

