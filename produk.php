<?php
$query = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="container-box">

<h3 class="mb-4">Daftar Produk</h3>

<div class="row">

<?php while($p = mysqli_fetch_assoc($query)){ ?>

<div class="col-md-3 mb-4">

<div class="card">
<img src="gambar/<?= $p['gambar']; ?>" style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5><?= $p['nama_produk']; ?></h5>
<p>Rp <?= number_format($p['harga']); ?></p>

<a href="login.php" class="btn btn-warning btn-sm">
Login untuk Pesan
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>