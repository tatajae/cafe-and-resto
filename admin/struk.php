<?php
session_start();
include "../koneksi.php";

require_once "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$id = $_GET['id'] ?? 0;

/* VALIDASI ID */
if (!$id) {
    die("ID tidak valid");
}

/* DATA PESANAN */
$q = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_pesanan='$id'");
if (mysqli_num_rows($q) == 0) {
    die("Data tidak ditemukan");
}
$p = mysqli_fetch_assoc($q);

/* DETAIL PRODUK */
$detail = mysqli_query($conn, "
SELECT d.*, pr.nama_produk 
FROM detail_pesanan d
JOIN produk pr ON d.id_produk = pr.id_produk
WHERE d.id_pesanan='$id'
");

/* BUAT FOLDER QR */
if (!file_exists("../uploads")) {
    mkdir("../uploads", 0777, true);
}

/* GENERATE QR */
$qrData = "ORDER#".$p['id_pesanan']." | ".$p['nama_pemesan']." | Rp ".$p['total'];

$qr = new QrCode($qrData);
$writer = new PngWriter();
$result = $writer->write($qr);

$qrPath = "../uploads/qr_".$id.".png";
$result->saveToFile($qrPath);
?>

<!DOCTYPE html>
<html>
<head>
<title>Struk</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    background:#f1f1f1;
    font-family:'Poppins', sans-serif;
}

.box{
    width:350px;
    margin:40px auto;
    background:white;
    padding:20px;
    border-radius:18px;
    box-shadow:0 15px 30px rgba(0,0,0,0.12);
}

.header{text-align:center;}
.header h2{margin:0;color:#5a3825;}

.info{font-size:13px;margin-top:10px;}
.info p{margin:2px 0;}

.divider{border-top:1px dashed #ddd;margin:10px 0;}

.table{width:100%;font-size:13px;}
.table th{text-align:left;color:#777;}
.table td{padding:6px 0;}
.right{text-align:right;}

.total{
    margin-top:10px;
    border-top:1px solid #eee;
    padding-top:10px;
    display:flex;
    justify-content:space-between;
    font-weight:600;
}

.qr{text-align:center;margin-top:15px;}

.footer{
    text-align:center;
    font-size:12px;
    color:#888;
    margin-top:10px;
}

.btn-area{
    width:350px;
    margin:15px auto;
    display:flex;
    gap:10px;
}

.btn{
    flex:1;
    padding:10px;
    border:none;
    border-radius:12px;
    text-align:center;
    text-decoration:none;
    font-weight:500;
    cursor:pointer;
}

.btn-dark{background:black;color:white;}
.btn-secondary{background:#ddd;color:black;}
</style>

</head>

<body>

<div class="box">

<div class="header">
<h2>☕ Coffee Shop</h2>
<small>Receipt</small>
</div>

<div class="info">
<p>ID: <?= $p['id_pesanan']; ?></p>
<p>Nama: <?= $p['nama_pemesan']; ?></p>
<p>Tanggal: <?= date('d M Y H:i', strtotime($p['tanggal'])); ?></p>
</div>

<div class="divider"></div>

<table class="table">
<tr>
<th>Menu</th>
<th class="right">Qty</th>
<th class="right">Total</th>
</tr>

<?php 
$total = 0;
while($d = mysqli_fetch_assoc($detail)){
    $sub = $d['harga'] * $d['jumlah'];
    $total += $sub;
?>
<tr>
<td><?= $d['nama_produk']; ?></td>
<td class="right"><?= $d['jumlah']; ?></td>
<td class="right">Rp <?= number_format($sub,0,',','.'); ?></td>
</tr>
<?php } ?>
</table>

<div class="total">
<span>Total</span>
<span>Rp <?= number_format($total,0,',','.'); ?></span>
</div>

<div class="qr">
<img src="<?= $qrPath ?>" width="120">
</div>

<div class="footer">
Terima kasih ☕
</div>

</div>

<!-- 🔥 TOMBOL -->
<div class="btn-area">

<a href="struk_print.php?id=<?= $id ?>" class="btn btn-dark">
🖨 Cetak
</a>

<a href="detail_pesanan.php?id=<?= $id ?>" class="btn">
⬅ Kembali
</a>

</div>

</body>
</html>