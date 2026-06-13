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
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <!-- Logo -->
        <div class="logo">
            <img src="img/LogoProfile.png" alt="logo">
        </div>

        <!-- MENU -->
    <div class="nav-menu">
    <div class="indicator"></div>
    <a href="home.html" class="nav-link active">
        Home
    </a>
    <a href="../Product-Detailed/product.html" class="nav-link">
        Product
    </a>
    <a href="../contact/Contact.html" class="nav-link">
        Contact
    </a>
    <a href="../aboutus/AboutUs.html" class="nav-link">
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

                <a href="#"
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

            <a href="../cart/cart.html">
                <img src="img/shopping-bag.png" alt="cart">
            </a>
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


    <!--daftar produk-->
    <div class="max-w-7xl mx-auto px-4 mt-8 mb-12">

      <h2 class="text-xl font-bold text-gray-800 mb-6">Koleksi</h2>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div class="bg-gray-500 p-3 shadow-md hover:shadow-lg transition-shadow duration-300">
          <img src="img/Mobil.jpeg" alt="lambo">
          <h3 class="text-2xl font-bold text-gray-900 mt-3">Lamborgini</h3>
          <div text-right mt-2>
            <span class="text-xl font-bold text-white">$1000000</span>
          </div>
        </div>

        <div class="bg-gray-500 p-3 shadow-md hover:shadow-lg transition-shadow duration-300">
          <img src="img/mclaren.jpg" alt="lambo">
          <h3 class="text-2xl font-bold text-gray-900 mt-3">Ferrari</h3>
          <div text-right mt-2>
            <span class="text-xl font-bold text-white">$1100000</span>  
          </div>
        </div>

        <div class="bg-gray-500 p-3 shadow-md hover:shadow-lg transition-shadow duration-300">
          <img src="img/Mobil.jpeg" alt="lambo">
          <h3 class="text-2xl font-bold text-gray-900 mt-3">McLaren</h3>
          <div text-right mt-2>
            <span class="text-xl font-bold text-white">$1200000</span>
          </div>
        </div>

        <div class="bg-gray-500 p-3 shadow-md hover:shadow-lg transition-shadow duration-300">
          <img src="img/mclaren.jpg" alt="lambo">
          <h3 class="text-2xl font-bold text-gray-900 mt-3">Porsche</h3>
          <div text-right mt-2>
            <span class="text-xl font-bold text-white">$1300000</span>
          </div>
        </div>
        
      </div>
    </div>

<!-- PRODUCT SECTION -->
        <section id="projects" class="section">
            <div class="container">
                <h2 class="section-title">PRODUCT</h2>
                <div class="projects-grid slide-in-up">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="img/Mobil.jpeg" alt="Project 1">
                        </div>
                        <div class="project-content">
                            <h3>Lamborgini</h3>
                            <p>vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling.</p>
                            <div class="project-tech">
                                <span>React</span>
                                <span>Node.js</span>
                                <span>MongoDB</span>
                            </div>
                            <div class="project-links">
                                <a href="#" class="project-link">BUY</a>
                                <a href="#" class="project-link">$10000000 USD</a>
                            </div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="img/mclaren.jpg" alt="Project 2">
                        </div>
                        <div class="project-content">
                            <h3>McLaren</h3>
                            <p>vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling.</p>
                            <div class="project-tech">
                                <span>HTML</span>
                                <span>CSS</span>
                                <span>JavaScript</span>
                            </div>
                            <div class="project-links">
                                <a href="#" class="project-link">BUY</a>
                                <a href="#" class="project-link">$10000000 USD</a>
                            </div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="img/lamborghini.jpg" alt="Project 3">
                        </div>
                        <div class="project-content">
                            <h3>Porsche</h3>
                            <p>vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling.</p>
                            <div class="project-tech">
                                <span>Vue.js</span>
                                <span>Firebase</span>
                                <span>Tailwind CSS</span>
                            </div>
                            <div class="project-links">
                                <a href="#" class="project-link">BUY</a>
                                <a href="#" class="project-link">$10000000 USD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <h1 class="text-white text-3xl font-bold text-center">
      SESUAIKAN DENGAN MOBIL
    </h1>

  </section>
  <!-- CONTENT -->
  <section class="max-w-6xl mx-auto py-10 px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
         <!-- LEFT -->
      <div class="lg:col-span-2">

        <!-- MAIN IMAGE -->
        <div class="bg-white p-4">

            <img 
            id="mainImage"
            src="img/Mobil.jpeg" alt="Image1"
            class="thumbnail class="w-full h-[450px] object-cover">
            
          <!-- THUMBNAIL -->
          <div class="flex gap-3 mt-4">

            <img
              src="img/Mobil.jpeg" alt="Image1"
              class="thumbnail w-28 h-20 object-cover cursor-pointer"
            >
            <img
              src="img/Mobil.jpeg" alt="Image2"
              class="thumbnail w-28 h-20 object-cover cursor-pointer"
            >
            <img
              src="img/Mobil.jpeg" alt="Image3"
              class="thumbnail w-28 h-20 object-cover cursor-pointer"
            >
            <img
              src="img/Mobil.jpeg" alt="Image4"
              class="thumbnail w-28 h-20 object-cover cursor-pointer"
            >
            <img
              src="img/lamborghini.jpg" alt="Image5"
              class="thumbnail w-28 h-20 object-cover cursor-pointer"
            >
        </div>    
    </div>

    <!-- DESCRIPTION -->
        <div class="bg-white mt-6 p-6">

          <h2 class="text-2xl font-bold mb-4">
            Mercedes-Benz GLC 300 4MATIC AMG Line
          </h2>

          <ul class="space-y-2 text-gray-700">

            <li>• Tahun 2023</li>
            <li>• Kilometer 15.000 KM</li>
            <li>• Automatic Transmission</li>
            <li>• Warna Hitam</li>
            <li>• Mesin 2000cc Turbo</li>
            <li>• Full Original</li>
            <li>• Pajak Panjang</li>
            <li>• Interior Premium</li>
            <li>• Sunroof</li>
          </ul>
        </div>
        <div>
            <p>
                vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling
                vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling
                vehicles specifically designed to prioritize dynamic performance, such as speed, acceleration, and responsive handling

            </p>
        </div>
      </div>
            <!-- RIGHT -->
      <div>

        <!-- PRICE -->
        <div class="bg-white p-6">

          <h2 class="text-3xl font-bold text-purple-700">
            $10000000 USD
          </h2>

          <p class="text-gray-500 mt-2">
            Harga dapat berubah sewaktu-waktu
          </p>

          <div class="flex gap-3 mt-6">

            <button class="border border-black px-6 py-2 font-semibold hover:bg-black hover:text-white transition">
              Kredit
            </button>

            <button class="bg-purple-700 text-white px-6 py-2 font-semibold hover:bg-purple-800 transition">
              Tunai
            </button>

          </div>

        </div>
        <!-- SPESIFIKASI -->
        <div class="bg-white mt-6 p-6">

          <div class="grid grid-cols-2 gap-5">

            <div>
              <p class="text-gray-400 text-sm">Bahan Bakar</p>
              <h3 class="font-bold">ya Bensin</h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Transmisi</p>
              <h3 class="font-bold">Automatic</h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Tahun</p>
              <h3 class="font-bold">2023 mungkin</h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Kapasitas</p>
              <h3 class="font-bold">entahlah (2000)cc</h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Warna</p>
              <h3 class="font-bold">kuning</h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Kilometer</p>
              <h3 class="font-bold">15.000 KM</h3>
            </div>

          </div>

        </div>
        <!-- BUTTON -->
        <div class="bg-white mt-6 p-6">

          <button class="w-full bg-purple-700 text-white py-3 font-bold hover:bg-purple-800 transition">
            PESAN SEKARANG
          </button>

        </div>
    </div>
</div>
</section>
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

                    <a href="#"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                        <img src="img/ig.svg" class="w-5 invert">
                    </a>

                    <a href="#"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
                        <img src="img/fb.svg" class="w-5 invert">
                    </a>

                    <a href="#"
                    class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]">
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

<script src="script.js"></script>
</body>
</html>