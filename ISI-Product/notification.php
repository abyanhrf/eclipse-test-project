<?php
require_once "../config/database.php";

$json_result = file_get_contents('php://input');
$result = json_decode($json_result, true);

if (!$result) {
    die("Akses ditolak.");
}

$order_id = $result['order_id'];
$transaction_status = $result['transaction_status'];
$status_code = $result['status_code'];

if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
    
    $sql_update_tx = "UPDATE transactions SET transaction_status = 'settlement' WHERE order_id = ?";
    $stmt_tx = mysqli_prepare($conn, $sql_update_tx);
    mysqli_stmt_bind_param($stmt_tx, "s", $order_id);
    mysqli_stmt_execute($stmt_tx);

    $sql_get_car = "SELECT car_id FROM transactions WHERE order_id = ?";
    $stmt_get = mysqli_prepare($conn, $sql_get_car);
    mysqli_stmt_bind_param($stmt_get, "s", $order_id);
    mysqli_stmt_execute($stmt_get);
    $res = mysqli_stmt_get_result($stmt_get);

    while ($row = mysqli_fetch_assoc($res)) {
        $car_id = $row['car_id'];
        
        $sql_update_stock = "UPDATE cars SET stok = stok - 1 WHERE id = ?";
        $stmt_stock = mysqli_prepare($conn, $sql_update_stock);
        mysqli_stmt_bind_param($stmt_stock, "i", $car_id);
        mysqli_stmt_execute($stmt_stock);
    }
}

echo "OK"; 
?>