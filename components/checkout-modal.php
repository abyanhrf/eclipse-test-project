<?php 
// Cek apakah modal ini dipanggil dari keranjang (cart) atau beli langsung (direct)
$is_cart = isset($is_cart_mode) && $is_cart_mode === true;
$form_action = $is_cart ? 'checkout_cart.php' : 'checkout.php';
?>

<div id="checkoutModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm">
    <div class="bg-[#0b1220] border border-[#1e293b] rounded-[30px] p-8 w-[90%] max-w-md shadow-[0_10px_40px_rgba(0,0,0,0.8)] relative transform transition-all" id="modalContent">

        <button onclick="closeModal()" class="absolute top-4 right-6 text-gray-400 hover:text-white text-3xl font-bold outline-none cursor-pointer">
            &times;
        </button>

        <h2 class="text-2xl font-bold text-white mb-6 text-center tracking-wide">Data Pengiriman</h2>

        <form action="<?= $form_action; ?>" method="POST" class="flex flex-col gap-4">
            
            <?php if($is_cart): ?>
                <input type="hidden" name="total_harga" value="<?= $total_harga_semua; ?>">
                <input type="hidden" name="kumpulan_car_id" value="<?= implode(',', $array_car_id); ?>">
                <input type="hidden" name="tipe_checkout" value="cart">
            <?php else: ?>
                <input type="hidden" name="car_id" value="<?= $car['id']; ?>">
                <input type="hidden" name="harga" value="<?= $car['harga']; ?>">
                <input type="hidden" name="nama_mobil" value="<?= $car['nama_mobil']; ?>">
                <input type="hidden" name="tipe_checkout" value="direct">
            <?php endif; ?>

            <div>
                <label class="text-sm text-gray-400 ml-2 font-semibold">Nama Lengkap</label>
                <input type="text" name="nama_pembeli" value="<?= $_SESSION['nama'] ?? ''; ?>" readonly required
                    class="w-full mt-1 px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-500 outline-none cursor-not-allowed">
            </div>

            <div>
                <label class="text-sm text-gray-400 ml-2 font-semibold">Email</label>
                <input type="email" name="email_pembeli" value="<?= $_SESSION['email'] ?? ''; ?>" readonly required
                    class="w-full mt-1 px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-500 outline-none cursor-not-allowed">
            </div>

            <div>
                <label class="text-sm text-white ml-2 font-semibold">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                <input type="number" name="no_hp_pembeli" placeholder="Masukkan nomor HP yang bisa dihubungi" required
                    class="w-full mt-1 px-4 py-3 rounded-xl bg-[#111827] border border-[#334155] text-white outline-none focus:border-purple-500 transition duration-300">
            </div>

            <div>
                <label class="text-sm text-white ml-2 font-semibold">Alamat Pengiriman <span class="text-red-500">*</span></label>
                <textarea name="alamat_pengiriman" rows="3" placeholder="Masukkan alamat lengkap pengiriman mobil" required
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-[#111827] border border-[#334155] text-white outline-none focus:border-purple-500 transition duration-300"></textarea>
            </div>

            <button type="submit" class="w-full mt-4 bg-gradient-to-r from-purple-600 to-[#5c1865] py-4 rounded-xl text-white font-bold text-lg hover:shadow-[0_0_20px_rgba(168,85,247,0.5)] transition duration-300 transform hover:-translate-y-1 cursor-pointer">
                Lanjutkan Pembayaran
            </button>
            
        </form>
    </div>
</div> 

<script>
    function openModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.add('hidden');
    }
</script>