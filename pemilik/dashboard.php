<?php
include "../koneksi.php";

/* =========================
   CEK LOGIN PEMILIK
========================= */
if(!isset($_SESSION['login'])){
    header("location:../login.php");
    exit;
}

if($_SESSION['role'] != "pemilik"){
    header("location:../login.php");
    exit;
}

/* =========================
   DATA DASHBOARD
========================= */
$total_produk = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM produk
"));

$total_user = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM users
"));

$total_reservasi = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM reservasi
"));

$total_pesanan = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM pesanan
"));

$total_pemasukan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) as total
FROM laporan
"));

$reservasi = mysqli_query($conn,"
SELECT * FROM reservasi
ORDER BY id_reservasi DESC
LIMIT 5
");

$produk = mysqli_query($conn,"
SELECT * FROM produk
LIMIT 6
");

/* =========================
   HALAMAN
========================= */
$page = $_GET['page'] ?? 'dashboard';

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Pemilik</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    background:#a97458;
    font-family:'Poppins', sans-serif;
}

/* =========================
   NAVBAR
========================= */
.navbar{
    background:#5a3825;
    padding:15px 0;
}

.navbar-brand{
    color:white !important;
    font-weight:700;
    font-size:22px;
}

.nav-link{
    color:white !important;
    margin-left:10px;
    font-weight:500;
}

.nav-link:hover{
    color:#ffd7b5 !important;
}

/* =========================
   CONTAINER
========================= */
.container-box{
    background:white;
    padding:30px;
    margin-top:30px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* =========================
   CARD STATISTIK
========================= */
.stat-card{
    background:#5a3825;
    color:white;
    padding:25px;
    border-radius:18px;
    text-align:center;
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-card h2{
    font-size:32px;
    font-weight:bold;
}

.stat-card p{
    margin:0;
    opacity:0.9;
}

/* =========================
   TITLE
========================= */
.title{
    color:#5a3825;
    font-weight:700;
    margin-bottom:25px;
}

/* =========================
   TABLE
========================= */
.table thead{
    background:#5a3825;
    color:white;
}

.table{
    border-radius:15px;
    overflow:hidden;
}

/* =========================
   MENU CARD
========================= */
.menu-card{
    background:#fff7f2;
    border-radius:18px;
    padding:25px;
    text-align:center;
    transition:0.3s;
    height:100%;
    border:2px solid #f1d3c0;
}

.menu-card:hover{
    transform:translateY(-5px);
    background:#ffe9db;
}

.menu-card h5{
    margin-top:15px;
    color:#5a3825;
    font-weight:600;
}

.menu-card p{
    font-size:14px;
    color:#555;
}

/* =========================
   BUTTON
========================= */
.btn-dark-custom{
    background:#5a3825;
    color:white;
    border:none;
}

.btn-dark-custom:hover{
    background:#3d2418;
    color:white;
}

/* =========================
   FOOTER
========================= */
.footer{
    text-align:center;
    color:white;
    padding:20px;
    margin-top:30px;
}

</style>

</head>

<body>

<!-- =========================
     NAVBAR
========================= -->
<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand">
☕ Dashboard Pemilik
</a>

<button class="navbar-toggler bg-light"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php?page=dashboard">
Dashboard
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=monitor_pesanan">
Monitor Pesanan
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=laporan_penjualan">
Laporan Penjualan
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=metode_pembayaran">
Metode Pembayaran
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=produk_terlaris">
Produk Terlaris
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=keuangan">
Keuangan
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=export_data">
Export Data
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=notifikasi">
Notifikasi
</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="../logout.php">
Logout
</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- =========================
     CONTENT
========================= -->
<div class="container">

<div class="container-box">

<?php

/* =========================
   DASHBOARD
========================= */
if($page == "dashboard"){
?>

<h3 class="title">
📊 Dashboard Pemilik
</h3>

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

<div class="row g-4">

<div class="col-md-4">
<div class="menu-card">
<h1>📦</h1>
<h5>Monitor Pesanan</h5>
<p>Melihat semua pesanan dan status secara realtime.</p>
<a href="index.php?page=monitor_pesanan"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

<div class="col-md-4">
<div class="menu-card">
<h1>📈</h1>
<h5>Laporan Penjualan</h5>
<p>Melihat data pemasukan dan transaksi harian.</p>
<a href="index.php?page=laporan_penjualan"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

<div class="col-md-4">
<div class="menu-card">
<h1>💳</h1>
<h5>Metode Pembayaran</h5>
<p>Perbandingan pembayaran Cash dan E-Wallet.</p>
<a href="index.php?page=metode_pembayaran"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

<div class="col-md-4">
<div class="menu-card">
<h1>🏆</h1>
<h5>Produk Terlaris</h5>
<p>Melihat produk paling banyak terjual.</p>
<a href="index.php?page=produk_terlaris"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

<div class="col-md-4">
<div class="menu-card">
<h1>💰</h1>
<h5>Keuangan / Profit</h5>
<p>Melihat total keuntungan cafe & resto.</p>
<a href="index.php?page=keuangan"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

<div class="col-md-4">
<div class="menu-card">
<h1>🔔</h1>
<h5>Notifikasi</h5>
<p>Informasi pesanan baru dan pembayaran masuk.</p>
<a href="index.php?page=notifikasi"
   class="btn btn-dark-custom">
Buka
</a>
</div>
</div>

</div>

<?php } ?>

<!-- =========================
     MONITOR PESANAN
========================= -->
<?php if($page == "monitor_pesanan"){ ?>

<h3 class="title">
📦 Monitor Pesanan
</h3>

<table class="table table-bordered table-hover">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Meja</th>
<th>Total</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

$q = mysqli_query($conn,"
SELECT * FROM pesanan
ORDER BY id_pesanan DESC
");

while($d = mysqli_fetch_assoc($q)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_pemesan']; ?></td>

<td><?= $d['meja']; ?></td>

<td>
Rp <?= number_format($d['total'],0,',','.'); ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<?php } ?>

<!-- =========================
     LAPORAN PENJUALAN
========================= -->
<?php if($page == "laporan_penjualan"){ ?>

<h3 class="title">
📈 Laporan Penjualan
</h3>

<table class="table table-bordered">

<thead>
<tr>
<th>No</th>
<th>ID Pesanan</th>
<th>Total</th>
<th>Metode</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

$q = mysqli_query($conn,"
SELECT * FROM laporan
ORDER BY id_laporan DESC
");

while($d = mysqli_fetch_assoc($q)){
?>

<tr>

<td><?= $no++; ?></td>

<td>#<?= $d['id_pesanan']; ?></td>

<td>
Rp <?= number_format($d['total'],0,',','.'); ?>
</td>

<td><?= $d['metode']; ?></td>

<td><?= $d['tanggal']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<?php } ?>

<!-- =========================
     METODE PEMBAYARAN
========================= -->
<?php if($page == "metode_pembayaran"){ ?>

<h3 class="title">
💳 Metode Pembayaran
</h3>

<div class="row">

<?php
$cash = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) as total
FROM laporan
WHERE metode='Cash'
"));

$ewallet = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) as total
FROM laporan
WHERE metode!='Cash'
"));
?>

<div class="col-md-6">

<div class="stat-card">

<h2>
Rp <?= number_format($cash['total'] ?? 0,0,',','.'); ?>
</h2>

<p>Cash</p>

</div>

</div>

<div class="col-md-6">

<div class="stat-card">

<h2>
Rp <?= number_format($ewallet['total'] ?? 0,0,',','.'); ?>
</h2>

<p>E-Wallet / Transfer</p>

</div>

</div>

</div>

<?php } ?>

<!-- =========================
     PRODUK TERLARIS
========================= -->
<?php if($page == "produk_terlaris"){ ?>

<h3 class="title">
🏆 Produk Terlaris
</h3>

<table class="table table-bordered">

<thead>
<tr>
<th>No</th>
<th>Produk</th>
<th>Total Terjual</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

$q = mysqli_query($conn,"
SELECT produk.nama_produk,
SUM(detail_pesanan.jumlah) as total_terjual
FROM detail_pesanan
JOIN produk ON detail_pesanan.id_produk = produk.id_produk
GROUP BY detail_pesanan.id_produk
ORDER BY total_terjual DESC
");

while($d = mysqli_fetch_assoc($q)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_produk']; ?></td>

<td><?= $d['total_terjual']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<?php } ?>

<!-- =========================
     KEUANGAN
========================= -->
<?php if($page == "keuangan"){ ?>

<h3 class="title">
💰 Keuangan / Profit
</h3>

<?php
$profit = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) as total
FROM laporan
"));
?>

<div class="stat-card">

<h1>
Rp <?= number_format($profit['total'] ?? 0,0,',','.'); ?>
</h1>

<p>Total Profit</p>

</div>

<?php } ?>

<!-- =========================
     EXPORT DATA
========================= -->
<?php if($page == "export_data"){ ?>

<h3 class="title">
📤 Export Data
</h3>

<p>
Export laporan penjualan ke Excel / PDF.
</p>

<a href="export_excel.php" class="btn btn-success">
Export Excel
</a>

<?php } ?>

<!-- =========================
     NOTIFIKASI
========================= -->
<?php if($page == "notifikasi"){ ?>

<h3 class="title">
🔔 Notifikasi
</h3>

<div class="alert alert-success">
Ada pesanan baru masuk.
</div>

<div class="alert alert-warning">
Pembayaran menunggu verifikasi.
</div>

<div class="alert alert-info">
Pesanan selesai diproses.
</div>

<?php } ?>

</div>

</div>

<!-- =========================
     FOOTER
========================= -->

    <?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>