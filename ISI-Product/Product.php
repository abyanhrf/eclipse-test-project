<?php
    require_once "../config/database.php";

    $id = $_GET['id'] ?? 0;

    $sqlCar = "SELECT * FROM cars WHERE id = ?";

    $sqlImg = "SELECT * FROM cars_img WHERE car_id = ?
    ORDER BY gambar_utama DESC 
    ";

    $stmtCar = mysqli_prepare($conn,$sqlCar);
    $stmtImg = mysqli_prepare($conn,$sqlImg);

    mysqli_stmt_bind_param(
        $stmtCar,
        "i",
        $id
        );

    mysqli_stmt_bind_param($stmtImg,
    "i",
    $id
    );

    mysqli_stmt_execute($stmtCar);
    $resultCar = mysqli_stmt_get_result($stmtCar);
    $car = mysqli_fetch_assoc($resultCar);
    if (!$car) {
    die("Produk tidak ditemukan");
}

    mysqli_stmt_execute($stmtImg);
    $resultImg = mysqli_stmt_get_result($stmtImg);

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Poppins] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
    
  <!-- Product -->
    <!-- NAVBAR -->
    <nav class="w-[90%] max-w-[1200px] mx-auto px-10 py-4 flex items-center justify-between bg-white/10 border border-white/10 rounded-[60px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)]">
    
        <!-- LOGO -->
        <div>
            <img src="img/LogoProfile.png" alt="logo"
            class="w-10 h-10 cursor-pointer transition duration-300 hover:scale-110">
        </div>

        <!-- MENU -->
        <div class="relative flex items-center gap-[18px]">
            <!-- INDICATOR -->
            <!-- HOME -->
            <a href="../home/home.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
            Home
            </a>

            <!-- PRODUCT -->
            <a href="../Product-Detailed/product.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Product
            </a>

            <!-- CONTACT -->
            <a  href="../contact/Contact.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Contact
            </a>

            <!-- ABOUT -->
            <a href="../aboutus/AboutUs.html"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                About us
            </a>

        </div>

        <!-- ICON -->
        <div class="flex gap-5">

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

    <!--search-->
    
    <form method="GET" class="mt-4 mb-4 flex justify-center">

  <div class="relative w-100">

    <input
      type="text"
      name="keyword"
      placeholder="Cari produk..."
      value="<?= $_GET['keyword'] ?? '' ?>"
      class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 text-white"
    >

  </div>

</form>
    
    <section class="max-w-5xl mx-auto py-10"><!-- TITLE -->
  <section class="bg-black py-10">

    <h1 class="text-white text-3xl font-sans font-bold text-center">
      <?= $car['nama_mobil'];?>
    </h1>

  </section>
  <!-- CONTENT -->
  <section class="max-w-6xl mx-auto py-10 px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
         <!-- LEFT -->
      <div class="lg:col-span-2">

        <!-- MAIN IMAGE -->
        <div class="bg-black p-4">

        <?php
        $index = 0;
        $gambarUtama = mysqli_fetch_assoc($resultImg);
        ?>

        <img
        id="mainImage"
        src="../uploads/<?= $gambarUtama['gambar']; ?>"
        class="w-full h-[450px] object-cover">
            
          <!-- THUMBNAIL -->
        <div class="flex gap-3 mt-4">
            <?php
            mysqli_data_seek($resultImg,0);
            while($img = mysqli_fetch_assoc($resultImg)) :
            ?>

            <img src="../uploads/<?= $img['gambar']; ?>"
            class="thumbnail w-28 h-20 object-cover cursor-pointer
            <?= $index==0 ? 'border-4 border-purple-600' : ''; ?>">

            <?php $index++; endwhile; ?>
        </div>    

    <!-- DESCRIPTION -->
        <div class=" mt-6 p-6">

          <h2 class="text-2xl text-white font-sans font-bold mb-4">
            <?= $car['nama_mobil']; ?>
          </h2>

          <ul class="space-y-2 font-sans text-white">

            <li>• <?= $car['tahun']; ?></li>
            <li>• Kilometer <?= $car['kilometer']; ?></li>
            <li>• <?= $car['transmisi']; ?> Transmission</li>
            <li>• Warna <?= $car['warna']; ?></li>
            <li>• Mesin <?= $car['kapasitas_mesin'] ?></li>
          </ul>
        </div>
        <div>
            <p class="text-white font-sans mt-6">
                <?= nl2br($car['deskripsi']); ?>
            </p>
        </div>
    </div>
 </div> <!-- tutup lg:col-span-2 -->

    <!-- RIGHT -->
    <div class="flex flex-col gap-6">
        <!-- PRICE -->
        <div class="bg-white/10 border border-white/10 rounded-[40px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] p-8">

          <h2 class="text-3xl font-bold text-white">
             Rp<?= number_format($car['harga'],0,',','.'); ?>
          </h2>

          <p class="text-white mt-2">
            Harga dapat berubah sewaktu-waktu
          </p>

            <button class="px-6 py-2 font-semibold hover:bg-amber-600 hover:text-white transition">
              Kredit
            </button>

            <button class="text-white px-6 py-2 font-semibold hover:bg-purple-800 transition">
              Tunai
            </button>
        </div>
        <!-- SPESIFIKASI -->
        <div class="bg-white/10 border border-white/10 backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] p-6">
          <div class="grid grid-cols-2 gap-5">

            <div>
              <p class="text-gray-400 text-sm">Bahan Bakar</p>
              <h3 class="font-bold"><?= $car['bahan_bakar']; ?></h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Transmisi</p>
              <h3 class="font-bold"><?= $car['transmisi']; ?></h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Tahun</p>
              <h3 class="font-bold"><?= $car['tahun']; ?></h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Kapasitas</p>
              <h3 class="font-bold"><?= $car['kapasitas_mesin']; ?></h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Warna</p>
              <h3 class="font-bold"><?= $car['warna']; ?></h3>
            </div>

            <div>
              <p class="text-gray-400 text-sm">Kilometer</p>
              <h3 class="font-bold"><?= $car['kilometer']; ?></h3>
            </div>

        </div>

    </div>
        <!-- BUTTON -->
        <div class="grid grid-cols-2 gap-3 mt-6">

    <button
        class="bg-white/10 border border-white/10 rounded-[20px]
               backdrop-blur-md py-4 text-white font-bold
               hover:bg-purple-800 transition">
        PESAN SEKARANG
    </button>

    <button
        class="bg-white/10 border border-white/10 rounded-[20px]
               backdrop-blur-md py-4 text-white font-bold
               hover:bg-amber-600 transition">
        MASUKKAN KE CART
    </button>

</div>
       </div> <!-- tombol -->
    </div> <!-- kolom kanan -->
</div> <!-- grid utama -->

      <!-- Other Title -->
        <h1 class="text-white text-2xl font-bold mt-8 mb-6">
         ANOTHER PRODUCT
        </h1>
        <!-- Product Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

<?php
    $sql = "
    SELECT
    cars.id,
    cars.nama_mobil,
    cars.harga,
    cars.deskripsi,
    cars_img.gambar
    FROM cars
    LEFT JOIN cars_img
    ON cars.id = cars_img.car_id
    WHERE cars_img.gambar_utama = 1
    LIMIT 4";
    $result = mysqli_query($conn, $sql);
?>
<?php while($otherCar = mysqli_fetch_assoc($result)) : ?>

<a href="Product.php?id=<?= $otherCar['id']; ?>">

    <div class="group cursor-pointer">

        <div class="bg-white p-2 flex items-center justify-center h-48 rounded-lg overflow-hidden">
           

            <img
                src="../uploads/<?= $otherCar['gambar']; ?>"
                alt="<?= $otherCar['nama_mobil']; ?>"
                class="w-full h-44 object-contain transition duration-300 group-hover:scale-105"
            >
            
        </div>

        <div class="bg-white/10 backdrop-blur-md p-4 rounded-b-lg">

            <h2 class="text-white text-center font-semibold">
                <?= $otherCar['nama_mobil']; ?>
            </h2>

        </div>

    </div>

</a>

<?php endwhile; ?>
</div> 
    
 <!-- JAVASCRIPT -->
  <script>

    // ambil gambar utama
    const mainImage = document.getElementById("mainImage");

    // ambil semua thumbnail
    const thumbnails = document.querySelectorAll(".thumbnail");

    // looping thumbnail
    thumbnails.forEach((thumb) => {

      thumb.addEventListener("click", function () {

        // ganti gambar utama
        mainImage.src = this.src;

        // hapus border semua thumbnail
        thumbnails.forEach((item) => {
          item.classList.remove("border-4", "border-purple-600");
        });

        // tambahkan border thumbnail aktif
        this.classList.add("border-4", "border-purple-600");

      });

    });

  </script>
  </section>
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
</body>
</html>