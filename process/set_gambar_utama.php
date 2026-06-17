<?php

require_once '../config/database.php';

$id = $_GET['id'];
$car_id = $_GET['car_id'];

$sqlReset = "
UPDATE cars_img
SET gambar_utama = 0
WHERE car_id = ?
";

$stmtReset = mysqli_prepare($conn, $sqlReset);

mysqli_stmt_bind_param(
    $stmtReset,
    "i",
    $car_id
);

mysqli_stmt_execute($stmtReset);

$sqlUtama = "
UPDATE cars_img
SET gambar_utama = 1
WHERE id = ?
";

$stmtUtama = mysqli_prepare($conn, $sqlUtama);

mysqli_stmt_bind_param(
    $stmtUtama,
    "i",
    $id
);

mysqli_stmt_execute($stmtUtama);

header("Location: ../dashboard/edit_car.php?id=" . $car_id);
exit;