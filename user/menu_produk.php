<?php
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="container-box">

<h4 class="mb-4">Daftar Menu</h4>

<div class="row">

<?php while($p = mysqli_fetch_assoc($produk)){ ?>

<div class="col-md-3 mb-4">

<div class="card">
<img src="../gambar/<?= $p['gambar']; ?>" style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5><?= $p['nama_produk']; ?></h5>
<p><?= $p['kategori']; ?></p>
<p><b>Rp <?= number_format($p['harga']); ?></b></p>

<button class="btn btn-primary btn-sm">Pesan</button>

</div>

</div>

</div>

<?php } ?>

</div>

</div>