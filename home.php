<div class="container mt-4">

<!-- 🔥 HERO / CAROUSEL -->
<div id="carouselExample" class="carousel slide mb-4">

<div class="carousel-inner">

<div class="carousel-item active">
<img src="gambar/hero1.jpg" class="d-block w-100" style="height:400px; object-fit:cover;">
<div class="carousel-caption">
<h2>Rasa Terbaik, Harga Bersahabat</h2>
<p>Nikmati kopi premium dan makanan lezat</p>
</div>
</div>

<div class="carousel-item">
<img src="gambar/hero2.jpg" class="d-block w-100" style="height:400px; object-fit:cover;">
<div class="carousel-caption">
<h2>Diskon 20% Hari Ini</h2>
<p>Jangan lewatkan promo spesial</p>
</div>
</div>

</div>

<button class="carousel-control-prev" data-bs-target="#carouselExample" data-bs-slide="prev">
<span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" data-bs-target="#carouselExample" data-bs-slide="next">
<span class="carousel-control-next-icon"></span>
</button>

</div>


<!-- 🔥 PROMO -->
<div class="container-box text-center mb-4">

<h3>🔥 Promo Hari Ini</h3>
<p>Diskon 20% untuk semua menu kopi</p>
<p>Beli 2 Gratis 1 untuk dessert</p>

<a href="login.php" class="btn btn-warning">Login untuk Pesan</a>

</div>


<!-- 🍔 BEST SELLER -->
<div class="container-box mb-4">

<h3 class="mb-4 text-center">Menu Favorit</h3>

<div class="row">

<?php
$query = mysqli_query($conn, "SELECT * FROM produk LIMIT 4");
while($p = mysqli_fetch_assoc($query)){
?>

<div class="col-md-3 mb-3">

<div class="card h-100">

<img src="gambar/<?= $p['gambar']; ?>" style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5><?= $p['nama_produk']; ?></h5>
<p>Rp <?= number_format($p['harga']); ?></p>

<span class="badge bg-danger">Best Seller</span>

<br><br>

<a href="login.php" class="btn btn-dark btn-sm">
Pesan
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>


<!-- ⭐ TESTIMONI -->
<div class="container-box text-center mb-4">

<h3>Testimoni Pelanggan</h3>

<p>"Kopinya enak banget!" ⭐⭐⭐⭐⭐</p>
<p>"Pelayanan cepat dan ramah" ⭐⭐⭐⭐⭐</p>
<p>"Harga terjangkau, rasa premium" ⭐⭐⭐⭐⭐</p>

</div>


<!-- 📍 TENTANG KAMI -->
<div class="container-box mb-4">

<h3>Tentang Kami</h3>

<p>
Black Coffee adalah cafe yang menyediakan kopi berkualitas tinggi dan makanan lezat dengan harga terjangkau.
Kami berkomitmen memberikan pengalaman terbaik untuk setiap pelanggan.
</p>

</div>


<!-- 💳 PEMBAYARAN -->
<div class="container-box text-center mb-4">

<h3>Cara Pembayaran</h3>

<p>Transfer Bank | OVO | Dana | Cash</p>

</div>


<!-- 📞 KONTAK -->
<div class="container-box text-center mb-4">

<h3>Kontak Kami</h3>

<p>WhatsApp: 0812-3456-7890</p>
<p>Alamat: Jl. Cafe No. 123</p>

<iframe 
src="https://maps.google.com/maps?q=jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed"
width="100%" height="200" style="border:0;">
</iframe>

</div>

</div>