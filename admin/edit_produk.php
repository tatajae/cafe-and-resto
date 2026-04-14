<?php
include "../koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
$d=mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Produk</title>

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
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

img{
border-radius:10px;
}

</style>

</head>

<body>

<div class="container">

<div class="form-box">

<h3>Edit Produk</h3>

<form action="update_produk.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $d['id_produk']; ?>">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text" name="nama" class="form-control" value="<?php echo $d['nama_produk']; ?>">
</div>

<div class="mb-3">
<label>Kategori</label>

<select name="kategori" class="form-control">

<option <?php if($d['kategori']=="Makanan") echo "selected"; ?>>Makanan</option>
<option <?php if($d['kategori']=="Dessert") echo "selected"; ?>>Dessert</option>
<option <?php if($d['kategori']=="Coffee") echo "selected"; ?>>Coffee</option>
<option <?php if($d['kategori']=="Non Coffee") echo "selected"; ?>>Non Coffee</option>

</select>

</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" value="<?php echo $d['harga']; ?>">
</div>

<div class="mb-3">
<label>Gambar Sekarang</label><br>

<img src="../gambar/<?php echo $d['gambar']; ?>" width="120">

</div>

<div class="mb-3">
<label>Ganti Gambar</label>
<input type="file" name="gambar" class="form-control">
</div>

<button class="btn btn-dark">Update</button>

<a href="index.php?menu=produk" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>

</body>
</html>