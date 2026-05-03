<?php
include "koneksi.php";

$data = mysqli_query($conn, "
    SELECT produk.*, kategori.nama_kategori 
    FROM produk 
    LEFT JOIN kategori 
    ON produk.id_kategori = kategori.id_kategori
");
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

/* gambar biar rapi */
.img-produk{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
}
</style>

</head>

<body>
<div class="container">

<div class="container-box">

<h3>Data Produk</h3>

<a href="index.php?menu=tambah_produk" class="btn btn-dark mb-3">Tambah Produk</a>

<table class="table table-bordered table-hover">

<tr>
<th>No</th>
<th>Gambar</th> <!-- ✅ TAMBAH -->
<th>Nama</th>
<th>Kategori</th>
<th>Harga</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?php echo $no++; ?></td>

<td>
    <img src="../gambar/<?php echo $d['gambar']; ?>" class="img-produk">
</td>

<td><?php echo $d['nama_produk']; ?></td>

<td>
<?php 
echo $d['nama_kategori'] 
    ? $d['nama_kategori'] 
    : '<span class="text-danger">Belum ada</span>'; 
?>
</td>

<td>Rp <?php echo number_format($d['harga'],0,',','.'); ?></td>

<td>

<a href="index.php?menu=edit_produk&id=<?php echo $d['id_produk']; ?>" 
   class="btn btn-warning btn-sm">Edit</a>

<a href="index.php?menu=hapus_produk&id=<?php echo $d['id_produk']; ?>" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin mau hapus produk ini?')">
   Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

<button onclick="history.back()" class="btn btn-secondary">← Kembali</button>

</div>

</div>

</body>
</html>