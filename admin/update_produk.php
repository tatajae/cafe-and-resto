<?php

include "../koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$id_kategori = $_POST['id_kategori']; // ✅ FIX
$harga = $_POST['harga'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

if($gambar != ""){

    move_uploaded_file($tmp, "../gambar/".$gambar);

    mysqli_query($conn, "
        UPDATE produk SET
        nama_produk='$nama',
        id_kategori='$id_kategori',
        harga='$harga',
        gambar='$gambar'
        WHERE id_produk='$id'
    ") or die(mysqli_error($conn));

}else{

    mysqli_query($conn, "
        UPDATE produk SET
        nama_produk='$nama',
        id_kategori='$id_kategori',
        harga='$harga'
        WHERE id_produk='$id'
    ") or die(mysqli_error($conn));

}

header("location:index.php?menu=produk");

?>