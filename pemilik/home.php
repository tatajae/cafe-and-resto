<!-- =========================
     CONTENT
========================= -->

<div class="container">

<div class="container-box">

<h3 class="title">
📊 Dashboard Pemilik
</h3>

<!-- CARD STATISTIK -->

<div class="row g-4 mb-4">

<div class="col-md-3">

<div class="stat-card">

<h2><?= $total_produk; ?></h2>

<p>Total Produk</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-card">

<h2><?= $total_user; ?></h2>

<p>Total User</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-card">

<h2><?= $total_pesanan; ?></h2>

<p>Total Pesanan</p>

</div>

</div>

<div class="col-md-3">

<div class="stat-card">

<h2>
Rp <?= number_format($total_pemasukan['total'] ?? 0,0,',','.'); ?>
</h2>

<p>Total Pemasukan</p>

</div>

</div>

</div>

<!-- STATUS PESANAN -->

<div class="row mb-4">

<div class="col-md-12">

<div class="status-box">

<h5 class="mb-4 fw-bold" style="color:#5a3825;">
📦 Status Pesanan
</h5>

<div class="status-item">

<span>Pesanan Pending</span>

<span class="badge-custom bg-warning-custom">
<?= $pesanan_baru; ?>
</span>

</div>

<div class="status-item">

<span>Pesanan Diproses</span>

<span class="badge-custom bg-primary-custom">
<?= $pesanan_proses; ?>
</span>

</div>

<div class="status-item">

<span>Pesanan Selesai</span>

<span class="badge-custom bg-success-custom">
<?= $pesanan_selesai; ?>
</span>

</div>

</div>

</div>

</div>

<!-- MENU -->

<div class="row g-4">

<div class="col-md-4">

<div class="menu-card">

<h1>📦</h1>

<h5>Monitor Pesanan</h5>

<p>
Melihat seluruh data pesanan pelanggan secara realtime.
</p>

<a href="monitor_pesanan.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

<div class="col-md-4">

<div class="menu-card">

<h1>📈</h1>

<h5>Laporan Penjualan</h5>

<p>
Melihat laporan transaksi dan pemasukan cafe.
</p>

<a href="laporan_penjualan.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

<div class="col-md-4">

<div class="menu-card">

<h1>🏆</h1>

<h5>Produk Terlaris</h5>

<p>
Menampilkan produk yang paling banyak terjual.
</p>

<a href="produk_terlaris.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

<div class="col-md-4">

<div class="menu-card">

<h1>💰</h1>

<h5>Keuangan</h5>

<p>
Melihat total profit dan pemasukan cafe.
</p>

<a href="keuangan.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

<div class="col-md-4">

<div class="menu-card">

<h1>📤</h1>

<h5>Export Data</h5>

<p>
Export laporan penjualan ke Excel atau PDF.
</p>

<a href="export_excel.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

<div class="col-md-4">

<div class="menu-card">

<h1>🔔</h1>

<h5>Notifikasi</h5>

<p>
Melihat notifikasi pembayaran dan pesanan baru.
</p>

<a href="notifikasi.php"
   class="btn btn-dark-custom">

Buka

</a>

</div>

</div>

</div>

</div>

</div>
