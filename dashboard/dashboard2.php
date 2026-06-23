<?php
session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login2.php");
        exit;
    }

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../home/home.php");
        exit;
    }
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
    <title>Document</title>
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
        <a href="#" class="bg-red-400 flex items-center gap-3 px-4 py-3 mx-3 mb-2 text-white transition-all duration-300 rounded-xl hover:bg-red-500 hover:shadow-[0_0_15px_#ef4444,0_0_30px_rgba(239,68,68,0.6)]">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <!---->
        <a href="dashbarang.php" class="flex items-center gap-3 px-4 py-3 mx-3 mb-2 text-white transition-all duration-300 rounded-xl hover:bg-red-500 hover:shadow-[0_0_15px_#ef4444,0_0_30px_rgba(239,68,68,0.6)]">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Atur Barang</span>
        </a>
        <!---->
        <div class="mt-auto mb-4 px-6">
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-colors group">
                <i class="fas fa-sign-out-alt"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

    <!--NAVBAR ATAS-->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        <!---->
        <div class="w-full pt-6 pb-2 sticky top-0 z-50">
            <!---->
            <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)]">
                <!---->
                <div>
                    <img src="img/LogoProfile.png" alt="logo" class="w-10 h-10 cursor-pointer transition duration-300 hover:scale-110">
                </div>

                <div class="relative flex items-center gap-[18px]">
                    <a href="../home/home.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Home
                    </a>
                    <a href="../Product-Detailed/product.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Product
                    </a>
                    <a  href="../contact/Contact.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        Contact
                    </a>
                    <a href="../aboutus/AboutUs.php" class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                        About us
                    </a>
                </div>

                <div class="flex gap-5">
                    <a href="../login/login.html">
                        <img src="img/user2.png" alt="user" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                    </a>
                    <a href="../cart/cart.html">
                        <img src="img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                    </a>
                </div>
            </nav>
        </div>

        <!--Data Toko-->
        <div class="px-10 py-8 w-full max-w-[1200px] mx-auto">
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-[#212b36]/80 border border-slate-700/50 p-6 rounded-2xl flex justify-between items-center shadow-lg transition-transform hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-slate-400 mb-1">Total Pengunjung</p>
                        <h3 class="text-3xl font-bold text-white">8,420</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-sky-500/20 flex justify-center items-center text-sky-400">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>

                <div class="bg-[#212b36]/80 border border-slate-700/50 p-6 rounded-2xl flex justify-between items-center shadow-lg transition-transform hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-slate-400 mb-1">Pendapatan</p>
                        <h3 class="text-3xl font-bold text-white">Rp 12.5M</h3>
                        <p class="text-xs text-green-400 mt-2 font-medium"><i class="fas fa-arrow-up mr-1"></i>+4.5% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-500/20 flex justify-center items-center text-green-400">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                </div>

                <div class="bg-[#212b36]/80 border border-slate-700/50 p-6 rounded-2xl flex justify-between items-center shadow-lg transition-transform hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-slate-400 mb-1">Jumlah Produk</p>
                        <h3 class="text-3xl font-bold text-white">345</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-purple-500/20 flex justify-center items-center text-purple-400">
                        <i class="fas fa-box-open text-xl"></i>
                    </div>
                </div>

            </div>

            <div class="bg-[#212b36]/80 border border-slate-700/50 p-6 rounded-2xl shadow-lg h-[350px] flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-white">Statistik Kinerja</h3>
                    <!-- <button class="px-3 py-1 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition">Bulan Ini <i class="fas fa-chevron-down ml-1 text-xs" alt="bulan"></i></button> -->
                </div>
                <div class="flex-1 w-full relative flex items-end">
                    <div class="absolute inset-0 flex flex-col justify-between border-b border-slate-700/50 pb-6">
                        <div class="border-b border-slate-700/30 w-full"></div>
                        <div class="border-b border-slate-700/30 w-full"></div>
                        <div class="border-b border-slate-700/30 w-full"></div>
                        <div class="border-b border-slate-700/30 w-full"></div>
                    </div>
                    <svg viewBox="0 0 1000 300" class="w-full h-full relative z-10" preserveAspectRatio="none">
                        <path d="M0,280 L80,150 L160,260 L240,80 L320,270 L400,120 L480,240 L560,110 L640,260 L720,100 L800,280 L850,50 L900,210 L920,180 L950,250 L980,200 L1000,290" fill="none" stroke="#38bdf8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M0,280 L80,150 L160,260 L240,80 L320,270 L400,120 L480,240 L560,110 L640,260 L720,100 L800,280 L850,50 L900,210 L920,180 L950,250 L980,200 L1000,290 L1000,300 L0,300 Z" fill="url(#grad1)" opacity="0.2"/>
                        <defs>
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#38bdf8;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#38bdf8;stop-opacity:0" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>

        </div>
    </main>
</body>
</html>