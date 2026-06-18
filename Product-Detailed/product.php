<?php
require_once "../config/database.php";

    $sql = "SELECT cars.*, cars_img.gambar FROM cars
            LEFT JOIN cars_img
            ON cars.id = cars_img.car_id
            AND cars_img.gambar_utama = 1
            ORDER BY cars.id DESC
            ";

    $result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="font-[sans] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">

    <!-- NAVBAR -->
    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)]">

        <!-- LOGO -->
        <div>
            <img 
                src="img/LogoProfile.png" 
                alt="logo"
                class="w-10 h-10 cursor-pointer transition duration-300 hover:scale-110"
            >
        </div>

        <!-- MENU -->
        <div class="relative flex items-center gap-[18px]">

            <!-- INDICATOR -->
            <div class="absolute left-31 w-[105px] h-[45px] bg-sky-400 rounded-[14px] shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] transition-all duration-300 z-0"></div>

            <!-- HOME -->
            <a 
                href="../home/home.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Home
            </a>

            <!-- PRODUCT -->
            <a 
                href="../Product-Detailed/product.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Product
            </a>

            <!-- CONTACT -->
            <a 
                href="../contact/Contact.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Contact
            </a>

            <!-- ABOUT -->
            <a 
                href="../aboutus/AboutUs.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                About us
            </a>

        </div>

        <!-- ICON -->
        <div class="flex gap-5">

            <!-- USER -->
            <a href="../login/login.html">
                <img 
                    src="img/user2.png" 
                    alt="user"
                    class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]"
                >
            </a>

            <!-- CART -->
            <a href="../cart/cart.html">
                <img 
                    src="img/shopping-bag.png" 
                    alt="cart"
                    class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]"
                >
            </a>

        </div>
    </nav>

    <!-- SEARCH -->
    <div class="mt-4 mb-4 flex justify-center">

        <div class="relative w-100">

            <img 
                src="img/search.png" 
                alt="search"
                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 opacity-60"
            >

            <input 
                type="text" 
                placeholder="Cari produk..."
                class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >

        </div>
    </div>

    <!-- TITLE -->
    <h1 class="text-white text-2xl font-bold mb-8 px-40">
        ALL PRODUCT
    </h1>

    <!-- PRODUCT GRID -->
    <div class="max-w-7xl mx-auto px-10">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 justify-items-center overflow-hidden pb-10">

        <?php while($car = mysqli_fetch_assoc($result)) : ?>

            <div class="bg-white-900 rounded-2xl transform hover:scale-105 transition duration-300">
                <a href="detail_car.php?id=<?= $car['id']; ?>">
                <div class="bg-white px-1 flex items-center justify-center h-35 w-50">

                <img
                    src="../uploads/<?= $car['gambar']; ?>" class="h-44 object-contain block"
                    >
                </div>

            <div class="bg-gray-600 h-25 w-50">

                <h2 class="text-white text-1xl text-center font-semibold">
                    <?= $car['nama_mobil']; ?>
                </h2>

                <p class="text-gray-300 text-center text-sm">
                    <?= $car['merek']; ?>
                </p>

                <p class="text-white text-center mt-3 text-lg">
                    Rp <?= number_format($car['harga'],0,',','.'); ?>
                </p>
            </div>
            </a>
        </div>

        <?php endwhile; ?>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-black/40 border-t border-white/10 mt-20">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- BRAND -->
                <div>

                    <h2 class="text-2xl font-bold text-white">
                        ECLIPSE
                    </h2>

                    <p class="text-gray-400 mt-4 leading-relaxed">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
                    </p>

                </div>

                <!-- MENU -->
                <div>

                    <h3 class="text-white font-semibold text-lg mb-4">
                        Navigation
                    </h3>

                    <ul class="space-y-3 text-gray-400">

                        <li>
                            <a href="../home/home.html" class="hover:text-sky-400 transition">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="../Product-Detailed/product.html" class="hover:text-sky-400 transition">
                                Product
                            </a>
                        </li>

                        <li>
                            <a href="../contact/Contact.html" class="hover:text-sky-400 transition">
                                Contact
                            </a>
                        </li>

                        <li>
                            <a href="../aboutus/AboutUs.html" class="hover:text-sky-400 transition">
                                About us
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- CONTACT -->
                <div>

                    <h3 class="text-white font-semibold text-lg mb-4">
                        Contact
                    </h3>

                    <ul class="space-y-3 text-gray-400">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>

                </div>

                <!-- SOCIAL -->
                <div>

                    <h3 class="text-white font-semibold text-lg mb-4">
                        Follow Us
                    </h3>

                    <div class="flex gap-4">

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
                            <img src="img/ig.svg" class="w-5 invert">
                        </a>

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
                            <img src="img/fb.svg" class="w-5 invert">
                        </a>

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
                            <img src="img/tiktok.svg" class="w-5 invert">
                        </a>

                    </div>

                </div>

            </div>

            <!-- COPYRIGHT -->
            <div class="border-t border-white/10 mt-10 pt-6 text-center text-gray-500 text-sm">
                Â© 2026 ECLIPSE. All Rights Reserved.
            </div>

        </div>

    </footer>

</body>
</html>