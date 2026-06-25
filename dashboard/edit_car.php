<?php

    session_start();
    require_once "../config/database.php";

    $id = $_GET['id'];

    $sqlCar = 
    "SELECT * FROM cars WHERE id = ?";

    $sqlImg = 
    "SELECT * FROM cars_img
    WHERE car_id = ?
    ORDER BY gambar_utama DESC
    ";

    $stmtCar = mysqli_prepare($conn, $sqlCar);
    $stmtImg = mysqli_prepare($conn, $sqlImg);

    mysqli_stmt_bind_param(
    $stmtCar,
    "i",
    $id
    );

    mysqli_stmt_bind_param(
    $stmtImg,
    "i",
    $id
    );

    mysqli_stmt_execute($stmtCar);
    $resultCar = mysqli_stmt_get_result($stmtCar);
    $car = mysqli_fetch_assoc($resultCar);
    mysqli_stmt_execute($stmtImg);
    $resultImg = mysqli_stmt_get_result($stmtImg);

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
    <title>Dashboard Tambah Mobil</title>
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

        <div class="w-[90%] max-w-[1200px] mx-auto mt-6 mb-12 text-white flex-1 flex flex-col">
            <h2 class="text-2xl font-medium mb-6">Edit Mobil</h2>
            
            <form action="../process/update_car_process.php"
                method="POST"
                enctype="multipart/form-data"
                class="flex flex-col gap-6">

                <input
                type="hidden"
                name="id"
                value="<?= $car['id']; ?>">

                <div class="flex flex-col lg:flex-row gap-8">                    
                    
                    <div class="w-full lg:w-[280px]">
                        <!--Border non aktif, kode= border-[3px] border-slate-400-->
                    <?php while ($img = mysqli_fetch_assoc($resultImg)) : ?>
                        <div class="mb-4 border border-slate-600 rounded-lg p-2">
                            <img src="../uploads/<?= $img['gambar']; ?>" class="w-full h-[180px] object-cover rounded-lg">
                            
                            <?php if ($img['gambar_utama']) : ?>
                                <p class="mt-2 text-green-400 text-center">
                                    Gambar Utama
                                </p>
                            <?php else : ?>
                                <a href="../process/set_gambar_utama.php?id=<?= $img['id']; ?>&car_id=<?= $car['id']; ?>" 
                                    class="block mt-2 text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">
                                    Jadikan Utama
                                </a>

                            <?php endif; ?>

                            <a href="../process/delete_img_process.php?id=<?= $img['id']; ?>&car_id=<?= $car['id']; ?>"
                                class="block mt-2 text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded"
                                onclick="return confirm('Yakin ingin menghapus gambar ini?')">   
                                Hapus
                            </a>
                        </div>
                        <?php endwhile; ?>

                        <?php 
                        // Menghitung berapa gambar yang sudah ada di database
                        $jumlah_gambar_sekarang = mysqli_num_rows($resultImg); 
                        $sisa_slot = 5 - $jumlah_gambar_sekarang;
                        ?>

                        <div class="mt-4 border-[3px] border-slate-400 p-4">
                            <label class="block mb-2 font-bold <?= $sisa_slot <= 0 ? 'text-red-500' : 'text-white' ?>">
                                Tambah Gambar Baru (Sisa Slot: <?= $sisa_slot; ?>)
                            </label>

                            <input
                                type="file"
                                name="gambar_baru[]"
                                multiple
                                accept="image/*"
                                class="w-full text-white <?= $sisa_slot <= 0 ? 'opacity-50 cursor-not-allowed' : '' ?>"
                                onchange="cekBatasUpload(this, <?= $sisa_slot; ?>)"
                                <?= $sisa_slot <= 0 ? 'disabled' : ''; ?>
                            >
                            <?php if($sisa_slot <= 0): ?>
                                <p class="text-xs text-red-400 mt-2">Batas maksimal 5 gambar telah tercapai. Hapus gambar lama untuk menambah baru.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="w-full lg:flex-1 flex flex-col gap-6">                       
                        <div class="w-full border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <input
                            type="text"
                            name="nama_mobil"
                            value="<?= $car['nama_mobil']; ?>"
                            class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                        </div>

                    <div class="relative flex">    
                        <div class="w-1/2 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <input
                            type="text"
                            name="merek"
                            value="<?= $car['merek']; ?>"
                            class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                        </div>

                        <div class="w-1/2 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <select
                            name="tipe_mobil" 
                            class="w-full bg-transparent outline-none text-white">
                                <option value="SUV" class="text-black" <?= $car['tipe_mobil'] == 'SUV' ? 'selected' : ''; ?>>
                                Sport Utility Vehicle
                                </option>
                                <option value="Sedan" class="text-black" <?= $car['tipe_mobil'] == 'Sedan' ? 'selected' : ''; ?>>
                                Sedan
                                </option>
                                <option value="MPV" class="text-black" <?= $car['tipe_mobil'] == 'MPV' ? 'selected' : ''; ?>>
                                Multi-Purpose Vehicle
                                </option>
                                <option value="Pickup" class="text-black" <?= $car['tipe_mobil'] == 'Pickup' ? 'selected' : ''; ?>>
                                Pickup Truck
                                </option>
                                <option value="Sport" class="text-black" <?= $car['tipe_mobil'] == 'Sport' ? 'selected' : ''; ?>>
                                Sport
                                </option>
                                <option value="Supercar" class="text-black" <?= $car['tipe_mobil'] == 'Supercar' ? 'selected' : ''; ?>>
                                Supercar
                                </option>
                            </select>
                        </div>
                    </div>    

                    <div class="relative flex">
                        <div class="w-1/2 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <input
                            type="text"
                            name="kapasitas_mesin"
                            value="<?= $car['kapasitas_mesin']; ?>"
                            class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                        </div>

                        <div class="w-1/2 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <select
                                name="transmisi"
                                class="w-full bg-transparent outline-none text-white">
                                
                                <option value="Manual" class="text-black" <?=$car['transmisi'] == 'Manual' ? 'selected' : ''; ?>>
                                    Manual
                                </option>

                                <option value="Automatic" class="text-black" <?=$car['transmisi'] == 'Automatic' ? 'selected' : ''; ?>>
                                    Automatic
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="relative flex">
                        <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <input
                            type="text"
                            name="warna"
                            value="<?=$car['warna']; ?>"
                            class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                        </div>

                        <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <input
                            type="number"
                            name="kilometer"
                            value="<?= $car['kilometer']; ?>"
                            class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                        </div>

                        <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <select
                                name="bahan_bakar"
                                class="w-full bg-transparent outline-none text-white">
                                <option value="Bensin" class="text-black" <?= $car['bahan_bakar'] == 'Bensin' ? 'selected' : ''; ?>>
                                    Bensin
                                </option>

                                <option value="Diesel" class="text-black" <?= $car['bahan_bakar'] == 'Diesel' ? 'selected' : ''; ?>>
                                    Diesel
                                </option>

                                <option value="Hybrid" class="text-black" <?= $car['bahan_bakar'] == 'Hybrid' ? 'selected' : ''; ?>>
                                    Hybrid
                                </option>

                                <option value="Listrik" class="text-black" <?= $car['bahan_bakar'] == 'Listrik' ? 'selected' : ''; ?>>
                                    Listrik
                                </option>
                            </select>
                        </div>
                    </div>

                        <div class="w-full h-[180px] border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                            <textarea name="deskripsi" class="w-full h-full bg-transparent outline-none text-white resize-none placeholder-slate-400"><?= $car['deskripsi']; ?></textarea>
                        </div>
                        
                        <div class="relative flex">
                            <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                                <input
                                type="number"
                                name="harga"
                                value="<?= $car['harga']; ?>"
                                class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                            </div>

                            <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                                <input
                                type="number"
                                name="tahun"
                                value="<?= $car['tahun']; ?>"
                                class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                            </div>

                            <div class="w-1/3 border-[3px] border-slate-400 bg-transparent p-4 focus-within:border-sky-400 transition-colors">
                                <input
                                type="number"
                                name="stok"
                                value="<?= $car['stok']; ?>"
                                class="w-full bg-transparent outline-none text-white placeholder-slate-400">
                            </div>
                        </div>

                            <button
                            type="submit"
                            class="border-[3px] border-slate-400 rounded-2xl bg-sky-700 text-white font-bold py-3 px-8 hover:bg-sky-500 hover:border-sky-500 transition-all cursor-pointer whitespace-nowrap">
                                Update Barang
                            </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src = "tambahBarang.js"></script>
</body>
</html>