<?php
include "koneksi.php";

if(isset($_POST['simpan'])){

$nama=$_POST['nama'];
$kategori=$_POST['kategori'];
$harga=$_POST['harga'];

$gambar=$_FILES['gambar']['name'];
$tmp=$_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp,"gambar/".$gambar);

mysqli_query($conn,"INSERT INTO produk VALUES(NULL,'$nama','$kategori','$harga','$gambar')");

header("location:index.php?menu=produk");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Produk</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.form-box{
background:white;
padding:30px;
margin-top:50px;
border-radius:15px;
box-shadow:0 5px 15px rgb(255, 255, 255);
}

</style>

</head>

<body>

<div class="container">

<div class="form-box">

<h3>Tambah Produk</h3>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Kategori</label>

<select name="kategori" class="form-control">

<option>Makanan</option>
<option>Dessert</option>
<option>Coffee</option>
<option>Non Coffee</option>

</select>

</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" required>
</div>

<div class="mb-3">
<label>Gambar Produk</label>
<input type="file" name="gambar" class="form-control" required>
</div>

<button name="simpan" class="btn btn-dark">Simpan</button>

<a href="index.php?menu=produk" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>

</body>
</html>