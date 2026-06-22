<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-gray-800 font-sans font-[Poppins] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
    
    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] mt-6">
    
        <div>
            <img src="../AboutUS/img/LogoProfile.png" alt="logo"
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

            <a href="contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 bg-sky-400 text-white shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] [text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
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
                    <button class="flex items-center gap-2 text-white font-semibold hover:text-sky-400 transition duration-300">
                        <img src="../AboutUS/img/user2.png" alt="user" class="w-8 h-8 invert">
                        <span class="text-sm hidden md:inline"><?= $_SESSION['nama']; ?></span>
                    </button>

                    <div class="absolute right-0 top-full mt-2 w-40 bg-neutral-900 border border-white/10 rounded-lg shadow-lg hidden group-hover:block overflow-hidden z-50">
                        <a href="../profile/profile.php" class="block px-4 py-2 text-sm text-white hover:bg-sky-400 transition">
                            Profil Saya
                        </a>
                        <a href="../process/logout.php" class="block px-4 py-2 text-sm text-red-500 hover:bg-red-500/10 transition">
                            Logout
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <a href="../login/login.php">
                    <img src="../AboutUS/img/user2.png" alt="user" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') : ?>
                <a href="../dashboard/dashboard.php" class="px-4 py-1.5 rounded-full bg-sky-500 text-white text-sm font-semibold hover:bg-sky-400 transition shadow-[0_0_10px_rgba(56,189,248,0.4)]">
                    Admin
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="../AboutUS/img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="p-4 flex flex-col items-center justify-center mt-10">
        <div class="w-full max-w-4xl overflow-hidden">
            <div class="p-6 md:p-10">
                <h1 class="text-4xl font-bold text-center mb-8">Contact Us</h1>
                
                <form action="../process/contact_process.php" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label for="nama" class="text-lg font-semibold mb-2 ml-2">Nama Anda:</label>
                            <input type="text" id="nama" name="nama" required
                                class="border-4 border-black rounded-full p-3 px-6 bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Mas Arsan Gtg">
                        </div>
                        <div class="flex flex-col">
                            <label for="email" class="text-lg font-semibold mb-2 ml-2">Email Anda:</label>
                            <input type="email" id="email" name="email" required
                                class="border-4 border-black rounded-full p-3 px-6 bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Mybinigweh@gmail.com">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="pesan" class="text-lg font-semibold mb-2 ml-2">Isi</label>
                        <textarea id="pesan" name="pesan" rows="5" required
                            class="border-4 border-black rounded-[30px] p-5 bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" placeholder="Pesan Anda"></textarea>
                    </div>
                    <div class="flex justify-center md:justify-start">
                        <button type="submit" 
                            class="bg-white text-black font-bold py-3 px-10 rounded-full border-4 border-black hover:bg-sky-400 hover:text-white hover:border-sky-400 transition-colors">
                            KIRIM PESAN
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-6 md:p-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-center mt-4"> 
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-white mb-3 p-4 flex items-center justify-center shadow-lg">
                        <img src="img/mails-logo.png" alt="GambarEmail" class="w-full h-full object-contain">
                    </div>
                    <p class="text-sm font-bold text-gray-300">Email: <br><span class="text-white">boboiboy@kuasa3.com</span></p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-white mb-3 p-4 flex items-center justify-center shadow-lg">
                        <img src="img/WA-logo.png" alt="GambarWA" class="w-full h-full object-contain">
                    </div>
                    <p class="text-sm font-bold text-gray-300">No Tlp: <br><span class="text-white">081234567890</span></p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-white mb-3 p-4 flex items-center justify-center shadow-lg">
                        <img src="img/maps-logo.png" alt="GambarMaps" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg flex justify-center text-gray-300">
                        <a href="https://maps.google.com" target="_blank" class="hover:text-sky-400 italic font-medium transition">Lokasi (Klik Google-Map)</a>
                    </p> 
                </div>
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
                        <li><a href="home.php" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="../Product-Detailed/product.html" class="hover:text-sky-400 transition">Product</a></li>
                        <li><a href="contact.php" class="hover:text-sky-400 transition">Contact</a></li>
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
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="../home/img/ig.svg" class="w-5 invert">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                            <img src="../home/img/fb.svg" class="w-5 invert">
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
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
</body>
</html>