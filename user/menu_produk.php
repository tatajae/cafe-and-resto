<?php
$produk = mysqli_query($conn, "
    SELECT produk.*, kategori.nama_kategori 
    FROM produk 
    LEFT JOIN kategori 
    ON produk.id_kategori = kategori.id_kategori
");
?>

<div class="container-box">

<h4 class="mb-4">Daftar Menu</h4>

<div class="row">

<?php while($p = mysqli_fetch_assoc($produk)){ ?>

<div class="col-md-3 mb-4">

<div class="card shadow-sm">

<img src="../gambar/<?= $p['gambar']; ?>" 
     style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5><?= $p['nama_produk']; ?></h5>

<p class="text-muted">
<?= $p['nama_kategori'] ? $p['nama_kategori'] : 'Tanpa Kategori'; ?>
</p>

<p><b>Rp <?= number_format($p['harga'],0,',','.'); ?></b></p>

<!-- ✅ FIX PARAMETER -->
<a href="tambah_keranjang.php?id_produk=<?= $p['id_produk']; ?>" 
class="btn btn-primary btn-sm">
Tambah
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>