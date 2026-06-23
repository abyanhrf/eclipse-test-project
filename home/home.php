<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Home</title>

    <style>
        .anti-putih-banner {
            /* Durasi diubah dari 0.7s menjadi 0.3s agar lebih responsif dan gesit */
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .anti-putih-banner:hover {
            background-image: none !important;
            background-color: #272c35 !important;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <!-- Logo -->
        <div class="logo">
            <img src="img/LogoProfile.png" alt="logo" class="rounded-full">
        </div>

        <!-- MENU -->
    <div class="nav-menu">
    <div class="indicator"></div>
    <a href="home.html" class="nav-link active">
        Home
    </a>
    <a href="../Product-Detailed/product.php" class="nav-link">
        Product
    </a>
    <a href="../contact/Contact.php" class="nav-link">
        Contact
    </a>
    <a href="../aboutus/AboutUs.php" class="nav-link">
        About us
    </a>
    </div>

        <!-- ICON -->
        <div class="nav-icons">
            <?php if (isset($_SESSION['user_id'])) : ?>

                <div class="relative group">

                    <button
                        class="flex items-center gap-2 mr-5 text-white font-semibold hover:text-sky-400 transition duration-300">

                        <img src="img/user2.png" alt="user" class="w-6 h-6 invert">

                        <?= $_SESSION['nama']; ?>

                    </button>

            <div
                class="absolute right-0 top-full w-40 bg-white rounded-lg shadow-lg hidden group-hover:block overflow-hidden z-50">

                <a href="../profile/profile.php"
                        class="block px-4 py-1.5 text-white hover:text-blue-300 hover:bg-gray-100 transition">
                        Profil Saya
                    </a>

                    <a href="../process/logout.php"
                        class="block px-4 py-1.5 text-red-600 hover:bg-red-50 transition">
                        Logout
                    </a>

                </div>

            </div>
            
            <?php else : ?>

            <a href="../login/login.php">
                <img src="img/user2.png" alt="user">
            </a>
            
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') : ?>

                <a href="../dashboard/dashboard.php"
                    class="px-3 py-2 rounded-lg bg-sky-500 text-white text-sm font-semibold hover:bg-sky-400 transition">
                    Dashboard
                </a>

            <?php else : ?>

                <a href="../cart/cart.php">
                    <img src="img/shopping-bag.png" alt="cart">
                </a>

            <?php endif; ?>
        </div>
    </nav>

    <!-- SEARCH -->
    <section class="search-section">
        <div class="search-box">
            <img src="img/search.png" alt="search">
            <input
            type="text"
            placeholder="Cari produk...">
        </div>
    </section>
    <div class="bg-gray-500">
        </div>

    <div class="mt-4 mb-4 flex justify-center px-4">
        </div>

    <div class="relative w-full max-w-7xl mx-auto">
        
        <div id="slider" class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar scroll-smooth">
            
            <div class="min-w-full snap-center relative">
                <img src="img/mclaren.jpg" alt="Iklan 1" class="w-full h-[300px] md:h-[450px] object-cover">
            </div>

            <div class="min-w-full snap-center relative">
                <img src="img/Mobil.jpeg" alt="Iklan 2" class="w-full h-[300px] md:h-[450px] object-cover">
            </div>

            <div class="min-w-full snap-center relative">
                <img src="img/mclaren.jpg" alt="Iklan 3" class="w-full h-[300px] md:h-[450px] object-cover">
            </div>
            
            <div class="min-w-full snap-center relative">
                <img src="img/Mobil.jpeg" alt="Iklan 4" class="w-full h-[300px] md:h-[450px] object-cover">
            </div>

        </div>

        

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-4 bg-white/80 backdrop-blur-sm px-5 py-2 rounded-full shadow-lg">
            <button id="prevBtn" class="text-gray-700 hover:text-black font-bold focus:outline-none">&lt;</button>
            <span id="indicator" class="text-sm font-semibold text-gray-800">1 / 4</span>
            <button id="nextBtn" class="text-gray-700 hover:text-black font-bold focus:outline-none">&gt;</button>
            <div class="w-px h-4 bg-gray-400"></div>
            <button id="pauseBtn" class="text-gray-700 hover:text-black font-bold text-xs focus:outline-none">||</button>
        </div>
    </div>


    <section class="max-w-7xl mx-auto px-6 mt-16 mb-8">
        <div class="anti-putih-banner bg-gradient-to-br from-[#1e222b] to-[#12151c] border border-white/10 rounded-3xl p-8 lg:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.8)] relative overflow-hidden group/banner">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <div class="lg:col-span-5 space-y-6 text-left">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                        WELCOME TO <br> 
                        <span class="text-gray-400 group-hover/banner:text-white transition-colors duration-300">ECLIPSE CARS</span>
                    </h1>
                    
                    <p class="text-gray-400 group-hover/banner:text-gray-200 text-xs sm:text-sm leading-relaxed transition-colors duration-300">
                        Explore our exclusive high-performance catalog! Rent a luxury vehicle or schedule a private test drive on the track. Experience the pinnacle of automotive engineering with fully certified, world-class hypercars.
                    </p>

                    <div class="pt-2">
                        <a href="#product-list" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold px-8 py-3.5 shadow-[0_0_25px_rgba(220,38,38,0.5)] transition duration-300 hover:scale-105 -skew-x-12 cursor-pointer">
                            <span class="block skew-x-12 uppercase tracking-wider text-xs sm:text-sm">Explore Collection!</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-7 flex flex-col justify-between h-full mt-8 lg:mt-0">
                    
                    <div class="text-left lg:text-right space-y-2 mb-4">
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-widest text-white uppercase">
                            PORSCHE <span class="text-red-500">911 GT</span>
                        </h2>
                        <p class="text-gray-400 group-hover/banner:text-gray-200 text-xs sm:text-sm max-w-md lg:ml-auto leading-relaxed transition-colors duration-300">
                            The definitive track-ready flagship. Uncompromising aerodynamic design paired with lightweight carbon bucket seats and an authentic analog tachometer.
                        </p>
                    </div>

                    <div class="relative my-6 flex justify-center">
                        <img src="img/mclaren.jpg" alt="Porsche 911 GT" class="w-full max-w-lg object-contain rounded-lg drop-shadow-[0_15px_15px_rgba(0,0,0,0.9)] hover:scale-105 transition duration-500 cursor-pointer">
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 pt-6 border-t border-white/10 text-center">
                        <div>
                            <span class="block text-[10px] sm:text-[11px] text-gray-400 group-hover/banner:text-gray-300 uppercase tracking-wider">Production</span>
                            <span class="block text-sm sm:text-base font-bold text-white mt-0.5">2026</span>
                        </div>
                        <div>
                            <span class="block text-[10px] sm:text-[11px] text-gray-400 group-hover/banner:text-gray-300 uppercase tracking-wider">Segment</span>
                            <span class="block text-sm sm:text-base font-bold text-white mt-0.5">Supercar</span>
                        </div>
                        <div>
                            <span class="block text-[10px] sm:text-[11px] text-gray-400 group-hover/banner:text-gray-300 uppercase tracking-wider">Engine</span>
                            <span class="block text-sm sm:text-base font-bold text-white mt-0.5">4.0L Flat-6</span>
                        </div>
                        <div>
                            <span class="block text-[10px] sm:text-[11px] text-gray-400 group-hover/banner:text-gray-300 uppercase tracking-wider">Max Speed</span>
                            <span class="block text-sm sm:text-base font-bold text-white mt-0.5">318 km/h</span>
                        </div>
                        <div>
                            <span class="block text-[10px] sm:text-[11px] text-gray-400 group-hover/banner:text-gray-300 uppercase tracking-wider">0-100 km/h</span>
                            <span class="block text-sm sm:text-base font-bold text-red-500 mt-0.5">3.2 s</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <div id="product-list" class="max-w-7xl mx-auto px-6 mt-16 mb-20 scroll-mt-24">
        <div class="flex items-center justify-center mb-12 mt-6">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-red-500/40 shadow-[0_0_8px_rgba(239,68,68,0.4)]"></div>
            <h2 class="mx-6 text-2xl font-black text-white tracking-widest uppercase relative">
                PRODUCT
                <span class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-red-500 rounded-full shadow-[0_0_8px_#ef4444]"></span>
            </h2>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-red-500/40 shadow-[0_0_8px_rgba(239,68,68,0.4)]"></div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="#" class="bg-slate-500 rounded-xl shadow-lg hover:shadow-[0_0_20px_rgba(255,255,255,0.2)] transition duration-300 hover:-translate-y-2 block group overflow-hidden">
                <img src="img/Mobil.jpeg" alt="Lamborgini" class="w-full h-40 md:h-48 object-cover group-hover:opacity-90 transition-opacity">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-900">Lamborgini</h3>
                    <p class="text-lg font-bold text-white mt-1">$1000000</p>
                </div>
            </a>
            <a href="#" class="bg-slate-500 rounded-xl shadow-lg hover:shadow-[0_0_20px_rgba(255,255,255,0.2)] transition duration-300 hover:-translate-y-2 block group overflow-hidden">
                <img src="img/mclaren.jpg" alt="Ferrari" class="w-full h-40 md:h-48 object-cover group-hover:opacity-90 transition-opacity">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-900">Ferrari</h3>
                    <p class="text-lg font-bold text-white mt-1">$1100000</p>
                </div>
            </a>
            <a href="#" class="bg-slate-500 rounded-xl shadow-lg hover:shadow-[0_0_20px_rgba(255,255,255,0.2)] transition duration-300 hover:-translate-y-2 block group overflow-hidden">
                <img src="img/Mobil.jpeg" alt="McLaren" class="w-full h-40 md:h-48 object-cover group-hover:opacity-90 transition-opacity">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-900">McLaren</h3>
                    <p class="text-lg font-bold text-white mt-1">$1200000</p>
                </div>
            </a>
            <a href="#" class="bg-slate-500 rounded-xl shadow-lg hover:shadow-[0_0_20px_rgba(255,255,255,0.2)] transition duration-300 hover:-translate-y-2 block group overflow-hidden">
                <img src="img/mclaren.jpg" alt="Porsche" class="w-full h-40 md:h-48 object-cover group-hover:opacity-90 transition-opacity">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-900">Porsche</h3>
                    <p class="text-lg font-bold text-white mt-1">$1300000</p>
                </div>
            </a>
        </div>
    </div>

    <footer class="bg-black/40 border-t border-white/10 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <h2 class="text-2xl font-bold text-white">ECLIPSE</h2>
                    <p class="text-gray-400 mt-4 leading-relaxed">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Navigation</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="../contact/Contact.html" class="hover:text-sky-400 transition">Contact</a></li>
                        <li><a href="../aboutus/AboutUs.html" class="hover:text-sky-400 transition">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Contact</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="img/ig.svg" class="w-5 invert">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="img/fb.svg" class="w-5 invert">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="img/tiktok.svg" class="w-5 invert">
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 mt-10 pt-6 text-center text-gray-500 text-sm">
                © 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>