<?php

$namaFile = time() . "_" . basename($gambar['name']);

$target = "../uploads/" . $namaFile;

move_uploaded_file(
    $gambar['tmp_name'],
    $target
);
?>