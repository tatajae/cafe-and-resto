<div class="container mt-4">

<!-- ================= HERO CAROUSEL ================= -->
<div id="carouselExample"
     class="carousel slide carousel-fade mb-5"
     data-bs-ride="carousel"
     data-bs-interval="2500">

    <!-- indikator -->
    <div class="carousel-indicators">

        <button type="button"
                data-bs-target="#carouselExample"
                data-bs-slide-to="0"
                class="active">
        </button>

        <button type="button"
                data-bs-target="#carouselExample"
                data-bs-slide-to="1">
        </button>

        <button type="button"
                data-bs-target="#carouselExample"
                data-bs-slide-to="2">
        </button>

    </div>

    <div class="carousel-inner rounded-4 shadow-lg">

        <!-- FOTO 1 -->
        <div class="carousel-item active">

            <img src="gambar/hero1.jfif"
                 class="d-block w-100">

            <div class="carousel-caption">

                <h1>☕ Black Coffee</h1>

                <p>
                    Tempat nongkrong aesthetic dan cozy ✨
                </p>

                <a href="login.php"
                   class="btn btn-warning btn-lg rounded-pill px-4">
                    Pesan Sekarang
                </a>

            </div>

        </div>


        <!-- FOTO 2 -->
        <div class="carousel-item">

            <img src="gambar/hero2.jfif"
                 class="d-block w-100">

            <div class="carousel-caption">

                <h1>🔥 Promo Hari Ini</h1>

                <p>
                    Diskon 20% untuk semua kopi 🤎
                </p>

                <a href="login.php"
                   class="btn btn-danger btn-lg rounded-pill px-4">
                    Ambil Promo
                </a>

            </div>

        </div>


        <!-- FOTO 3 -->
        <div class="carousel-item">

            <img src="gambar/hero3.jfif"
                 class="d-block w-100">

            <div class="carousel-caption">

                <h1>🍰 Dessert Time</h1>

                <p>
                    Beli 2 Gratis 1 dessert favorit ✨
                </p>

                <a href="login.php"
                   class="btn btn-light btn-lg rounded-pill px-4">
                    Pesan Yuk
                </a>

            </div>

        </div>

    </div>

    <!-- tombol kiri -->
    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>

    </button>

    <!-- tombol kanan -->
    <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>

    </button>

</div>



<!-- ================= PROMO ================= -->
<div class="card mb-5">

<div class="row g-0">

<div class="col-md-6">

<img src="gambar/promo.jfif"
     class="w-100 h-100"
     style="object-fit:cover;">

</div>

<div class="col-md-6 d-flex align-items-center">

<div class="p-5">

<h1 class="judul">
🔥 Promo Hari Ini
</h1>

<p class="fs-5">
Diskon 20% semua kopi premium ☕
</p>

<p class="fs-5">
Beli 2 Gratis 1 dessert 🍰
</p>

<a href="login.php"
   class="btn btn-cute mt-3">
Login untuk Pesan
</a>

</div>

</div>

</div>

</div>



<!-- ================= MENU FAVORIT ================= -->
<div class="mb-5">

<h2 class="text-center judul mb-5">
☕ Menu Favorit
</h2>

<div class="row">

<?php
$query = mysqli_query($conn,"SELECT * FROM produk LIMIT 4");
while($p = mysqli_fetch_assoc($query)){
?>

<div class="col-md-3 mb-4">

<div class="card menu-card h-100">

<img src="gambar/<?= $p['gambar']; ?>"
     style="height:220px; object-fit:cover;">

<div class="card-body text-center">

<h5 class="fw-bold">
<?= $p['nama_produk']; ?>
</h5>

<p class="text-danger fw-bold fs-5">
Rp <?= number_format($p['harga']); ?>
</p>

<span class="badge bg-danger">
Best Seller
</span>

<br><br>

<a href="login.php"
   class="btn btn-cute">
Pesan
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>



<!-- ================= TESTIMONI ================= -->
<div class="card mb-5">

<div class="card-body p-5 text-center">

<h2 class="judul mb-5">
⭐ Testimoni Pelanggan
</h2>

<div class="row">

<div class="col-md-4 mb-3">

<div class="testi-box">

<h4>⭐⭐⭐⭐⭐</h4>

<p>
"Kopinya enak banget dan tempatnya cozy!"
</p>

<b>- Rina</b>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="testi-box">

<h4>⭐⭐⭐⭐⭐</h4>

<p>
"Pelayanannya ramah dan cepat 😍"
</p>

<b>- Andi</b>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="testi-box">

<h4>⭐⭐⭐⭐⭐</h4>

<p>
"Harga murah rasa premium 🤎"
</p>

<b>- Salsa</b>

</div>

</div>

</div>

</div>

</div>



<!-- ================= PEMBAYARAN ================= -->
<div class="card mb-5">

<div class="card-body p-5">

<h2 class="text-center judul mb-5">
💳 Cara Pembayaran
</h2>

<div class="row text-center">

<div class="col-md-3 mb-3">

<div class="pay-box">

<div class="pay-icon">
🏦
</div>

<h5 class="fw-bold">
Transfer Bank
</h5>

<p class="text-muted">
BCA • BRI • Mandiri
</p>

</div>

</div>


<div class="col-md-3 mb-3">

<div class="pay-box">

<div class="pay-icon">
📱
</div>

<h5 class="fw-bold">
OVO
</h5>

<p class="text-muted">
Praktis & cepat ✨
</p>

</div>

</div>


<div class="col-md-3 mb-3">

<div class="pay-box">

<div class="pay-icon">
💙
</div>

<h5 class="fw-bold">
Dana
</h5>

<p class="text-muted">
Scan dan bayar
</p>

</div>

</div>


<div class="col-md-3 mb-3">

<div class="pay-box">

<div class="pay-icon">
💵
</div>

<h5 class="fw-bold">
Cash
</h5>

<p class="text-muted">
Bayar di kasir
</p>

</div>

</div>

</div>

</div>

</div>



<!-- ================= KONTAK ================= -->
<div class="card mb-5">

<div class="card-body p-5">

<h2 class="text-center judul mb-5">
📞 Kontak Kami
</h2>

<div class="row">

<div class="col-md-5">

<p class="fs-5">
📱 WhatsApp: 0812-3456-7890
</p>

<p class="fs-5">
📍 Jl. Cafe No.123
</p>

<p class="fs-5">
⏰ 08.00 - 22.00
</p>

</div>

<div class="col-md-7">

<iframe
src="https://maps.google.com/maps?q=cirebon&t=&z=13&ie=UTF8&iwloc=&output=embed"
width="100%"
height="300"
style="border:0; border-radius:20px;">
</iframe>

</div>

</div>

</div>

</div>

</div>