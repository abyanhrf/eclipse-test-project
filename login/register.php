<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">

    <!-- NAVBAR -->
    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)]">
    
        <!-- LOGO -->
        <div>
            <img src="img/LogoProfile.png" alt="logo"
            class="w-10 h-10 cursor-pointer rounded-full transition duration-300 hover:scale-110">
        </div>

        <!-- MENU -->
        <div class="relative flex items-center gap-[18px]">
            
            <!-- HOME -->
            <a href="../home/home.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
            Home
            </a>

            <!-- PRODUCT -->
            <a href="../Product-Detailed/product.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Product
            </a>

            <!-- CONTACT -->
            <a  href="../contact/Contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Contact
            </a>

            <!-- ABOUT -->
            <a href="../aboutus/AboutUs.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                About us
            </a>

        </div>

        <!-- ICON -->
        <div class="flex gap-5">

            <!-- INDICATOR -->
            <div class="absolute top-1/6 right-21 w-[50px] h-[50px] bg-sky-400 rounded-[14px] shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] transition-all duration-300 z-0"></div>
            <!-- USER -->
            <a href="../login/login.html">
                <img src="img/user2.png" alt="user"
                    class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
            </a>

            <!-- CART -->
            <a href="../cart/cart.html">
                <img src="img/shopping-bag.png" alt="cart"
                class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
            </a>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-10">
        <div class="flex bg-white/10 background-blur-md border border-white/10 rounded-3xl overflow-hidden shadow-2xl">

            <!-- kiri -->
            <div class="px-10 p-10">
                <div class="mb-5">
                    <p class="text-4xl font-extrabold">
                        Register Account
                    </p>
                </div>

                <div class="py-10">
                    <h1 class="text-2xl font-bold">
                        Create Account
                    </h1>

                    <p class="mt-4">
                        Isilah data diri anda dengan baik dan benar
                    </p>
                </div>

                <div class="mt-60">
                    <p class="font-medium">
                        Sudah punya akun? <br> <a href="login.html" class="text-blue-400 hover:underline">
                            Login disini
                        </a>
                    </p>
                </div>
            </div>

            <!-- kanan -->
            <div class="bg-white/30 background-blur-md border border-white/10 py-10 px-8 w-100">
                <div>
                    <p class="text-2xl font-bold">
                        Register
                    </p>

                    <p class="mt-2">
                        Silahkan isi data dibawah dengan benar
                    </p>
                </div>

                <!-- Form -->
                <form 
                    class="mt-6"
                    action="../process/register_process.php"
                    method="POST"
                >

                    <!--nama-->
                    <div>
                        <p>Nama</p>
                        <input 
                            type="text" id="name" name="name" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Nama">
                    </div>

                    <!--domisili-->
                    <div class="mt-4">
                        <p>Domisili</p>
                        <input type="text" id="domisili" name="domisili" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Domisili">
                    </div>

                    <!-- email -->
                    <div class="mt-4">
                        <p>Email</p>
                        <input 
                            type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="nama@email.com">
                    </div>

                    <!-- password -->
                    <div class="mt-4">
                        <p>Password</p>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="password"></div>

                    <!-- button -->
                    <div class="mt-10">
                        <button type="submit" class="w-full bg-black/40 hover:bg-black/20 py-3 rounded-2xl transition duration-300">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-black/40 border-t border-white/10 mt-20">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- BRAND -->
            <div>
                <h2 class="text-2xl font-bold text-white">
                    ECLIPSE
                </h2>

                <p class="text-gray-400 mt-4 leading-relaxed">
                    Eclipse is a company that 
                    operates in the field of selling expensive cars that have original 
                    and trusted certification for all brands of cars sold.
                </p>
            </div>

            <!-- MENU -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-4">
                    Navigation
                </h3>

                <ul class="space-y-3 text-gray-400">
                    <li>
                        <a href="../home/home.php" class="hover:text-sky-400 transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="../Product-Detailed/product.php" class="hover:text-sky-400 transition">
                            Product
                        </a>
                    </li>

                    <li>
                        <a href="../contact/Contact.php" class="hover:text-sky-400 transition">
                            Contact
                        </a>
                    </li>

                    <li>
                        <a href="../aboutus/AboutUs.php" class="hover:text-sky-400 transition">
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

                    <a href="https://www.instagram.com/"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                        <img src="img/ig.svg" class="w-5 invert">
                    </a>

                    <a href="https://www.facebook.com/"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                        <img src="img/fb.svg" class="w-5 invert">
                    </a>

                    <a href="https://www.tiktok.com/"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                        <img src="img/tiktok.svg" class="w-5 invert">
                    </a>

                </div>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="border-t border-white/10 mt-10 pt-6 text-center text-gray-500 text-sm">
            © 2026 ECLIPSE. All Rights Reserved.
        </div>

    </div>

</footer>
</body>
</html>