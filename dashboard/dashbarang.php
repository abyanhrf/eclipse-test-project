<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit;
    }

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../home/home.php");
        exit;
    }

    require_once "../config/database.php";
    $sql = "SELECT cars.*, cars_img.gambar
    FROM cars
    LEFT JOIN cars_img
    ON cars.id = cars_img.car_id
    AND cars_img.gambar_utama = 1
    ";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <title>Dashboard Eclipse</title>
</head>
<body class="bg-slate-900 font-sans flex h-screen overflow-hidden">
    <!--NAVBAR SAMPING-->
    <aside class="w-[260px] bg-gradient-to-b from-[#3a0606] to-[#170101] text-[#94a3b8] h-screen flex flex-col shrink-0 border-r border-red-900/50">
        <!---->
        <div class="py-6 px-6">
            <h1 class="text-2xl font-bold text-white">ECLIPSE</h1>
        </div>
        <!---->
        <div class="px-6 py-2 text-[11px] font-semibold tracking-wider uppercase text-slate-500 mt-2">
            Layouts &amp; Pages
        </div>
        <!---->
        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 mx-3 mb-2 text-white transition-all duration-300 rounded-xl hover:bg-red-300 hover:text-black hover:shadow-[0_0_15px_#ef4444,0_0_30px_rgba(239,68,68,0.6)]">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <!---->
        <a href="dashbarang.php" class="bg-red-500 flex items-center gap-3 px-4 py-3 mx-3 mb-2 text-white transition-all duration-300 rounded-xl hover:bg-red-300 hover:text-black hover:shadow-[0_0_15px_#ef4444,0_0_30px_rgba(239,68,68,0.6)]">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Atur Barang</span>
        </a>
        <!---->
        <a href="lihatUlasan.php" class="flex items-center gap-3 px-4 py-3 mx-3 mb-2 text-white transition-all duration-300 rounded-xl hover:bg-red-500 hover:shadow-[0_0_15px_#ef4444,0_0_30px_rgba(239,68,68,0.6)]">
            <i class="fas fa-comment-alt w-5 text-center"></i>
            <span class="font-medium">Lihat Feedback</span>
        </a>
        <!---->
        <div class="mt-auto mb-4 px-6">
            <a href="../process/logout.php" class="flex items-center gap-3 px-4 py-3 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-colors group">
                <i class="fas fa-sign-out-alt"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

    <!--NAVBAR ATAS-->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        <div class="w-full pt-6 pb-2 sticky top-0 z-50">
            <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)]">
                <div>
                    <img src="img/LogoProfile.png" alt="logo" class="rounded-full w-10 h-10 cursor-pointer transition duration-300 hover:scale-110">
                </div>

                <div class="relative flex items-center gap-[18px]">
                    <a href="../home/home.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Home
                    </a>
                    <a href="../Product-Detailed/product.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Product
                    </a>
                    <a href="../contact/Contact.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Contact
                    </a>
                    <a href="../aboutus/AboutUs.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        About us
                    </a>
                </div>

                <div class="nav-icons">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <div class="relative group">
                            <button class="flex items-center gap-2 mr-5 text-white font-semibold hover:text-sky-400 transition duration-300">
                            <img src="img/user2.png" alt="user" class="w-6 h-6 invert">
                            <?= $_SESSION['nama']; ?>
                            </button>

                            <!-- <div class="absolute right-0 top-full w-40 bg-white rounded-lg shadow-lg hidden group-hover:block overflow-hidden z-50">
                                <a href="../process/logout.php"
                                class="block px-4 py-1.5 text-red-600 hover:bg-red-50 transition">
                                Logout
                                </a>
                            </div> -->
                        </div>
                    <?php else : ?>
                    <a href="../login/login.php">
                        <img src="img/user2.png" alt="user">
                    </a>            
                    <?php endif; ?>

                </div>
            </nav>
        </div>

        <div class="px-10 py-6 mt-6">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                <a href="TambahBrg.php">
                Tambah Barang
                </a>
            </button>
                
            <?php
            while ($car = mysqli_fetch_assoc($result)) :
            ?>

                <!-- Item -->
                <div class="p-5 bg-white/10 background-blur-md border border-white/10 flex items-center justify-between rounded-lg shadow-lg">
            
                    <!-- 1 -->
                    <div class="flex items-center gap-6">
                        <img src="../uploads/<?= $car['gambar']; ?>" class="w-56 h-32 object-cover rounded-lg">

                        <!-- Detail -->
                        <div class="w-[450px]">
                            <p class="text-3xl font-bold text-white">
                                <?php
                                echo $car['nama_mobil'];
                                ?>
                            </p>

                            <p class="text-yellow-400 mt-2">
                                <?php
                                echo $car['tipe_mobil'];
                                ?>
                            </p>

                            <p class="text-gray-400 mt-3 max-w-md">
                                <?php
                                echo $car['deskripsi'];
                                ?>
                            </p>

                            <!-- stok -->
                            <p class="inline-block mt-4 bg-gray-900 border border-gray-700 px-4 py-2 rounded-full text-sm font-medium text-gray-300">
                            Sisa Unit : <?php echo $car['stok']; ?>
                            </p>
                        </div>

                        <div class="mr-5 w-[250px] text-center">
                            <!--harga-->
                            <p class="text-3xl font-bold text-white">
                                Rp <?php
                                echo number_format($car['harga'], 0, ',', '.');
                                ?>
                            </p>
                        </div>

                        <!--tombolhapus-->
                        <div class="ml-10 w-[120px] text-center">
                            
                            <a href="edit_car.php?id=<?= $car['id']; ?>"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-300"
                                >
                                Edit
                            </a>

                            <div class="mt-1 mb-1">
                                <br>
                            </div>
                        
                            <a href="../process/delete_car_process.php?id=
                                <?php echo $car['id'];?>"
                                class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                >
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
    </main>
</body>
</html>