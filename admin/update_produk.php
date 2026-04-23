<?php

include "../koneksi.php";

$id=$_POST['id'];
$nama=$_POST['nama'];
$kategori=$_POST['kategori'];
$harga=$_POST['harga'];

$gambar=$_FILES['gambar']['name'];
$tmp=$_FILES['gambar']['tmp_name'];

if($gambar!=""){

move_uploaded_file($tmp,"../gambar/".$gambar);

mysqli_query($conn,"UPDATE produk SET
nama_produk='$nama',
kategori='$kategori',
harga='$harga',
gambar='$gambar'
WHERE id_produk='$id'");

}else{

mysqli_query($conn,"UPDATE produk SET
nama_produk='$nama',
kategori='$kategori',
harga='$harga'
WHERE id_produk='$id'");

}

header("location:index.php?menu=produk");

?>