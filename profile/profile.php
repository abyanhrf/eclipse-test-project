<?php

session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit;
    }

require_once "../config/database.php";

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="font-[Poppins] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
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
                href="../home/home.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Home
            </a>

            <!-- PRODUCT -->
            <a 
                href="../Product-Detailed/product.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Product
            </a>

            <!-- CONTACT -->
            <a 
                href="../contact/Contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                Contact
            </a>

            <!-- ABOUT -->
            <a 
                href="../aboutus/AboutUs.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]"
            >
                About us
            </a>

        </div>

        <!-- ICON -->
        <div class="flex gap-5">

            <!-- USER -->
            <a href="../login/login.php">
                <img 
                    src="img/user2.png" 
                    alt="user"
                    class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]"
                >
            </a>

            <!-- CART -->
            <a href="../cart/cart.php">
                <img 
                    src="img/shopping-bag.png" 
                    alt="cart"
                    class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]"
                >
            </a>

        </div>
    </nav>

    <!--halaman profil-->
    <div class="px-10 py-8 w-full max-w-[1200px] mx-auto flex justify-center items-start">
    
    <div class="bg-[#212b36]/80 border border-slate-700/50 p-8 rounded-3xl shadow-2xl w-full max-w-3xl mt-4">
        
        <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 border-b border-slate-700/50 pb-8">
            <div class="w-28 h-28 rounded-full border-4 border-slate-600 bg-slate-800 flex justify-center items-center overflow-hidden shadow-lg">
                <img src="img/user2.png" alt="Profile" class="w-16 h-16 invert opacity-80">
            </div>
            
            <div class="text-center sm:text-left">
                <h2 class="text-3xl font-bold text-white mb-1">
                <?php
                echo $user['nama'];
                ?>
                </h2>
                <p class="text-slate-400">
                <?php
                echo $user['domisili'];
                ?>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-user mr-2"></i>Nama Lengkap</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-semibold text-lg">
                    <?php
                    echo $user['nama'];
                    ?>
                </div>
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-map-marker-alt mr-2"></i>Domisili</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <?php
                    echo $user['domisili'];
                    ?>
                </div>
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-envelope mr-2"></i>Email</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <?php
                    echo $user['email'];
                    ?>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 mt-2">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-lock mr-2"></i>Password</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <span class="tracking-widest text-lg">••••••••••••</span>
                </div>
            </div>
        </div>
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