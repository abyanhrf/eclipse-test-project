<?php
session_start();
require_once "../config/database.php";

// 1. Ambil order_id dari URL
$order_id = $_GET['order_id'] ?? '';

if (empty($order_id)) {
    die("Akses ilegal: Order ID tidak ditemukan.");
}

// 2. Ambil data transaksi beserta detail mobil dari database
$sql = "SELECT t.*, c.nama_mobil, c.warna, c.transmisi 
        FROM transactions t 
        JOIN cars c ON t.car_id = c.id 
        WHERE t.order_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$transaksi = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan di database
if (!$transaksi) {
    die("Data transaksi tidak ditemukan di sistem.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= $transaksi['order_id']; ?> - ECLIPSE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050505] text-white font-[Poppins] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-[#0b1220] border border-[#1e293b] rounded-[30px] p-8 shadow-[0_10px_50px_rgba(0,0,0,0.8)]">
        
        <div class="flex justify-between items-center border-b border-white/10 pb-6 mb-6">
            <div>
                <h1 class="text-3xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-sky-400">ECLIPSE RECEIPT</h1>
                <p class="text-gray-400 text-sm mt-1">Sertifikasi Orisinal & Terpercaya</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    Paid / Sukses
                </span>
                <p class="text-gray-400 text-xs mt-2"><?= date('d M Y, H:i', strtotime($transaksi['waktu_transaksi'])); ?> WIB</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6 text-sm bg-white/5 p-4 rounded-2xl border border-white/5">
            <div>
                <p class="text-gray-400">Order ID</p>
                <p class="font-mono font-bold text-sky-400"><?= $transaksi['order_id']; ?></p>
            </div>
            <div>
                <p class="text-gray-400">Metode Pembayaran</p>
                <p class="font-semibold text-gray-200">Midtrans Payment Gateway</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-gray-400 text-sm font-semibold mb-2 uppercase tracking-wider">Detail Pengiriman</h3>
            <div class="space-y-1 text-sm bg-white/5 p-4 rounded-2xl border border-white/5">
                <p class="font-bold text-white"><?= $transaksi['nama_pembeli']; ?></p>
                <p class="text-gray-300"><?= $transaksi['email_pembeli']; ?> | <?= $transaksi['no_hp_pembeli']; ?></p>
                <p class="text-gray-400 border-t border-white/5 mt-2 pt-2 leading-relaxed"><?= $transaksi['alamat_pengiriman']; ?></p>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-gray-400 text-sm font-semibold mb-2 uppercase tracking-wider">Item Yang Dibeli</h3>
            <div class="bg-white/5 p-4 rounded-2xl border border-white/5 flex justify-between items-center">
                <div>
                    <h4 class="font-bold text-lg text-white"><?= $transaksi['nama_mobil']; ?></h4>
                    <p class="text-xs text-gray-400 mt-0.5">Spesifikasi: <?= $transaksi['warna']; ?> | <?= $transaksi['transmisi']; ?></p>
                    <p class="text-xs text-gray-400">Jumlah: 1 Unit</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400 text-xs">Total Harga</p>
                    <p class="font-bold text-purple-400 text-lg">Rp<?= number_format($transaksi['gross_amount'], 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center border-t border-white/10 pt-6">
            <p class="text-xs text-gray-500 text-center sm:text-left">
                Simpan struk digital ini sebagai bukti pemesanan unit mobil Anda di showroom ECLIPSE.
            </p>
            <div class="flex gap-3 w-full sm:w-auto">
                <button onclick="window.print()" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm transition cursor-pointer text-center">
                    Cetak Struk
                </button>
                <a href="../home/home.php" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-semibold text-sm transition text-center shadow-[0_0_15px_rgba(168,85,247,0.4)]">
                    Kembali ke Home
                </a>
            </div>
        </div>

    </div>

</body>
</html>