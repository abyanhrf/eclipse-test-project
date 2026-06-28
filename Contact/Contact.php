<?php
session_start();

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600&family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: linear-gradient(135deg, rgba(20, 20, 25, 0.7) 0%, rgba(10, 10, 12, 0.6) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>

<?php if ($status == 'success') : ?>
<div id="successPopup" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="w-[420px] bg-neutral-900 border border-emerald-500/30 backdrop-blur-xl rounded-3xl p-8 shadow-[0_0_50px_rgba(16,185,129,0.2)] text-center font-jakarta transform transition duration-300 scale-100">
        
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-full bg-emerald-500/10 border border-emerald-500/50 flex items-center justify-center shadow-[0_0_20px_rgba(16,185,129,0.2)] animate-pulse">
                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        
        <h2 class="mt-6 text-2xl font-bold text-white tracking-wide uppercase">
            Pesan Terkirim!
        </h2>
        
        <p class="mt-3 text-neutral-400 text-sm leading-relaxed">
            Terima kasih! Pesan Anda telah berhasil kami terima. Tim Eclipse akan segera meninjau pesan dari Anda.
        </p>
        
        <button
            onclick="document.getElementById('successPopup').style.display='none'; window.history.replaceState({}, document.title, window.location.pathname);"
            class="mt-6 w-full py-3.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-xs tracking-widest uppercase transition duration-300 hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] hover:scale-[1.02] active:scale-[0.98]">
            Selesai 
        </button>
    </div>
</div>
<?php endif; ?>

<body class="bg-[#060608] text-neutral-100 min-h-screen overflow-x-hidden selection:bg-sky-500 selection:text-white relative">
    
    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-sky-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute top-[40vh] right-10 w-[400px] h-[400px] bg-sky-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] mt-6 font-poppins">
    
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
                    <button class="flex items-center gap-2 mr-5 text-white font-semibold hover:text-sky-400 transition duration-300">
                        <img src="../home/img/user2.png" alt="user" class="w-6 h-6 invert">
                        <?= htmlspecialchars($_SESSION['nama']); ?>
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
                    <img src="../AboutUS/img/user2.png" alt="user" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') : ?>
                <a href="../dashboard/dashboard.php" class="px-4 py-1.5 rounded-full bg-sky-500 text-white text-sm font-semibold hover:bg-sky-400 transition shadow-[0_0_10px_rgba(56,189,248,0.4)]">
                    Dashboard
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="../AboutUS/img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    
    <main class="w-[92%] max-w-[1200px] mx-auto py-16 font-jakarta">
        
        <header class="mb-14 text-center">
            <span class="text-xs font-bold tracking-widest text-sky-400 uppercase">Connect With Eclipse</span>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mt-1 bg-gradient-to-r from-white via-neutral-200 to-neutral-400 bg-clip-text text-transparent uppercase">
                Contact Us
            </h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <div class="lg:col-span-7">
                <div class="glass-panel border border-neutral-800 p-8 md:p-10 rounded-3xl shadow-2xl h-full flex flex-col justify-center">
                    
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <form action="../process/contact_process.php" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col space-y-2">
                                    <label class="text-xs font-bold tracking-wider text-neutral-400 uppercase">Nama Anda:</label>
                                    <input type="text" id="nama" name="nama" required 
                                        value="<?= htmlspecialchars($_SESSION['nama']); ?>" readonly
                                        class="w-full bg-neutral-900/50 border border-neutral-800/80 rounded-xl px-5 py-3.5 text-sm text-neutral-400 cursor-not-allowed focus:outline-none" placeholder="Nama">
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label class="text-xs font-bold tracking-wider text-neutral-400 uppercase">Email Anda:</label>
                                    <input type="email" id="email" name="email" required 
                                        value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly
                                        class="w-full bg-neutral-900/50 border border-neutral-800/80 rounded-xl px-5 py-3.5 text-sm text-neutral-400 cursor-not-allowed focus:outline-none" placeholder="Email">
                                </div>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label class="text-xs font-bold tracking-wider text-neutral-400 uppercase">Isi Pesan:</label>
                                <textarea id="pesan" name="pesan" rows="5" required
                                    class="w-full bg-neutral-950/50 border border-neutral-800 rounded-2xl p-5 text-sm text-white placeholder-neutral-600 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition duration-200 resize-none" placeholder="Ketik pesan Anda di sini..."></textarea>
                                </div>
                            <div class="flex justify-center md:justify-start pt-2">
                                <button type="submit" 
                                    class="w-full md:w-auto bg-gradient-to-r from-sky-500 via-sky-400 to-blue-600 text-white text-xs font-bold tracking-widest uppercase py-4 px-10 rounded-xl shadow-[0_4px_25px_rgba(56,189,248,0.2)] hover:shadow-[0_4px_35px_rgba(56,189,248,0.4)] transition duration-300 transform active:scale-[0.98]"
                                    action="KirimPesan.php">
                                    KIRIM PESAN ⚡
                                </button>
                            </div>
                        </form>
                    <?php else : ?>
                        <div class="text-center py-8 space-y-5">
                            <div class="w-16 h-16 bg-sky-500/10 border border-sky-500/20 text-sky-400 rounded-full flex items-center justify-center mx-auto text-2xl shadow-[0_0_20px_rgba(56,189,248,0.1)]">
                                🔒
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold tracking-tight text-white">Fitur Pesan Khusus Member</h3>
                                <p class="text-sm text-neutral-400 max-w-sm mx-auto leading-relaxed">
                                    Untuk menghindari aktivitas spam, kirim pesan ke Eclipse memerlukan otentikasi akun.
                                </p>
                            </div>
                            <div class="pt-2">
                                <a href="../login/login.php" 
                                   class="inline-block bg-neutral-900 border border-neutral-800 text-white hover:bg-sky-500 hover:border-sky-400 hover:shadow-[0_0_20px_rgba(56,189,248,0.4)] text-xs font-bold tracking-widest uppercase py-3.5 px-8 rounded-xl transition duration-300">
                                    Login / Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-5 justify-between">
                
                <div class="glass-panel border border-neutral-800/80 p-6 rounded-2xl flex items-center gap-5 transition hover:border-neutral-700 group flex-1">
                    <div class="w-14 h-14 rounded-xl bg-white mb-0 p-3.5 flex items-center justify-center shadow-md shrink-0">
                        <img src="img/mails-logo.png" alt="GambarEmail" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-neutral-500">Official Email</p>
                        <h4 class="text-sm font-semibold text-white mt-0.5 break-all">eclipse@email.com</h4>
                    </div>
                </div>

                <div class="glass-panel border border-neutral-800/80 p-6 rounded-2xl flex items-center gap-5 transition hover:border-neutral-700 group flex-1">
                    <div class="w-14 h-14 rounded-xl bg-white mb-0 p-3.5 flex items-center justify-center shadow-md shrink-0">
                        <img src="img/WA-logo.png" alt="GambarWA" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-neutral-500">Hotline Number</p>
                        <h4 class="text-sm font-semibold text-white mt-0.5">081234567890</h4>
                    </div>
                </div>

                <a href="https://maps.google.com" target="_blank" 
                   class="glass-panel border border-neutral-800/80 p-6 rounded-2xl flex items-center gap-5 transition hover:border-sky-500/40 group block flex-1">
                    <div class="w-14 h-14 rounded-xl bg-white mb-0 p-3.5 flex items-center justify-center shadow-md shrink-0">
                        <img src="img/maps-logo.png" alt="GambarMaps" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] uppercase font-bold tracking-widest text-neutral-500 flex items-center justify-between">
                            Headquarter Location 
                            <span class="text-[9px] text-sky-400 font-normal lowercase tracking-normal group-hover:underline">Klik Peta ↗</span>
                        </p>
                        <h4 class="text-sm font-semibold text-white mt-0.5">Yogyakarta, Indonesia</h4>
                    </div>
                </a>

            </div>
        </div>
    </main>

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
</body>
</html>