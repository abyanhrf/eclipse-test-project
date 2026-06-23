<?php
session_start();
require_once "../config/database.php";

// Ambil Key langsung dari environment laptopmu seperti checkout tunggal
$serverKey = getenv('MIDTRANS_SERVER_KEY'); 
$clientKey = getenv('MIDTRANS_CLIENT_KEY');

// 1. Tangkap data dari form Cart
$total_harga = $_POST['total_harga'] ?? 0;
$kumpulan_car_id = $_POST['kumpulan_car_id'] ?? '';
$nama_pembeli = $_POST['nama_pembeli'] ?? '';
$email_pembeli = $_POST['email_pembeli'] ?? '';
$no_hp_pembeli = $_POST['no_hp_pembeli'] ?? '';
$alamat_pengiriman = $_POST['alamat_pengiriman'] ?? '';
$user_id = $_SESSION['user_id'];

if (empty($kumpulan_car_id) || empty($total_harga)) {
    die("Keranjang kosong atau data tidak valid.");
}

// 2. Buat Order ID unik khusus Keranjang (Cart)
$order_id = "ECLIPSE-CART-" . date('Ymd') . "-" . rand(1000, 9999);
$waktu_transaksi = date('Y-m-d H:i:s');

// 3. Ubah string ID (contoh: "21,24") menjadi array [21, 24]
$array_mobil = explode(',', $kumpulan_car_id);
$item_details = [];

// 4. Looping untuk mencatat ke database & menyusun detail barang untuk Midtrans
foreach ($array_mobil as $car_id) {
    $car_id = (int)$car_id;
    
    // Ambil detail nama mobil dan harga dari database untuk dikirim ke Midtrans
    $res_car = mysqli_query($conn, "SELECT nama_mobil, harga FROM cars WHERE id = $car_id");
    if ($row_car = mysqli_fetch_assoc($res_car)) {
        
        // Susun array item untuk Midtrans
        $item_details[] = array(
            'id' => $car_id,
            'price' => (int) $row_car['harga'],
            'quantity' => 1,
            'name' => substr($row_car['nama_mobil'], 0, 50)
        );
        
        // Simpan ke tabel transactions satu per satu dengan order_id yang SAMA
        $sql = "INSERT INTO transactions 
                (order_id, car_id, nama_pembeli, email_pembeli, no_hp_pembeli, alamat_pengiriman, gross_amount, waktu_transaksi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sissssss", $order_id, $car_id, $nama_pembeli, $email_pembeli, $no_hp_pembeli, $alamat_pengiriman, $total_harga, $waktu_transaksi);
        mysqli_stmt_execute($stmt);
    }
}

// 5. Hapus seluruh isi keranjang pembeli karena sudah masuk proses pembayaran
mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

// 6. Susun Parameter JSON untuk dikirim ke Midtrans via cURL
$params = array(
    'transaction_details' => array(
        'order_id' => $order_id,
        'gross_amount' => (int) $total_harga,
    ),
    'item_details' => $item_details, // Berisi daftar semua mobil yang dibeli
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

// 7. Eksekusi Tembak API Midtrans menggunakan cURL (Sama persis dengan kodemu)
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
        $snapToken = $result->token; // Token sukses didapatkan!
    } else {
        die("Gagal mendapatkan Snap Token dari Midtrans: " . $response);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran ECLIPSE - Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
</head>
<body class="bg-[#0b1220] text-white flex flex-col items-center justify-center min-h-screen">

    <div class="text-center animate-pulse">
        <h1 class="text-3xl font-bold mb-4 text-sky-400">Memproses Keranjang...</h1>
        <p class="text-gray-400">Mohon tunggu sebentar, layar pembayaran Midtrans akan segera muncul.</p>
    </div>

    <script type="text/javascript">
    window.onload = function() {
        snap.pay('<?php echo $snapToken; ?>', {
            
            onSuccess: function(result){
                alert("Pembayaran keranjang berhasil!"); 
                // Diarahkan ke invoice dengan membawa order_id baru
                window.location.href = "invoice_cart.php?order_id=" + result.order_id; 
            },
            
            onPending: function(result){
                alert("Menunggu pembayaran Anda!"); 
                window.location.href = "cart.php";
            },
            
            onError: function(result){
                alert("Pembayaran gagal!"); 
                window.location.href = "cart.php";
            },
            
            onClose: function(){
                alert('Anda menutup layar pembayaran tanpa menyelesaikannya.');
                window.location.href = "cart.php";
            }
            
        });
    };
    </script>
</body>
</html>