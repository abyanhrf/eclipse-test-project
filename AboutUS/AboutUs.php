<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-gray-800 min-h-screen p-4 box-border font-sans font-[Poppins] text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
    
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
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Product
            </a>

            <a href="../contact/Contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Contact
            </a>

            <a href="aboutus.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 bg-sky-400 text-white shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] [text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
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

    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col justify-between mt-10 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="space-y-8">
                <div class="inline-block mb-4">
                    <h1 class="font-bold text-4xl md:text-5xl text-white tracking-wider mb-3">ABOUT US</h1>
                    <div class="h-1 w-2/3 bg-sky-400 rounded-full shadow-[0_0_15px_#38bdf8]"></div>
                </div>
                
                <div class="text-gray-300 space-y-6 text-lg leading-relaxed font-light">
                    <p class="text-justify"> 
                        <span class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-500 float-left mr-4 mt-[-10px]">K</span>
                        ami adalah perusahaan yang bergerak dibidang usaha perdagangan Mobil Sport.
                        Perusahaan kami berdiri sejak 2021, <strong class="text-white font-semibold">KING AL FARZANI</strong> selaku CEO mendirikan perusahaan 
                        ini karena melihat potensi pasar mobil yang berkembang pesat.
                        Saat ini kami telah berhasil menjual lebih dari <span class="text-sky-400 font-bold drop-shadow-[0_0_5px_rgba(56,189,248,0.5)]">100 unit</span> mobil dalam satu tahun terakhir.
                    </p> 
                    <p class="text-justify">
                        Kedepannya kami akan menggembangkan bisnis ini menjadi lebih luas lagi dengan 
                        menambahkan Motor Sport sebagai bisnis utama. Kita nantinya juga akan membuat event
                        untuk para penggemar sebagai salah satu media promosi kami.
                    </p>
                </div>
            </div>

            <div class="flex flex-col items-center lg:items-end w-full">
                <div class="w-full max-w-lg relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-sky-500 to-blue-600 rounded-[24px] blur opacity-20 group-hover:opacity-40 transition duration-700"></div>
                    
                    <div class="relative bg-neutral-900/80 backdrop-blur-sm border border-white/10 p-5 rounded-[20px] shadow-2xl">
                        <div class="w-full aspect-video flex items-center justify-center overflow-hidden rounded-xl bg-black relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                            <img src="./img/EclipseRoom.jpg" alt="Eclipse Room" class="object-cover w-full h-full opacity-80 group-hover:opacity-100 transition duration-700 group-hover:scale-105">
                        </div>
                        
                        <div class="mt-6 px-3">
                            <p class="text-gray-400 text-sm leading-relaxed border-l-2 border-sky-400 pl-4 text-justify">
                                Kami Berlima merupakan Pendiri dari grup <strong class="text-white tracking-wider">ECLIPSE</strong>, berawal dari jokes 
                                ingin membuat perusahaan yang anggotanya berisi satu sirkel. Tidak kami sangka ternyata 
                                dapat terwujud dimasa sekarang.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col md:flex-row justify-between items-center md:items-end gap-10 mt-28 mb-10 w-full">
            
            <div class="flex flex-col gap-3 w-full md:w-auto">
                <span class="text-sm font-semibold text-sky-400 uppercase tracking-[0.2em] ml-2">Motto Kami</span>
                <div class="relative w-full md:w-[500px] bg-gradient-to-r from-white/5 to-transparent backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-2xl overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-sky-400 rounded-l-2xl shadow-[0_0_15px_#38bdf8]"></div>
                    <p class="text-xl md:text-2xl text-white font-medium italic relative z-10">
                        "Kepuasan Anda adalah kebahagiaan bagi Kami"
                    </p>
                    <div class="absolute -right-20 -top-20 w-40 h-40 bg-sky-400/10 rounded-full blur-3xl group-hover:bg-sky-400/20 transition duration-500"></div>
                </div>
            </div>
            
            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-white/20 shadow-[0_0_30px_rgba(255,255,255,0.05)] hover:shadow-[0_0_20px_rgba(56,189,248,0.3)] hover:border-sky-400/50 transition-all duration-300">
                <img src="img/LogoProfile.png" alt="gambar-Logo" class="w-full h-full object-cover">
            </div>
            
        </div>
    </div>

    <footer class="bg-[#030304] border-t border-neutral-900 mt-24 font-jakarta">
        <div class="max-w-7xl mx-auto px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="space-y-4">
                    <h2 class="text-xl font-bold text-white tracking-widest uppercase">ECLIPSE</h2>
                    <p class="text-neutral-500 text-xs leading-relaxed">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Navigation</h3>
                    <ul class="space-y-2.5 text-xs text-neutral-400">
                        <li><a href="../home/home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="../contact/contact.php" class="hover:text-sky-400 transition">Contact</a></li>
                        <li><a href="../aboutus/aboutus.php" class="hover:text-sky-400 transition">About us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Contact</h3>
                    <ul class="space-y-2.5 text-xs text-neutral-400">
                        <li>Email : eclipse@email.com</li>
                        <li>Phone : +62 1234 5678 90</li>
                        <li>Indonesia</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Follow Us</h3>
                    <div class="flex gap-3">
                        <a href="https://www.instagram.com/" class="w-9 h-9 rounded-xl bg-neutral-900 border border-neutral-800 flex items-center justify-center hover:bg-white hover:text-black transition duration-300">
                            <img src="../home/img/ig.svg" class="w-4 invert opacity-70" alt="Instagram">
                        </a>
                        <a href="https://www.facebook.com/" class="w-9 h-9 rounded-xl bg-neutral-900 border border-neutral-800 flex items-center justify-center hover:bg-white hover:text-black transition duration-300">
                            <img src="../home/img/fb.svg" class="w-4 invert opacity-70" alt="Facebook">
                        </a>
                        <a href="https://www.tiktok.com/" class="w-9 h-9 rounded-xl bg-neutral-900 border border-neutral-800 flex items-center justify-center hover:bg-white hover:text-black transition duration-300">
                            <img src="../home/img/tiktok.svg" class="w-4 invert opacity-70" alt="TikTok">
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-neutral-900 mt-12 pt-8 text-center text-neutral-600 text-xs tracking-wider">
                © 2026 ECLIPSE. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>