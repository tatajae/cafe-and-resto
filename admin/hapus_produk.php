<?php

include "../koneksi.php";

$id = $_GET['id'];

/* ambil data gambar */

$data = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
$d = mysqli_fetch_assoc($data);

$gambar = $d['gambar'];

/* hapus gambar dari folder */

if(file_exists("../gambar/".$gambar)){
unlink("../gambar/".$gambar);
}

/* hapus data dari database */

mysqli_query($conn,"DELETE FROM produk WHERE id_produk='$id'");

/* kembali ke dashboard */

header("location:index.php?menu=produk");

?>