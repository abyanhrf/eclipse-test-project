<?php
    session_start();
    require_once "../config/database.php";

    $id = $_GET['id'] ?? 0;

    $sqlCar = "SELECT * FROM cars WHERE id = ?";
    $sqlImg = "SELECT * FROM cars_img WHERE car_id = ? ORDER BY gambar_utama DESC";

    $stmtCar = mysqli_prepare($conn, $sqlCar);
    $stmtImg = mysqli_prepare($conn, $sqlImg);

    mysqli_stmt_bind_param($stmtCar, "i", $id);
    mysqli_stmt_bind_param($stmtImg, "i", $id);

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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(168,85,247,0.25),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(56,189,248,0.2),transparent_25%),linear-gradient(135deg,#050505,#0a0a0f,#12121a)]">
    
    <nav class="w-[90%] max-w-[1200px] mx-auto mt-6 px-10 py-4 flex items-center justify-between bg-white/5 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.5)]">
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

            <a href="aboutus.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                About us
            </a>
        </div>

        <div class="flex items-center gap-5">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div class="relative group">
                    <button class="flex items-center gap-2 mr-5 text-white font-semibold hover:text-sky-400 transition duration-300">
                        <img src="../home/img/user2.png" alt="user" class="w-6 h-6 invert">
                        <?= $_SESSION['nama']; ?>
                    </button>

                    <div class="absolute right-0 top-[95%] pt-2 w-40 hidden group-hover:block z-50">
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
                <a href="../dashboard/dashboard.php" class="px-4 py-1.5 rounded-full bg-sky-500 text-white text-sm font-semibold hover:bg-sky-400 transition shadow-[0_0_10px_rgba(56,189,248,0.4)]">
                    Admin
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    
    <section class="max-w-5xl mx-auto py-10"><section class="bg-black py-10">

    <h1 class="text-white text-3xl font-sans font-bold text-center">
      <?= $car['nama_mobil'];?>
    </h1>

  </section>
  <section class="max-w-6xl mx-auto py-10 px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
         <div class="lg:col-span-2">

        <div class="bg-black p-4">

        <?php
        $index = 0;
        $gambarUtama = mysqli_fetch_assoc($resultImg);
        ?>

        <img
        id="mainImage"
        src="../uploads/<?= $gambarUtama['gambar']; ?>"
        class="w-full h-[450px] object-cover">
            
          <div class="flex gap-3 mt-4">
            <?php
            mysqli_data_seek($resultImg,0);
            while($img = mysqli_fetch_assoc($resultImg)) :
            ?>

            <img src="../uploads/<?= $img['gambar']; ?>"
            class="thumbnail w-28 h-20 object-cover cursor-pointer
            <?= $index==0 ? 'border-4 border-purple-600' : ''; ?>">

            <?php $index++; endwhile; ?>
        </div>    

    <div class=" mt-6 p-6">

          <h2 class="text-2xl text-white font-sans font-bold mb-4">
            <?= $car['nama_mobil']; ?>
          </h2>

          <ul class="space-y-2 font-sans text-white">

            <li>• <?= $car['tahun']; ?></li>
            <li>• Kilometer <?= $car['kilometer']; ?></li>
            <li>• <?= $car['transmisi']; ?> Transmission</li>
            <li>• Warna <?= $car['warna']; ?></li>
            <li>• Mesin <?= $car['kapasitas_mesin'] ?></li>
          </ul>
        </div>
        <div>
            <p class="text-white font-sans mt-6">
                <?= nl2br($car['deskripsi']); ?>
            </p>
        </div>

        <div class="bg-zinc-900/60 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-[0_12px_40px_rgba(0,0,0,0.7)]">
            
            <h2 class="text-2xl md:text-3xl font-bold text-center text-white mb-8 border-b border-white/5 pb-4">
                <?= htmlspecialchars($car['nama_mobil']); ?>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-black/40 border border-white/10 rounded-2xl p-3 flex items-center justify-center overflow-hidden">
                        <?php
                        $index = 0;
                        $gambarUtama = mysqli_fetch_assoc($resultImg);
                        ?>
                        <img id="mainImage" src="../uploads/<?= $gambarUtama['gambar']; ?>" class="w-full h-[300px] md:h-[420px] object-cover rounded-xl transition duration-500">
                    </div>
                    
                    <div class="flex gap-3 overflow-x-auto py-2">
                        <?php
                        mysqli_data_seek($resultImg, 0);
                        while($img = mysqli_fetch_assoc($resultImg)) :
                        ?>
                        <img src="../uploads/<?= $img['gambar']; ?>" 
                             class="thumbnail w-24 h-16 md:w-28 md:h-20 object-cover cursor-pointer rounded-lg opacity-70 hover:opacity-100 transition border-2 <?= $index==0 ? 'border-purple-500 opacity-100 shadow-[0_0_10px_#a855f7]' : 'border-transparent'; ?>">
                        <?php $index++; endwhile; ?>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-inner">
                        <h3 class="text-3xl font-black text-white tracking-wide">
                            Rp<?= number_format($car['harga'], 0, ',', '.'); ?>
                        </h3>
                        <p class="text-xs text-gray-400 mt-2 italic">Harga dapat berubah sewaktu-waktu</p>
                        
                        <div class="flex gap-2 mt-4">
                            <button class="flex-1 bg-zinc-800 text-xs font-semibold py-2 rounded-lg border border-white/10 hover:bg-zinc-700 transition">Kredit</button>
                            <button class="flex-1 bg-purple-600 text-xs font-semibold py-2 rounded-lg shadow-[0_0_15px_rgba(168,85,247,0.5)] transition">Tunai</button>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Bahan Bakar</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['bahan_bakar']); ?></h4>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Transmisi</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['transmisi']); ?></h4>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Tahun</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['tahun']); ?></h4>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Kapasitas</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['kapasitas_mesin']); ?></h4>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Warna</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['warna']); ?></h4>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider">Kilometer</p>
                            <h4 class="font-bold text-white mt-0.5"><?= htmlspecialchars($car['kilometer']); ?> KM</h4>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-white/5 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                <div class="md:col-span-1 bg-black/20 p-4 rounded-xl border border-white/5">
                    <h3 class="text-lg font-bold mb-3 text-purple-400"><?= htmlspecialchars($car['nama_mobil']); ?></h3>
                    <ul class="space-y-1.5 text-sm text-gray-300">
                        <li>• Tahun <?= htmlspecialchars($car['tahun']); ?></li>
                        <li>• Kilometer <?= htmlspecialchars($car['kilometer']); ?></li>
                        <li>• Transmisi <?= htmlspecialchars($car['transmisi']); ?></li>
                        <li>• Warna <?= htmlspecialchars($car['warna']); ?></li>
                        <li>• Mesin <?= htmlspecialchars($car['kapasitas_mesin']); ?></li>
                    </ul>
                </div>
                
                <div class="md:col-span-2 flex flex-col justify-between h-full space-y-4">
                    <p class="text-sm text-gray-400 leading-relaxed">
                        <?= nl2br(htmlspecialchars($car['deskripsi'])); ?>
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="button" onclick="openModal()"
                                class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3.5 px-6 rounded-xl transition duration-300 shadow-[0_0_20px_rgba(168,85,247,0.4)] text-center text-sm tracking-wider uppercase">
                            PESAN SEKARANG
                        </button>
                        <a href="../cart/cart.php?add_car_id=<?= $car['id']; ?>"
                           class="sm:w-1/3 bg-zinc-800 hover:bg-zinc-700 border border-white/10 text-white font-semibold py-3.5 px-4 rounded-xl transition text-center text-sm flex items-center justify-center">
                            + Ke Keranjang
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <section class="mt-16">
            <h3 class="text-xl font-bold tracking-wider text-white mb-6 uppercase border-l-4 border-purple-500 pl-3">Another Product</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                    $sql = "SELECT cars.id, cars.nama_mobil, cars_img.gambar FROM cars 
                            LEFT JOIN cars_img ON cars.id = cars_img.car_id 
                            WHERE cars_img.gambar_utama = 1 LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while($otherCar = mysqli_fetch_assoc($result)) :
                ?>
                <a href="Product.php?id=<?= $otherCar['id']; ?>" class="group">
                    <div class="bg-zinc-900/40 border border-white/10 rounded-2xl p-3 backdrop-blur-md transition-all duration-300 group-hover:scale-[1.02] group-hover:border-purple-500/50 group-hover:shadow-[0_8px_25px_rgba(168,85,247,0.15)]">
                        <div class="bg-black/40 rounded-xl h-40 flex items-center justify-center overflow-hidden p-2">
                            <img src="../uploads/<?= $otherCar['gambar']; ?>" alt="<?= $otherCar['nama_mobil']; ?>" class="max-h-full max-w-full object-contain transition duration-300 group-hover:scale-105">
                        </div>
                        <div class="p-3">
                            <h4 class="text-white text-center text-sm font-semibold truncate group-hover:text-purple-400 transition">
                                <?= htmlspecialchars($otherCar['nama_mobil']); ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

    <?php include '../components/checkout-modal.php'; ?>

    <footer class="bg-black/60 border-t border-white/10 mt-24 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-wider">ECLIPSE</h2>
                    <p class="text-gray-400 mt-4 text-sm leading-relaxed">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-base mb-4">Navigation</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="../home/home.php" class="hover:text-purple-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-purple-400 transition">Product</a></li>
                        <li><a href="../contact/Contact.php" class="hover:text-purple-400 transition">Contact</a></li>
                        <li><a href="../aboutus/AboutUs.php" class="hover:text-purple-400 transition">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-base mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-base mb-4">Follow Us</h3>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <img src="img/ig.svg" class="w-4 invert" alt="Instagram">
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <img src="img/fb.svg" class="w-4 invert" alt="Facebook">
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <img src="img/tiktok.svg" class="w-4 invert" alt="TikTok">
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 mt-10 pt-6 text-center text-gray-600 text-xs">
                &copy; 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        const mainImage = document.getElementById("mainImage");
        const thumbnails = document.querySelectorAll(".thumbnail");

        thumbnails.forEach((thumb) => {
            thumb.addEventListener("click", function () {
                mainImage.src = this.src;
                thumbnails.forEach((item) => {
                    item.classList.remove("border-purple-500", "opacity-100", "shadow-[0_0_10px_#a855f7]");
                    item.classList.add("border-transparent", "opacity-70");
                });
                this.classList.remove("border-transparent", "opacity-70");
                this.classList.add("border-purple-500", "opacity-100", "shadow-[0_0_10px_#a855f7]");
            });
        });

        function openModal() {
            document.getElementById('checkoutModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('checkoutModal').classList.add('hidden');
        }
    </script>
</body>
</html>