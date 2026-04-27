<?php
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="container-box">

<h4 class="mb-4">Daftar Menu</h4>

<div class="row">

<?php while($p = mysqli_fetch_assoc($produk)){ ?>

<div class="col-md-3 mb-4">

<div class="card shadow-sm">
<img src="../gambar/<?= $p['gambar']; ?>" style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5><?= $p['nama_produk']; ?></h5>
<p class="text-muted"><?= $p['kategori']; ?></p>
<p><b>Rp <?= number_format($p['harga']); ?></b></p>

<a href="tambah_keranjang.php?id=<?= $p['id_produk']; ?>" 
class="btn btn-primary btn-sm">
Tambah
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>