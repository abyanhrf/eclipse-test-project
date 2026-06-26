<?php
session_start();
require_once "../config/database.php";

// 1. Ambil order_id dari URL
$order_id = $_GET['order_id'] ?? '';

if (empty($order_id)) {
    die("Akses ilegal: Order ID tidak ditemukan.");
}

// 2. Ambil SEMUA data transaksi beserta detail mobil dari database
// Aku menambahkan c.harga agar kita bisa memunculkan harga satuan tiap mobil
$sql = "SELECT t.*, c.nama_mobil, c.warna, c.transmisi, c.harga 
        FROM transactions t 
        JOIN cars c ON t.car_id = c.id 
        WHERE t.order_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 3. Masukkan semua hasil pencarian ke dalam Array
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

// Jika data sama sekali tidak ditemukan
if (empty($items)) {
    die("Data transaksi tidak ditemukan di sistem.");
}

// 4. Ambil informasi pembeli dari baris pertama (karena datanya pasti sama untuk 1 order_id)
$transaksi_umum = $items[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-black via-red-950 to-black text-white font-[Poppins] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-[#130000] border border-[#150101] rounded-[30px] p-8 shadow-[0_10px_50px_rgba(0,0,0,0.8)]">
        
        <div class="flex justify-between items-center border-b border-white/10 pb-6 mb-6">
            <div>
                <h1 class="text-3xl text-white font-bold tracking-wider bg-clip-text">ECLIPSE RECEIPT</h1>
                <p class="text-gray-400 text-sm mt-1">Luxury Car Dealer</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase bg-zinc-900 text-amber-300 border border-emerald-500/20">
                    Paid / Sukses
                </span>
                <p class="text-gray-400 text-xs mt-2"><?= date('d M Y, H:i', strtotime($transaksi_umum['waktu_transaksi'])); ?> WIB</p>
            </div>
        </div>

        <h3 class="text-gray-400 text-sm font-semibold mb-2 uppercase tracking-wider">ID Pembayaran</h3>
        <div class="grid grid-cols-2 gap-4 mb-6 text-sm bg-white/5 p-4 rounded-2xl border border-white/5">
            <div>
                <p class="text-gray-400">Order ID</p>
                <p class="font-mono font-bold text-sky-400"><?= $transaksi_umum['order_id']; ?></p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-gray-400 text-sm font-semibold mb-2 uppercase tracking-wider">Detail Pembelian</h3>
            <div class="space-y-1 text-sm bg-white/5 p-4 rounded-2xl border border-white/5">
                <p class="font-bold text-white">Nama Pembeli    : </p>
                <p class="text-gray-300"><?= htmlspecialchars($transaksi_umum['nama_pembeli']); ?></p>
                <p class="text-white mt-2">Email/Nomor  : </p>
                <p class="text-gray-300"><?= htmlspecialchars($transaksi_umum['email_pembeli']); ?> / <?= htmlspecialchars($transaksi_umum['no_hp_pembeli']); ?></p>
                <p class="text-white mt-2">Alamat       : </p>
                <p class="text-gray-300"><?= htmlspecialchars($transaksi_umum['alamat_pengiriman']); ?></p>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-gray-400 text-sm font-semibold mb-2 uppercase tracking-wider">Daftar Item</h3>
            
            <div class="bg-white/5 rounded-2xl border border-white/5 overflow-hidden">
                
                <?php foreach ($items as $item): ?>
                <div class="p-4 border-b border-white/5 flex justify-between items-center last:border-b-0">
                    <div>
                        <h4 class="font-bold text-lg text-white"><?= htmlspecialchars($item['nama_mobil']); ?></h4>
                        <p class="text-xs text-gray-400 mt-0.5">Spesifikasi: <?= htmlspecialchars($item['warna']); ?> | <?= htmlspecialchars($item['transmisi']); ?></p>
                        <p class="text-xs text-gray-400 mt-1">Jumlah: 1 Unit</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 text-xs mb-1">Harga Satuan</p>
                        <p class="font-bold text-white text-md">Rp<?= number_format($item['harga'], 0, ',', '.'); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="p-4 bg-black/40 flex justify-between items-center border-t border-white/10">
                    <div>
                        <p class="font-bold text-gray-300 text-sm">TOTAL</p>
                    </div>
                    <p class="font-bold text-emerald-400 text-xl">Rp<?= number_format($transaksi_umum['gross_amount'], 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center border-t border-white/10 pt-6">
            <p class="text-xs text-gray-500 text-center sm:text-left">
                Struk digital dapat digunakan sebagai bukti pembayaran yang sah pada Eclipse.
            </p>
            <div class="flex gap-3 w-full sm:w-auto">
                <button onclick="window.print()" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm transition cursor-pointer text-center">
                    Cetak Struk
                </button>
                <a href="../home/home.php" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-400 text-white font-semibold text-sm transition text-center shadow-[0_0_15px_rgba(56,189,248,0.4)]">
                    Kembali ke Home
                </a>
            </div>
        </div>

    </div>

</body>
</html>