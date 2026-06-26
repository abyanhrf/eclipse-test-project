<?php
session_start();
require_once "../config/database.php";

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    die("Akses Ditolak: Akun Administrator tidak diizinkan membuat transaksi baru.");
}

$serverKey = getenv('MIDTRANS_SERVER_KEY'); 
$clientKey = getenv('MIDTRANS_CLIENT_KEY');

$car_id = $_POST['car_id'];
$harga = $_POST['harga']; 
$nama_mobil = $_POST['nama_mobil'];
$nama_pembeli = $_POST['nama_pembeli'];
$email_pembeli = $_POST['email_pembeli'];
$no_hp_pembeli = $_POST['no_hp_pembeli'];
$alamat_pengiriman = $_POST['alamat_pengiriman'];

$order_id = "ECLIPSE-" . date('Ymd') . "-" . rand(1000, 9999);
$waktu_transaksi = date('Y-m-d H:i:s');

$sql = "INSERT INTO transactions 
        (order_id, car_id, nama_pembeli, email_pembeli, no_hp_pembeli, alamat_pengiriman, gross_amount, waktu_transaksi) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sissssss", $order_id, $car_id, $nama_pembeli, $email_pembeli, $no_hp_pembeli, $alamat_pengiriman, $harga, $waktu_transaksi);

if (mysqli_stmt_execute($stmt)) {

    $params = array(
        'transaction_details' => array(
            'order_id' => $order_id,
            'gross_amount' => (int) $harga,
        ),
        'item_details' => array(
            array(
                'id' => $car_id,
                'price' => (int) $harga,
                'quantity' => 1,
                'name' => substr($nama_mobil, 0, 50)
            )
        ),
        'customer_details' => array(
            'first_name' => $nama_pembeli,
            'email' => $email_pembeli,
            'phone' => $no_hp_pembeli,
            'billing_address' => array(
                'address' => $alamat_pengiriman
            )
        )
    );
    
    $payload = json_encode($params);

    // Inisialisasi proses cURL
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://app.sandbox.midtrans.com/snap/v1/transactions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Authorization: Basic " . base64_encode($serverKey . ":"), 
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        die("Terjadi kesalahan cURL: " . $err);
    } else {
        $result = json_decode($response);
        if (isset($result->token)) {
            $snapToken = $result->token; // Token berhasil didapat!
        } else {
            die("Gagal mendapatkan Snap Token dari Midtrans: " . $response);
        }
    }
} else {
    die("Database error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
</head>
<body class="bg-[#0b1220] text-white flex flex-col items-center justify-center min-h-screen">

    <div class="text-center animate-pulse">
        <h1 class="text-3xl font-bold mb-4">Memproses Pembayaran...</h1>
        <p class="text-gray-400">Mohon tunggu sebentar, layar pembayaran akan segera muncul.</p>
    </div>

    <script type="text/javascript">
  
    window.onload = function() {
        snap.pay('<?php echo $snapToken; ?>', {
        
        onSuccess: function(result){
            alert("Pembayaran berhasil!"); 
            window.location.href = "invoice.php?order_id=" + result.order_id ;
        },
        
        onPending: function(result){
            alert("Menunggu pembayaran Anda!"); 
        },
        
        onError: function(result){
            alert("Pembayaran gagal!"); 
        },
        
        onClose: function(){
            alert('Anda menutup layar pembayaran tanpa menyelesaikannya.');
            window.location.href = "Product.php?id=<?php echo $car_id; ?>";
        }
        
        });
    };
    </script>
</body>
</html>