document.getElementById('gambar').addEventListener('change', function(event) {

    const file = event.target.files[0];

    if (file) {

        const preview = document.getElementById('preview');

        preview.src = URL.createObjectURL(file);

        preview.classList.remove('hidden');
    }

});