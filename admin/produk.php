<?php
include "koneksi.php";
$data = mysqli_query($conn,"SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>

<title>Produk Cafe</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.container-box{
background:white;
padding:30px;
margin-top:30px;
border-radius:15px;
}

</style>

</head>

<body>
<div class="container">

<div class="container-box">

<h3>Data Produk</h3>

<a href="index.php?menu=tambah_produk" class="btn btn-dark mb-3">Tambah Produk</a>

<table class="table table-bordered">

<tr>
<th>No</th>
<th>Nama</th>
<th>Kategori</th>
<th>Harga</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
while($d=mysqli_fetch_array($data)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nama_produk']; ?></td>
<td><?php echo $d['kategori']; ?></td>
<td>Rp <?php echo $d['harga']; ?></td>

<td>

<a href="index.php?menu=edit_produk&id=<?php echo $d['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="index.php?menu=hapus_produk&id=<?php echo $d['id_produk']; ?>" class="btn btn-danger btn-sm">Hapus</a>

</td>

</tr>

<?php } ?>

</table>
    <button onclick =history.back() class="btn btn-secondary md 3">← Kembali</button>
</div>

</div>

</body>
</html>