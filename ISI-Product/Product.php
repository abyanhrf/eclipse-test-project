<?php
    session_start();
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
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 bg-sky-400 text-white shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] [text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Product
            </a>

            <a href="../contact/Contact.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
                Contact
            </a>

            <a href="aboutus.php"
                class="relative z-10 w-[105px] h-[45px] flex items-center justify-center rounded-[14px] text-white font-semibold text-[18px] transition duration-300 hover:bg-sky-400 hover:text-white hover:shadow-[0_0_15px_#38bdf8,0_0_30px_rgba(56,189,248,0.6)] hover:[text-shadow:0_0_5px_#38bdf8,0_0_10px_#38bdf8,0_0_20px_#38bdf8]">
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
                    Admin
                </a>
            <?php else : ?>
                <a href="../cart/cart.php">
                    <img src="img/shopping-bag.png" alt="cart" class="w-8 h-8 cursor-pointer transition duration-300 invert hover:scale-110 hover:drop-shadow-[0_0_10px_#38bdf8]">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    
    <section class="max-w-5xl mx-auto py-10"><section class="bg-black py-10">

    <h1 class="text-white text-3xl font-sans font-bold text-center">
      <?= $car['nama_mobil'];?>
    </h1>

  </section>
  <section class="max-w-6xl mx-auto py-10 px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
         <div class="lg:col-span-2">

        <div class="bg-black p-4">

        <?php
        $index = 0;
        $gambarUtama = mysqli_fetch_assoc($resultImg);
        ?>

        <img
        id="mainImage"
        src="../uploads/<?= $gambarUtama['gambar']; ?>"
        class="w-full h-[450px] object-cover">
            
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
 </div> <div class="flex flex-col gap-6">
        <div class="bg-white/10 border border-white/10 rounded-[40px] backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.3)] p-8">

          <h2 class="text-3xl font-bold text-white">
             Rp<?= number_format($car['harga'],0,',','.'); ?>
          </h2>

          <p class="text-white mt-2">
            Harga dapat berubah sewaktu-waktu
          </p>
          
        </div>
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
        <div class="grid grid-cols-2 gap-3 mt-6">

    <button type="button" onclick="openModal()"
            class="bg-white/10 border border-white/10 rounded-[20px] w-full
            backdrop-blur-md py-4 text-white font-bold cursor-pointer
            hover:bg-purple-800 transition">
            PESAN SEKARANG
    </button>

    <a href="../cart/cart.php?add_car_id=<?= $car['id']; ?>"
        class="bg-white/10 border border-white/10 rounded-[20px]
               backdrop-blur-md py-4 text-white font-bold flex items-center justify-center
               hover:bg-amber-600 transition">
        MASUKKAN KE CART
    </a>

</div>
       </div> </div> </div> <h1 class="text-white text-2xl font-bold mt-8 mb-6">
         ANOTHER PRODUCT
        </h1>
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
    
  </section>
  </section>
    
    <?php include '../components/checkout-modal.php'; ?>

  <footer class="bg-black/40 border-t border-white/10 mt-20">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

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
                        <a href="../aboutus/AboutUs.php " class="hover:text-sky-400 transition">
                            About us
                        </a>
                    </li>
                </ul>
            </div>

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

        <div class="border-t border-white/10 mt-10 pt-6 text-center text-gray-500 text-sm">
            © 2026 ECLIPSE. All Rights Reserved.
        </div>

    </div>

</footer>

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

    function openModal() {
        document.getElementById('checkoutModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('checkoutModal').classList.add('hidden');
    }

  </script>
</body>
</html>