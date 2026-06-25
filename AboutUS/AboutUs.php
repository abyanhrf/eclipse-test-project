<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About US</title>
    
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

    <div class="max-w-6xl mx-auto p-4 flex flex-col justify-between mt-10">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-start gap-12 mt-8">
            
            <div class="md:w-1/2">
                <h1 class="font-bold text-4xl text-center md:text-left mb-8 flex justify-center md:justify-start">About US</h1>
                <p class="mb-6 leading-relaxed"> 
                    <b class="text-4xl">K</b>ami adalah perusahaan yang bergerak dibidang usaha perdagangan Mobil Sport.
                    Perusahaan kami berdiri sejak 2021, <b>KING AL FARZANI</b> selaku CEO mendirikan perusahaan 
                    ini karena melihat potensi pasar mobil yang berkembang pesat.
                    Saat ini kami telah berhasil menjual lebih dari 100 unit mobil dalam satu tahun terakhir.
                </p> 
                <p class="leading-relaxed">
                    Kedepannya kami akan menggembangkan bisnis ini menjadi lebih luas lagi dengan 
                    menambahkan Motor Sport sebagai bisnis utama. Kita nantinya juga akan membuat event
                    untuk para penggemar sebagai salah satu media promosi kami.
                </p>
            </div>

            <div class="md:w-1/2 flex flex-col items-center md:items-end">
                <div class="w-full max-w-[400px]">
                    <div class="w-full h-[250px] flex items-center justify-center overflow-hidden bg-white rounded-lg mb-4 shadow-md">
                        <img src="./img/amikom.png" alt="lokasiamikom" class="object-cover w-full h-full">
                    </div>
                    <p class="text-gray-400 text-sm">
                        Kami Berlima merupakan Pendiri dari grup <b>ECLIPSE</b>, berawal dari jokes 
                        ingin membuat perusahaan yang anggotanya berisi satu sirkel. Tidak kami sangka ternyata 
                        dapat terwujud dimasa sekarang.
                    </p>
                </div>
            </div>

        </div>

        <div class="flex justify-between items-end mb-8 w-full mt-16">
            <div class="flex flex-col gap-2">
                <span class="text-lg font-semibold text-gray-400">Motto Kami:</span>
                <div class="w-[250px] md:w-[350px] h-[60px] flex items-center justify-center text-xl text-white font-bold px-4 text-center border-l-4 border-sky-400 bg-white/5">
                    "Kepuasan Anda adalah kebahagiaan bagi Kami"
                </div>
            </div>
            
            <div class="w-16 h-16 rounded-full overflow-hidden border border-white/20 shadow-lg">
                <img src="img/LogoProfile.png" alt="gambar-Logo" class="w-full h-full object-cover">
            </div>
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
                        <li><a href="../home/home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="../contact/Contact.php" class="hover:text-sky-400 transition">Contact</a></li>
                        <li><a href="aboutus.php" class="hover:text-sky-400 transition">About us</a></li>
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
                        <a href="https://www.instagram.com/" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="../home/img/ig.svg" class="w-5 invert">
                        </a>
                        <a href="https://www.facebook.com/" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="../home/img/fb.svg" class="w-5 invert">
                        </a>
                        <a href="https://www.tiktok.com/" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="../home/img/tiktok.svg" class="w-5 invert">
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