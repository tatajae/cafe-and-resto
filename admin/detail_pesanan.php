<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

// ambil pesanan
$p = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM pesanan WHERE id_pesanan='$id'
"));

// ambil detail
$detail = mysqli_query($conn, "
    SELECT d.*, pr.nama_produk 
    FROM detail_pesanan d
    JOIN produk pr ON d.id_produk = pr.id_produk
    WHERE d.id_pesanan='$id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Pesanan</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body{
    background:#a97458;
    font-family:Poppins;
}

/* BOX */
.container-box{
    background:white;
    padding:30px;
    margin-top:30px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

/* HEADER */
.header{
    border-bottom:2px solid #eee;
    margin-bottom:20px;
    padding-bottom:10px;
}

/* INFO */
.info-box{
    background:#f8f3ef;
    padding:15px;
    border-radius:10px;
}

/* TABLE */
.table thead{
    background:#5a3825;
    color:white;
}

.table tbody tr:hover{
    background:#f8f3ef;
}

/* TOTAL */
.total-box{
    background:#5a3825;
    color:white;
    padding:15px;
    border-radius:10px;
    text-align:right;
    font-size:18px;
}
</style>

</head>

<body>

<div class="container">

<div class="container-box">

<div class="header">
<h3>📦 Detail Pesanan</h3>
</div>

<div class="row mb-4">

<div class="col-md-6">
<div class="info-box">
<p><b>Nama:</b> <?= $p['nama_pemesan']; ?></p>
<p><b>Meja:</b> <?= $p['meja']; ?></p>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<p><b>Tanggal:</b> <?= date('d M Y H:i', strtotime($p['tanggal'])); ?></p>
<p><b>Status:</b> <?= $p['status']; ?></p>
</div>
</div>

</div>

<table class="table table-bordered">

<thead>
<tr>
<th>Produk</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
</tr>
</thead>

<tbody>

<?php 
$total = 0;
while($d = mysqli_fetch_assoc($detail)){ 
$sub = $d['harga'] * $d['jumlah'];
$total += $sub;
?>

<tr>
<td><?= $d['nama_produk']; ?></td>
<td>Rp <?= number_format($d['harga'],0,',','.'); ?></td>
<td><?= $d['jumlah']; ?></td>
<td>Rp <?= number_format($sub,0,',','.'); ?></td>
</tr>

<?php } ?>

</tbody>

</table>

<div class="row mt-3">

<div class="col-md-6">
<button onclick="history.back()" class="btn btn-secondary">⬅ Kembali</button>
<a href="struk.php?id=<?= $p['id_pesanan'] ?>" target="_blank" class="btn btn-dark">🧾 Cetak Struk</a>
</div>

<div class="col-md-6">
<div class="total-box">
Total: Rp <?= number_format($total,0,',','.'); ?>
</div>
</div>

</div>

</div>

</div>

</body>
</html>