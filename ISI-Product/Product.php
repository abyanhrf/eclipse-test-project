<?php
    session_start();
    require_once "../config/database.php";

    $id = $_GET['id'] ?? 0;

    $sqlCar = "SELECT * FROM cars WHERE id = ?";

    $sqlImg = "SELECT * FROM cars_img WHERE car_id = ?
    ORDER BY gambar_utama DESC 
    ";

    $stmtCar = mysqli_prepare($conn,$sqlCar);
    $stmtImg = mysqli_prepare($conn,$sqlImg);

    mysqli_stmt_bind_param(
        $stmtCar,
        "i",
        $id
        );

    mysqli_stmt_bind_param($stmtImg,
    "i",
    $id
    );

    mysqli_stmt_execute($stmtCar);
    $resultCar = mysqli_stmt_get_result($stmtCar);
    $car = mysqli_fetch_assoc($resultCar);
    if (!$car) {
    die("Produk tidak ditemukan");
}

    mysqli_stmt_execute($stmtImg);
    $resultImg = mysqli_stmt_get_result($stmtImg);

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahan Google Font Poppins agar font-sans seragam -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Eclipse</title>
</head>

<body class="font-[Poppins] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(56,189,248,0.15),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.1),transparent_25%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
    
    <!-- NAVBAR -->
    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] mt-4">
    
        <div>
            <img src="img/LogoProfile.png" alt="logo"
            class="w-10 h-10 rounded-full overflow-hidden cursor-pointer transition duration-300 hover:scale-110">
        </div>

        <div class="relative flex items-center gap-[18px]">
            <a href="../home/home.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Home
            </a>

            <a href="../Product-Detailed/product.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 bg-sky-400 text-white shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] [text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Product
            </a>

            <a href="../contact/Contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Contact
            </a>

            <a href="../AboutUS/AboutUs.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                About us
            </a>
        </div>

        <div class="flex items-center gap-4 shrink-0">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div class="relative group">
                    <button class="flex items-center gap-2 text-white font-semibold hover:text-sky-400 transition duration-300 whitespace-nowrap">
                        <img src="../home/img/user2.png" alt="user" class="w-6 h-6 invert">
                        <?= $_SESSION['nama']; ?>
                    </button>

                    <div class="absolute right-0 top-full pt-3 w-40 hidden group-hover:block z-50">
                        <div class="bg-neutral-900 border border-white/10 rounded-lg shadow-lg overflow-hidden">
                            <a href="../profile/profile.php"
                            class="block px-4 py-2 text-sm text-gray-200 hover:text-white hover:bg-sky-500 transition">
                            Profil Saya
                            </a>
                            <a href="../process/logout.php"
                            class="block px-4 py-2 text-sm text-red-400 hover:bg-red-950/40 transition border-t border-white/5">
                            Logout
                            </a>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <a href="../login/login.php">
                    <img src="img/user2.png" alt="user" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') : ?>
                <a href="../dashboard/dashboard.php" class="px-4 py-1.5 rounded-full bg-sky-500 text-white text-sm font-semibold hover:bg-sky-400 transition shadow-[0_0_10px_rgba(56,189,248,0.4)] whitespace-nowrap">
                    Dashboard
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    
    <!-- MAIN CONTENT CONTAINER -->
    <main class="w-[90%] max-w-[1200px] mx-auto mt-10 px-4">
        
        <!-- HEADER TITLE -->
        <div class="text-center py-6">
            <h1 class="text-white text-4xl font-bold tracking-wide drop-shadow-[0_0_15px_rgba(56,189,248,0.3)]">
                <?= $car['nama_mobil'];?>
            </h1>
        </div>

        <!-- PRODUCT DETAIL GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-6">
            
            <!-- LEFT COLUMN: IMAGES & DESCRIPTION -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- IMAGE GALLERY CARD -->
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-5 backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                    <?php
                    $index = 0;
                    $gambarUtama = mysqli_fetch_assoc($resultImg);
                    ?>

                    <img id="mainImage" src="../uploads/<?= $gambarUtama['gambar']; ?>" 
                         class="w-full h-[450px] object-cover rounded-[20px] shadow-lg border border-white/5">
                        
                    <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                        <?php
                        mysqli_data_seek($resultImg, 0);
                        while($img = mysqli_fetch_assoc($resultImg)) :
                        ?>
                        <img src="../uploads/<?= $img['gambar']; ?>"
                             class="thumbnail w-28 h-20 object-cover cursor-pointer rounded-xl transition duration-300 hover:opacity-100 <?= $index==0 ? 'border-2 border-sky-400 shadow-[0_0_10px_#38bdf8]' : 'border border-white/10 opacity-60'; ?>">
                        <?php $index++; endwhile; ?>
                    </div> 
                </div>   

                <!-- SPECIFICATIONS & DESCRIPTION CARD -->
                <div class="bg-white/5 border border-white/10 rounded-[30px] backdrop-blur-md p-8 shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                    <h2 class="text-2xl text-white font-bold mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-sky-400 rounded-full"></span> Detail Kendaraan
                    </h2>

                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-gray-200 border-b border-white/10 pb-6 mb-6">
                        <li class="flex items-center gap-2"><span class="text-sky-400 font-bold">•</span> Tahun: <?= $car['tahun']; ?></li>
                        <li class="flex items-center gap-2"><span class="text-sky-400 font-bold">•</span> Kilometer: <?= $car['kilometer']; ?></li>
                        <li class="flex items-center gap-2"><span class="text-sky-400 font-bold">•</span> Transmisi: <?= $car['transmisi']; ?> Transmission</li>
                        <li class="flex items-center gap-2"><span class="text-sky-400 font-bold">•</span> Warna: <?= $car['warna']; ?></li>
                        <li class="flex items-center gap-2"><span class="text-sky-400 font-bold">•</span> Mesin: <?= $car['kapasitas_mesin'] ?></li>
                    </ul>

                    <div>
                        <h3 class="text-lg font-semibold text-sky-400 mb-2">Deskripsi</h3>
                        <p class="text-gray-300 leading-relaxed">
                            <?= nl2br($car['deskripsi']); ?>
                        </p>
                    </div>
                </div>
            </div> 

            <!-- RIGHT COLUMN: PRICE & ACTION PANEL -->
            <div class="flex flex-col gap-6">
                
                <!-- PRICE CARD -->
                <div class="bg-white/10 border border-white/15 rounded-[30px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] p-8 relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl"></div>
                    
                    <p class="text-sky-400 text-xs font-semibold tracking-wider uppercase mb-1">Harga Spesial</p>
                    <h2 class="text-4xl font-extrabold text-white tracking-tight [text-shadow:0_0_15px_rgba(56,189,248,0.2)]">
                         Rp<?= number_format($car['harga'],0,',','.'); ?>
                    </h2>
                    <p class="text-gray-400 text-xs mt-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Harga dapat berubah sewaktu-waktu
                    </p>
                </div>

                <!-- FAST SPECS GRID CARD -->
                <div class="bg-white/5 border border-white/10 rounded-[30px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.2)] p-6">
                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Bahan Bakar</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['bahan_bakar']; ?></h3>
                        </div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Transmisi</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['transmisi']; ?></h3>
                        </div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Tahun</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['tahun']; ?></h3>
                        </div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Kapasitas</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['kapasitas_mesin']; ?></h3>
                        </div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Warna</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['warna']; ?></h3>
                        </div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5">
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Kilometer</p>
                            <h3 class="font-bold text-white mt-0.5 text-sm"><?= $car['kilometer']; ?></h3>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Stok Tersedia:</p>
                            <h3 class="font-bold"><?= $car['stok']; ?></h3>
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="grid grid-cols-1 gap-3 mt-2">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
        
                        <div class="w-full bg-red-500/10 border border-red-500/20 text-red-400 font-semibold py-4 rounded-[20px] text-center text-sm tracking-wider">
                            MODE ADMIN: TRANSAKSI DINONAKTIFKAN
                        </div>

                    <?php else : ?>

                        <button type="button" onclick="handlePesan(<?= $car['stok']; ?>)"
                            class="w-full bg-sky-500 rounded-[20px] py-4 text-white font-bold cursor-pointer transition duration-300 hover:bg-sky-400 hover:shadow-[0_0_20px_rgba(56,189,248,0.6)] shadow-lg tracking-wider">
                            PESAN SEKARANG
                        </button>

                        <a href="../cart/cart.php?add_car_id=<?= $car['id']; ?>"
                            data-stok="<?= $car['stok']; ?>"
                            class="w-full bg-white/10 border border-white/10 rounded-[20px] py-4 text-white font-bold flex items-center justify-center transition duration-300 hover:bg-white/20 tracking-wider">
                            MASUKKAN KE CART
                        </a>

                    <?php endif; ?>
                </div>

            </div> 
        </div> 

        <!-- ANOTHER PRODUCT SECTION -->
        <h1 class="text-white text-2xl font-bold mt-16 mb-6 tracking-wide flex items-center gap-3">
            <span class="w-2 h-2 bg-sky-400 rounded-full animate-pulse"></span> ANOTHER PRODUCT
        </h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
            <?php
                // Casting $id menjadi integer untuk keamanan
                $current_id = (int)$id;

                $sql = "
                SELECT
                cars.id,
                cars.nama_mobil,
                cars.harga,
                cars.deskripsi,
                cars_img.gambar
                FROM cars
                LEFT JOIN cars_img
                ON cars.id = cars_img.car_id
                WHERE cars_img.gambar_utama = 1 AND cars.id != $current_id
                ORDER BY RAND() 
                LIMIT 4";
                
                $result = mysqli_query($conn, $sql);
            ?>
            
            <?php while($otherCar = mysqli_fetch_assoc($result)) : ?>
            
            <a href="Product.php?id=<?= $otherCar['id']; ?>" class="group">
                <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden backdrop-blur-md transition duration-300 hover:border-sky-500/50 hover:shadow-[0_0_20px_rgba(56,189,248,0.2)] flex flex-col h-full">
                    
                    <div class="bg-neutral-900/50 p-4 flex items-center justify-center h-48 border-b border-white/5">
                        <img src="../uploads/<?= $otherCar['gambar']; ?>" 
                            alt="<?= $otherCar['nama_mobil']; ?>" 
                            class="max-w-full max-h-full object-contain transition duration-300 group-hover:scale-105">
                    </div>

                    <div class="p-4 flex-grow flex items-center justify-center bg-gradient-to-b from-transparent to-black/20">
                        <h2 class="text-white text-center font-medium group-hover:text-sky-400 transition duration-300">
                            <?= $otherCar['nama_mobil']; ?>
                        </h2>
                    </div>
                </div>
            </a>

            <?php endwhile; ?>
        </div>
        
    </main>
    
    <!-- MODAL INJECTION -->
    <?php include '../components/checkout-modal.php'; ?>

    <!-- FOOTER -->
    <footer class="bg-black/40 border-t border-white/10 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-widest text-shadow-[0_0_10px_rgba(255,255,255,0.1)]">
                        ECLIPSE
                    </h2>
                    <p class="text-gray-400 mt-4 leading-relaxed text-sm">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
                    </p>
                </div>

                <div>
                    <h3 class="text-white font-semibold text-lg mb-4 text-sky-400">
                        Navigation
                    </h3>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="../home/home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="../contact/Contact.php" class="hover:text-sky-400 transition">Contact</a></li>
                        <li><a href="../aboutus/AboutUs.php " class="hover:text-sky-400 transition">About us</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold text-lg mb-4 text-sky-400">
                        Contact
                    </h3>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold text-lg mb-4 text-sky-400">
                        Follow Us
                    </h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8] group">
                            <img src="img/ig.svg" class="w-5 invert opacity-70 group-hover:opacity-100">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8] group">
                            <img src="img/fb.svg" class="w-5 invert opacity-70 group-hover:opacity-100">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8] group">
                            <img src="img/tiktok.svg" class="w-5 invert opacity-70 group-hover:opacity-100">
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 mt-10 pt-6 text-center text-gray-500 text-xs tracking-wider">
                &copy; 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE GALLERY SCRIPT -->
    <script>
        const mainImage = document.getElementById("mainImage");
        const thumbnails = document.querySelectorAll(".thumbnail");

        thumbnails.forEach((thumb) => {
            thumb.addEventListener("click", function () {
                // Ganti source gambar utama
                mainImage.src = this.src;

                // Reset kelas border & opacity seluruh thumbnail ke keadaan semula
                thumbnails.forEach((item) => {
                    item.classList.remove("border-2", "border-sky-400", "shadow-[0_0_10px_#38bdf8]", "opacity-100");
                    item.classList.add("border-white/10", "opacity-60");
                });

                // Terapkan glow & border aktif (warna biru langit) pada thumbnail terpilih
                this.classList.remove("border-white/10", "opacity-60");
                this.classList.add("border-2", "border-sky-400", "shadow-[0_0_10px_#38bdf8]", "opacity-100");
            });
        });

        function openModal() {
            document.getElementById('checkoutModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('checkoutModal').classList.add('hidden');
        }

        function handlePesan(stok) {
        if (stok <= 0) {
            alert("Maaf saat ini stok sedang habis");
        } else {
            // Jika stok ada, jalankan fungsi membuka modal bawaanmu
            openModal();
        }
    }

    </script>
    
    <!-- SWEETALERT AJAX HANDLER -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tombolCart = document.querySelector('a[href*="add_car_id="]');
    
        if (tombolCart) {
            tombolCart.addEventListener("click", function(event) {
                event.preventDefault(); // Cegah pindah halaman
            
                // 1. Cek stok terlebih dahulu sebelum melakukan fetch
                const stok = parseInt(this.getAttribute('data-stok'));
            
                if (stok <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Habis',
                        text: 'Maaf saat ini stok mobil sedang habis.',
                        background: '#0f172a',
                        color: '#ffffff',
                        confirmButtonColor: '#ef4444'
                    });
                    return; // Hentikan eksekusi di sini, jangan lanjut fetch
                }
            
                // 2. Jika stok aman, baru lakukan proses masukkan ke keranjang (Fetch)
                const urlTujuan = this.href; 
            
                fetch(urlTujuan)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Mobil berhasil dimasukkan ke keranjang!',
                                background: '#0f172a',
                                color: '#ffffff',
                                confirmButtonColor: '#38bdf8'
                            });
                        } else if (data.status === 'already_exists') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Sudah Ada!',
                            });
                        } else if (data.status === 'admin_blocked') { // <-- TAMBAHAN BARU
                            Swal.fire({
                                icon: 'error',
                                title: 'Akses Ditolak',
                                text: 'Akun Administrator tidak diizinkan melakukan pembelian.',
                                background: '#0f172a',
                                color: '#ffffff',
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat memproses data.',
                            background: '#0f172a',
                            color: '#ffffff',
                            confirmButtonColor: '#ef4444'
                        });
                    });
            });
        }
    });
    </script>
</body>
</html>