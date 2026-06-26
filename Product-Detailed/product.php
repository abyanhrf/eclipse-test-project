<?php
require_once "../config/database.php";
session_start();

    $search = "";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $filter = "";
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    }

    $sort = "";
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }

    $min_harga = "";
    if (isset($_GET['min_harga']) && $_GET['min_harga'] != "") {
        $min_harga = $_GET['min_harga'];
    }

    $max_harga = "";
    if (isset($_GET['max_harga']) && $_GET['max_harga'] != "") {
        $max_harga = $_GET['max_harga'];
    }

    $limit = 15;
    $page = 1;

    if (isset($_GET['page'])) {
    $page = $_GET['page'];
    }
    $offset = ($page - 1) * $limit;

    $sql = " SELECT cars.*, cars_img.gambar FROM cars
    LEFT JOIN cars_img
    ON cars.id = cars_img.car_id
    AND cars_img.gambar_utama = 1
    WHERE (nama_mobil LIKE ? OR merek LIKE ?)
    ";

    if ($filter != "") {
        $sql .= " AND tipe_mobil = ?";
    }

    if ($min_harga != "") {
        $min = (int)$min_harga; 
        $sql .= " AND harga >= $min";
    }

    if ($max_harga != "") {
        $max = (int)$max_harga; 
        $sql .= " AND harga <= $max";
    }

    if ($sort == "harga_asc") {
        $sql .= " ORDER BY harga ASC";
    }
    elseif ($sort == "harga_desc") {
        $sql .= " ORDER BY harga DESC";
    }
    elseif ($sort == "tahun_desc") {
        $sql .= " ORDER BY tahun DESC";
    }
    elseif ($sort == "tahun_asc") {
        $sql .= " ORDER BY tahun ASC";
    }
    else {
        $sql .= " ORDER BY cars.id DESC";
    }

    $sql .= " LIMIT ?, ?";

    $stmt = mysqli_prepare($conn, $sql);
    $keyword = "%" . $search . "%";

    if ($filter != "") {
        mysqli_stmt_bind_param($stmt, "sssii", $keyword, $keyword, $filter, $offset, $limit);
    } else {
        mysqli_stmt_bind_param($stmt, "ssii", $keyword, $keyword, $offset, $limit);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $sqlCount = "SELECT COUNT(*) as total FROM cars WHERE (nama_mobil LIKE ? OR merek LIKE ?)";
    if ($filter != "") {
        $sqlCount .= " AND tipe_mobil = ?";
    }
    if ($min_harga != "") {
        $min = (int)$min_harga;
        $sqlCount .= " AND harga >= $min";
    }
    if ($max_harga != "") {
        $max = (int)$max_harga;
        $sqlCount .= " AND harga <= $max";
    }

    $stmtCount = mysqli_prepare($conn, $sqlCount);
    if ($filter != "") {
        mysqli_stmt_bind_param($stmtCount, "sss", $keyword, $keyword, $filter);
    } else {
        mysqli_stmt_bind_param($stmtCount, "ss", $keyword, $keyword);
    }

    mysqli_stmt_execute($stmtCount);
    $resultCount = mysqli_stmt_get_result($stmtCount);
    $dataCount = mysqli_fetch_assoc($resultCount);
    $totalData = $dataCount['total'];
    $totalPage = ceil($totalData / $limit);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Eclipse</title>
</head>

<body class="font-['Poppins',sans-serif] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">

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
                    Dashboard
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <section class="mt-10 flex justify-center w-full">
        <form method="GET" class="relative w-[420px]">
            <img src="img/search.png" alt="search" class="absolute w-[18px] h-[18px] left-[18px] top-1/2 -translate-y-1/2 opacity-70 brightness-0 invert pointer-events-none">
            <input type="search" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Cari produk..." class="w-full py-[15px] pr-[20px] pl-[50px] rounded-[50px] border border-white/10 outline-none bg-white/[0.08] text-white text-[15px] transition duration-300 focus:bg-white/[0.12] focus:border-white/30">
            <input type="hidden" name="filter" value="<?= $filter; ?>">
            <input type="hidden" name="sort" value="<?= $sort; ?>">
            <input type="hidden" name="min_harga" value="<?= $min_harga; ?>">
            <input type="hidden" name="max_harga" value="<?= $max_harga; ?>">
            <button type="submit" class="hidden">Cari</button>
        </form>
    </section>

    <div class="w-[90%] max-w-[1200px] mx-auto bg-transparent border border-white/10 rounded-[30px] p-[30px] mt-10">
        <div class="flex flex-wrap justify-center gap-[15px] mb-[30px]">
            <a href="product.php" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == '' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">Semua</a>
            <a href="product.php?filter=SUV" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'SUV' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">SUV</a>
            <a href="product.php?filter=Sedan" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'Sedan' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">Sedan</a>
            <a href="product.php?filter=MPV" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'MPV' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">MPV</a>
            <a href="product.php?filter=Pickup" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'Pickup' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">Pickup</a>
            <a href="product.php?filter=Sport" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'Sport' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">Sport</a>
            <a href="product.php?filter=Supercar" class="py-[12px] px-[24px] rounded-full text-[16px] transition duration-300 <?= $filter == 'Supercar' ? 'bg-gradient-to-br from-[#7e3cf0] to-[#5c1865] shadow-lg text-white' : 'bg-[#1e293b] text-white'; ?>">Supercar</a>
        </div>

        <form method="GET" class="flex flex-wrap justify-center items-center gap-[15px]">
            <input type="hidden" name="search" value="<?= $search; ?>">
            <input type="hidden" name="filter" value="<?= $filter; ?>">
            <input type="number" name="min_harga" value="<?= $min_harga; ?>" placeholder="Min Harga" class="w-[200px] py-[12px] px-[15px] rounded-[15px] border border-[#334155] bg-[#111827] text-white text-[15px] outline-none">
            <span class="text-white text-[20px]">-</span>
            <input type="number" name="max_harga" value="<?= $max_harga; ?>" placeholder="Max Harga" class="w-[200px] py-[12px] px-[15px] rounded-[15px] border border-[#334155] bg-[#111827] text-white text-[15px] outline-none">
            <button type="submit" class="py-[12px] px-[30px] rounded-[15px] bg-[#ef4444] hover:bg-[#dc2626] text-white font-semibold transition">Terapkan</button>

            <select name="sort" onchange="this.form.submit()" class="py-[12px] px-[20px] rounded-[15px] border border-[#334155] bg-[#111827] text-white cursor-pointer outline-none">
                <option value="">Terbaru</option>
                <option value="harga_asc" <?= $sort == "harga_asc" ? "selected" : ""; ?>>Harga Termurah</option>
                <option value="harga_desc" <?= $sort == "harga_desc" ? "selected" : ""; ?>>Harga Termahal</option>
                <option value="tahun_desc" <?= $sort == "tahun_desc" ? "selected" : ""; ?>>Tahun Terbaru</option>
                <option value="tahun_asc" <?= $sort == "tahun_asc" ? "selected" : ""; ?>>Tahun Terlama</option>
            </select>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-10 mt-12">
        <h1 class="text-white text-2xl font-bold mb-8">ALL PRODUCT</h1>
    </div>

    <div class="max-w-7xl mx-auto px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 pb-10">
            <?php if($totalData > 0) : ?>
                <?php while($car = mysqli_fetch_assoc($result)) : ?>
                    <div class="bg-[#1e293b]/50 border border-slate-700/50 rounded-2xl overflow-hidden transform hover:scale-105 transition duration-300 flex flex-col justify-between">
                        <a href="../ISI-Product/Product.php?id=<?= $car['id']; ?>" class="block">
                            <div class="bg-white p-4 flex items-center justify-center h-44">
                                <img src="../uploads/<?= $car['gambar']; ?>" alt="Mobil" class="h-full object-contain">
                            </div>
                            <div class="p-4 flex flex-col items-center">
                                <h2 class="text-white text-base text-center font-semibold line-clamp-1"><?= $car['nama_mobil']; ?></h2>
                                <p class="text-gray-400 text-center text-xs mt-1"><?= $car['merek']; ?></p>
                                <p class="text-red-400 text-center mt-3 text-base font-bold">Rp <?= number_format($car['harga'],0,',','.'); ?></p>
                                
                                <div class="flex justify-center mt-3">
                                    <?php if ($car['stok'] == 0) : ?>
                                        <span class="bg-red-500/20 text-red-400 text-[11px] px-3 py-1 rounded-full font-medium border border-red-500/30">Habis</span>
                                    <?php elseif ($car['stok'] <= 3) : ?>
                                        <span class="bg-yellow-500/20 text-yellow-400 text-[11px] px-3 py-1 rounded-full font-medium border border-yellow-500/30">Stok Terbatas</span>
                                    <?php else : ?>
                                        <span class="bg-green-500/20 text-green-400 text-[11px] px-3 py-1 rounded-full font-medium border border-green-500/30">Tersedia</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center text-gray-400 text-lg py-12">Produk tidak ditemukan</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="flex justify-center gap-2 mt-6">
        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <a href="?page=<?= $i; ?>&search=<?= $search; ?>&filter=<?= $filter; ?>&sort=<?= $sort; ?>&min_harga=<?= $min_harga; ?>&max_harga=<?= $max_harga; ?>" class="px-4 py-2 <?= $page == $i ? 'bg-purple-600' : 'bg-gray-700 hover:bg-purple-500'; ?> rounded text-white transition"> 
                <?= $i; ?>
            </a>
        <?php endfor; ?>
    </div>

    <footer class="bg-black/40 border-t border-white/10 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h2 class="text-2xl font-bold text-white">ECLIPSE</h2>
                    <p class="text-gray-400 mt-4 text-sm leading-relaxed">Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification.</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Navigation</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="../home/home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="../contact/Contact.php" class="hover:text-sky-400 transition">Contact</a></li>
                        <li><a href="../aboutus/AboutUs.php" class="hover:text-sky-400 transition">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Contact</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition"><img src="img/ig.svg" alt="ig" class="w-5 invert"></a>
                        <a href="https://www.facebook.com/" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition"><img src="img/fb.svg" alt="fb" class="w-5 invert"></a>
                        <a href="https://www.tiktok.com/" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition"><img src="img/tiktok.svg" alt="tiktok" class="w-5 invert"></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 mt-10 pt-6 text-center text-gray-500 text-sm">
                &copy; 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>