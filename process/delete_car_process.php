<?php

require_once '../config/database.php';

$id = $_GET['id'];

$sqlImg = "SELECT gambar FROM cars_img WHERE car_id = ?";
$sqlcar = "DELETE FROM cars WHERE id = ?";

$stmtimg = mysqli_prepare($conn, $sqlImg);
$stmtcar = mysqli_prepare($conn, $sqlcar);

mysqli_stmt_bind_param($stmtimg, "i", $id);
mysqli_stmt_bind_param($stmtcar, "i", $id);
mysqli_stmt_execute($stmtimg);

$resulting = mysqli_stmt_get_result($stmtimg);

while ($img = mysqli_fetch_assoc($resulting)) {

    $path = "../uploads/" . $img['gambar'];

    if (file_exists($path)) {
        unlink($path);
    }
}

mysqli_stmt_execute($stmtcar);

header("Location: ../dashboard/dashbarang.php");
exit;