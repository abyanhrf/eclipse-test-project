<?php

    require_once '../config/database.php';

    $id = $_GET['id'];
    $car_id = $_GET['car_id'];

    $sql = "SELECT * FROM cars_img WHERE id = ? ";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $img = mysqli_fetch_assoc($result);

    $sqlCount = "SELECT COUNT(*) as total FROM cars_img WHERE car_id = ?";
    $stmtCount = mysqli_prepare($conn, $sqlCount);
    
    mysqli_stmt_bind_param(
        $stmtCount,
        "i",
        $car_id
    );

    mysqli_stmt_execute($stmtCount);
    $resultCount = mysqli_stmt_get_result($stmtCount);
    $dataCount = mysqli_fetch_assoc($resultCount);

    if ($dataCount['total'] <= 1) {
        die("Minimal harus ada satu gambar.");
    }

    $path = "../uploads/" . $img['gambar'];

    if (file_exists($path)) {
        unlink($path);
    }

    $sqlDelete = "DELETE FROM cars_img WHERE id = ?";

    $stmtDelete = mysqli_prepare($conn, $sqlDelete);

    mysqli_stmt_bind_param(
        $stmtDelete,
        "i",
        $id
    );

    mysqli_stmt_execute($stmtDelete);

    if ($img['gambar_utama']) {
        $sqlNewMain = "UPDATE cars_img SET gambar_utama = 1 WHERE car_id = ? LIMIT 1";

        $stmtMain = mysqli_prepare($conn, $sqlNewMain);

        mysqli_stmt_bind_param(
            $stmtMain,
            "i",
            $car_id
        );

        mysqli_stmt_execute($stmtMain);
    }

    header("Location: ../dashboard/edit_car.php?id=" . $car_id);
exit;