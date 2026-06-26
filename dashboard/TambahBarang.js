// 1. Fitur Preview Gambar Utama (Hanya berjalan jika id="gambar" ditemukan)
const gambarInput = document.getElementById('gambar');

if (gambarInput) {
    gambarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
}

// 2. Fungsi Global Cek Batas Upload
function cekBatasUpload(input, maxFiles) {
    if (input.files.length > maxFiles) {
        alert("Anda hanya bisa menambahkan maksimal " + maxFiles + " gambar lagi!");
        input.value = ""; 
    }
}