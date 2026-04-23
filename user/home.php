<div class="container-box">

<h3>Selamat Datang, <?= $_SESSION['username']; ?> 👋</h3>

<p>Silakan pilih menu di atas untuk mulai menggunakan layanan kami.</p>

<hr>

<div class="row text-center">

<div class="col-md-4">
    <a href="dashboard.php?page=menu" class="btn btn-dark w-100">Lihat Menu</a>
</div>

<div class="col-md-4">
    <a href="dashboard.php?page=pesanan" class="btn btn-success w-100">Pesanan Saya</a>
</div>

<div class="col-md-4">
    <a href="../index.php" class="btn btn-secondary w-100">Kembali ke Home</a>
</div>

</div>

</div>