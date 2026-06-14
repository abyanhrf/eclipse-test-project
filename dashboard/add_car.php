<form action="../process/add_car_process.php" method="post">

    <input
        type="text"
        name="nama_mobil"
        placeholder="Nama Mobil"
        required
    >

    <input
        type="text"
        name="merek"
        placeholder="Merek"
        required
    >

    <input
    type="text"
    name="tipe_mobil"
    placeholder="Tipe Mobil"
    required
    >

    <input
        type="number"
        name="harga"
        placeholder="Harga"
        required
    >

    <input
        type="number"
        name="tahun"
        placeholder="Tahun"
        required
    >

    <input
        type="number"
        name="stok"
        placeholder="Stok"
        required
    >

    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>

    <button type="submit">
        Tambah Mobil
    </button>
</form>