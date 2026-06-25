<?php

session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit;
    }

require_once "../config/database.php";

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

// --- TAMBAHKAN LOGIKA UPLOAD DI SINI ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    // Tentukan folder penyimpanan (pastikan folder ini ada di project kamu)
    $target_dir = "../uploads/profiles/"; 
    
    // Buat folder jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
    // Buat nama file unik agar tidak bentrok
    $new_file_name = uniqid() . '.' . $file_extension; 
    $target_file = $target_dir . $new_file_name;
    
    // Validasi ekstensi file
    $valid_extensions = array("jpg", "jpeg", "png", "gif", "webp");
    
    if (in_array($file_extension, $valid_extensions)) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            // Update path gambar ke database
            $db_path = "uploads/profiles/" . $new_file_name; // Path relatif untuk dipanggil di HTML
            $update_sql = "UPDATE users SET profile_pic = ? WHERE id = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "si", $db_path, $id);
            mysqli_stmt_execute($update_stmt);
            
            // Refresh halaman untuk memuat gambar baru
            header("Location: profile.php");
            exit;
        } else {
            echo "<script>alert('Gagal mengunggah gambar.');</script>";
        }
    } else {
        echo "<script>alert('Hanya format JPG, JPEG, PNG, GIF, dan WEBP yang diperbolehkan.');</script>";
    }
}

// Tentukan gambar yang akan ditampilkan
$profile_image = !empty($user['profile_pic']) ? "../" . $user['profile_pic'] : "img/user2.png";
// ----------------------------------------

// 2. BARU JALANKAN LOGIKA HAPUS FOTO
if (isset($_POST['hapus_foto'])) {
    
    // Pastikan variabel pertama di dalam mysqli_query sesuai dengan yang ada di koneksi.php kamu (misalnya $conn)
    $query_hapus = "UPDATE users SET profile_pic = '' WHERE id = '$_SESSION[user_id]'";
    mysqli_query($conn, $query_hapus); 

    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="font-[Poppins] min-h-screen text-white overflow-x-hidden bg-[radial-gradient(circle_at_top_left,rgba(255,0,0,0.25),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(255,0,0,0.2),transparent_20%),linear-gradient(135deg,#050505,#0b0b0b,#111111)]">
    <!-- NAVBAR -->
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

    <!--halaman profil-->
    <div class="px-10 py-8 w-full max-w-[1200px] mx-auto flex justify-center items-start">

    <div class="bg-[#212b36]/80 border border-slate-700/50 p-8 rounded-3xl shadow-2xl w-full max-w-3xl mt-4">
        
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 mb-8 border-b border-slate-700/50 pb-8">
            
            <div class="flex flex-col items-center gap-4 shrink-0">
                
                <div class="w-28 h-28 rounded-full border-4 border-slate-600 bg-slate-800 flex justify-center items-center overflow-hidden shadow-lg">
                    <img 
                        src="<?php echo htmlspecialchars($profile_image); ?>" 
                        alt="Profile" 
                        class="<?php echo empty($user['profile_pic']) ? 'w-16 h-16 invert opacity-80' : 'w-full h-full object-cover'; ?>"
                    >
                </div>

                <div class="flex flex-row items-center gap-2">
                    
                    <form action="" method="POST" enctype="multipart/form-data" id="formUploadFoto" class="m-0">
                        <button 
                            type="button" 
                            onclick="document.getElementById('uploadFoto').click();" 
                            class="flex items-center gap-2 px-3 py-2 bg-slate-800 hover:bg-sky-500 text-white text-xs font-semibold rounded-lg border border-slate-600 hover:border-sky-400 transition-colors duration-300 shadow-md">
                            <i class="fas fa-camera"></i>
                            Ubah
                        </button>
                        <input 
                            type="file" 
                            id="uploadFoto" 
                            name="profile_image" 
                            style="display: none !important;" 
                            accept="image/*" 
                            onchange="document.getElementById('formUploadFoto').submit();"
                        >
                    </form>

                    <?php if (!empty($user['profile_pic'])): ?>
                    <form action="" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto profil?');">
                        <input type="hidden" name="hapus_foto" value="1">
                        
                        <button 
                            type="submit" 
                            class="flex items-center gap-2 px-3 py-2 bg-slate-800 hover:bg-rose-500 text-white text-xs font-semibold rounded-lg border border-slate-600 hover:border-rose-400 transition-colors duration-300 shadow-md">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                    <?php endif; ?>

                </div>
            </div>
            
            <div class="text-center sm:text-left flex flex-col justify-center sm:pt-4">
                <h2 class="text-3xl font-bold text-white mb-1">
                    <?php echo $user['nama']; ?>
                </h2>
                <p class="text-slate-400">
                    <?php echo $user['domisili']; ?>
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-user mr-2"></i>Nama Lengkap</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-semibold text-lg">
                    <?php echo $user['nama']; ?>
                </div>
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-map-marker-alt mr-2"></i>Domisili</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <?php echo $user['domisili']; ?>
                </div>
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-envelope mr-2"></i>Email</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <?php echo $user['email']; ?>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 mt-2">
                <label class="block text-sm font-medium text-slate-400 mb-2"><i class="fas fa-lock mr-2"></i>Password</label>
                <div class="px-5 py-4 bg-slate-800/40 border border-slate-700/50 rounded-xl text-white font-medium">
                    <span class="tracking-widest text-lg">••••••••••••</span>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- FOOTER -->
    <footer class="bg-black/40 border-t border-white/10 mt-20">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- BRAND -->
                <div>

                    <h2 class="text-2xl font-bold text-white">
                        ECLIPSE
                    </h2>

                    <p class="text-gray-400 mt-4 leading-relaxed">
                        Eclipse is a company that operates in the field of selling expensive cars that have original and trusted certification for all brands of cars sold.
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

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
                            <img src="img/ig.svg" class="w-5 invert">
                        </a>

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
                            <img src="img/fb.svg" class="w-5 invert">
                        </a>

                        <a 
                            href="#"
                            class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-sky-400 transition duration-300 hover:shadow-[0_0_15px_#38bdf8]"
                        >
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