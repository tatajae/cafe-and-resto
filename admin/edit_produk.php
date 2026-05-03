<?php
include "../koneksi.php";

$id = $_GET['id'];

/* ambil data produk */
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
$d = mysqli_fetch_assoc($data);

/* ambil semua kategori */
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
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

<input type="hidden" name="id" value="<?= $d['id_produk']; ?>">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text" name="nama" class="form-control" value="<?= $d['nama_produk']; ?>" required>
</div>

<div class="mb-3">
<label>Kategori</label>

<!-- ✅ FIX DROPDOWN -->
<select name="id_kategori" class="form-control" required>

<?php while($k = mysqli_fetch_assoc($kategori)){ ?>

<option value="<?= $k['id_kategori']; ?>"
    <?php if($d['id_kategori'] == $k['id_kategori']) echo "selected"; ?>>

    <?= $k['nama_kategori']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" value="<?= $d['harga']; ?>" required>
</div>

<div class="mb-3">
<label>Gambar Sekarang</label><br>
<img src="../gambar/<?= $d['gambar']; ?>" width="120">
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