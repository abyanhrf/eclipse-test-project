<?php
session_start();

// Cek apakah user sudah login. Jika belum, lempar ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.html"); 
    exit;
}

$user_id = $_SESSION['user_id']; 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "showroom_mobil"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// ========================================================
// 1. LOGIKA MENAMBAH KE KERANJANG (Dipicu dari product.php)
// ========================================================
if (isset($_GET['add_car_id'])) {
    $car_id = mysqli_real_escape_string($conn, $_GET['add_car_id']);
    
    $cek_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND car_id = '$car_id'");
    
    if (mysqli_num_rows($cek_cart) > 0) {
        // Pop-up jika mobil sudah ada di keranjang
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='background-color: #0b0b0b;'></body>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Sudah Ada!',
                text: 'Mobil ini sudah ada di dalam keranjang Anda.',
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#38bdf8'
            }).then(() => {
                window.location.href='cart.php';
            });
        </script>";
    } else {
        mysqli_query($conn, "INSERT INTO cart (user_id, car_id) VALUES ('$user_id', '$car_id')");
        // Pop-up jika berhasil dimasukkan
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='background-color: #0b0b0b;'></body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Mobil berhasil dimasukkan ke keranjang!',
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#38bdf8'
            }).then(() => {
                window.location.href='cart.php';
            });
        </script>";
    }
    exit;
}

// ========================================================
// 2. LOGIKA MENGHAPUS DARI KERANJANG
// ========================================================
if (isset($_GET['remove_cart_id'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove_cart_id']);
    
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id' AND user_id = '$user_id'");
    // Pop-up jika berhasil dihapus
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body style='background-color: #0b0b0b;'></body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: 'Mobil berhasil dihapus dari keranjang.',
            background: '#1e293b',
            color: '#ffffff',
            confirmButtonColor: '#ef4444'
        }).then(() => {
            window.location.href='cart.php';
        });
    </script>";
    exit;
}

// ========================================================
// 3. MENGAMBIL DATA UNTUK DITAMPILKAN DI HALAMAN
// ========================================================
$query = "SELECT 
            cart.id AS cart_id, 
            cart.car_id,
            cars.nama_mobil, 
            cars.merek, 
            cars.tipe_mobil,
            cars.tahun,
            cars.transmisi,
            cars.bahan_bakar,
            cars.kapasitas_mesin,
            cars.kilometer,
            cars.warna,
            cars.deskripsi, 
            cars.harga,
            (SELECT gambar FROM cars_img WHERE car_id = cars.id ORDER BY gambar_utama DESC LIMIT 1) AS gambar
          FROM cart 
          JOIN cars ON cart.car_id = cars.id 
          WHERE cart.user_id = '$user_id'";

$result = mysqli_query($conn, $query);
$jumlah_item = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<script>
function hapusKeranjang(event, id) {
    event.preventDefault(); // Mencegah link langsung berpindah
    
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Mobil ini akan dikeluarkan dari keranjang belanja Anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#475569',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        background: '#1e293b',
        color: '#ffffff'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user klik Ya, arahkan ke link penghapusan
            window.location.href = 'cart.php?remove_cart_id=' + id;
        }
    })
}
</script>

<body class="min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">

    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] mt-6">
        <div>
            <img src="../AboutUS/img/LogoProfile.png" alt="logo" class="w-10 h-10 rounded-full overflow-hidden cursor-pointer transition duration-300 hover:scale-110">
        </div>

        <div class="relative flex items-center gap-[18px]">
            <a href="../home/home.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">Home</a>
            <a href="../Product-Detailed/product.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">Product</a>
            <a href="../contact/Contact.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">Contact</a>
            <a href="../aboutus/AboutUs.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">About us</a>
        </div>

        <div class="relative flex items-center gap-5">
            <a href="../login/login.php">
                <img src="../AboutUS/img/user2.png" alt="user" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
            </a>
            <a href="cart.php">
                <img src="../AboutUS/img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
            </a>
        </div>
    </nav>

    <div class="px-10 py-8 max-w-[1200px] mx-auto">
        <p class="text-4xl font-bold">Keranjang Belanjaanmu</p>
        <p class="text-gray-400 mt-2"><?php echo $jumlah_item; ?> items</p>
    </div>

    <div class="px-10 max-w-[1200px] mx-auto">

        <?php
        if ($jumlah_item > 0) {
            
            $total_harga_semua = 0; 
            $array_car_id = [];
            
            while($row = mysqli_fetch_assoc($result)) {
                $gambar_mobil = $row['gambar'] ? $row['gambar'] : 'default_car.jpg';
                $nama_mobil   = $row['nama_mobil']; 
                $merek_mobil  = $row['merek'];      
                $desk_mobil   = $row['deskripsi'];  
                $harga_mobil  = $row['harga'];
                $total_harga_semua += $harga_mobil;
                $array_car_id[] = $row['car_id'];
                
                $tipe   = $row['tipe_mobil'];
                $tahun  = $row['tahun'];
                $trans  = $row['transmisi'];
                $bbm    = $row['bahan_bakar'];
                $cc     = $row['kapasitas_mesin'];
                $km     = $row['kilometer'];
                $warna  = $row['warna'];
                ?>
                
                <div class="p-5 bg-white/10 background-blur-md border border-white/10 flex items-center justify-between rounded-xl shadow-lg mb-6 transition-all hover:border-sky-500/50 hover:bg-white/20">
                    
                    <div class="flex items-center gap-6">
                        <img src="../uploads/<?php echo htmlspecialchars($gambar_mobil); ?>" class="w-64 h-36 object-cover rounded-lg border border-slate-700 shadow-md" alt="<?php echo htmlspecialchars($nama_mobil); ?>">

                        <div>
                            <p class="text-3xl font-bold tracking-wide">
                                <?php echo htmlspecialchars($nama_mobil); ?> 
                                <span class="text-lg font-normal text-slate-300 ml-2">(<?php echo htmlspecialchars($tahun); ?>)</span>
                            </p>

                            <p class="text-sky-400 mt-1 font-semibold text-lg">
                                <?php echo htmlspecialchars($merek_mobil); ?> &bull; <?php echo htmlspecialchars($tipe); ?>
                            </p>

                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-600">
                                    <i class="fas fa-cog mr-1"></i> <?php echo htmlspecialchars($trans); ?>
                                </span>
                                <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-600">
                                    <i class="fas fa-gas-pump mr-1"></i> <?php echo htmlspecialchars($bbm); ?>
                                </span>
                                <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-600">
                                    <?php echo htmlspecialchars($cc); ?>
                                </span>
                                <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-600">
                                    <?php echo number_format($km, 0, ',', '.'); ?> KM
                                </span>
                                <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-600">
                                    Warna: <?php echo htmlspecialchars($warna); ?>
                                </span>
                            </div>

                            <p class="text-gray-400 mt-3 max-w-lg text-sm line-clamp-2">
                                <?php echo htmlspecialchars($desk_mobil); ?>
                            </p>
                        </div>
                    </div>

                    <div class="text-right flex flex-col justify-between h-full py-2">
                        <p class="text-3xl font-bold text-shadow-white text-green-400" style="font-family: 'Poppins', sans-serif;">
                            Rp <?php echo number_format($harga_mobil, 0, ',', '.'); ?>
                        </p>
                        
                        <div class="mt-8">
                            <a href="#" 
                                onclick="hapusKeranjang(event, <?php echo $row['cart_id']; ?>)" 
                                class="text-red-400 text-sm font-semibold hover:text-red-300 transition-colors bg-red-500/10 px-4 py-2 rounded-lg hover:bg-red-500/20 text-center inline-block">
                                Hapus dari Keranjang
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            // Tampilan jika keranjang kosong
            echo "<div class='text-center py-20 bg-white/5 rounded-2xl border border-white/10'>
                    <img src='../AboutUS/img/shopping-bag.png' class='w-20 mx-auto opacity-30 invert mb-4'>
                    <p class='text-2xl text-gray-400 font-semibold'>Keranjang belanja Anda masih kosong.</p>
                    <a href='../Product-Detailed/product.php' class='inline-block mt-4 px-6 py-2 bg-sky-500 hover:bg-sky-400 text-white rounded-lg transition-colors'>Lihat Produk</a>
                  </div>";
        }
        ?>

    </div>

    <div class="px-10 mt-8 flex flex-col items-end max-w-[1200px] mx-auto">
        <?php if($jumlah_item > 0): ?>
            <p class="text-gray-400 mb-2">Total Pembayaran Keseluruhan:</p>
            <p class="text-4xl font-bold text-sky-400 mb-6">Rp <?php echo number_format($total_harga_semua, 0, ',', '.'); ?></p>

            <button onclick="openModal()" class="px-10 py-4 rounded-xl bg-sky-500 text-white font-bold text-xl transition duration-300 hover:bg-sky-400 hover:scale-105 hover:shadow-[0_0_20px_rgba(56,189,248,0.7)] flex items-center gap-3">
                Checkout Semua Items
            </button>
        <?php endif; ?>
    </div>

    <?php 
    if($jumlah_item > 0) {
        $is_cart_mode = true; 
        include '../components/checkout-modal.php'; 
    }
    ?>

    <footer class="bg-black/40 border-t border-white/10 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12 text-center md:text-left">
            <div class="border-t border-white/10 pt-6 text-gray-500 text-sm">
                © 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>