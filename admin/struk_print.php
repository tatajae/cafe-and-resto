<?php
session_start();
include "../koneksi.php";

require_once "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

/* CEK LOGIN */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

if (!$id) {
    die("ID tidak valid");
}

/* DATA PESANAN */
$p = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_pesanan='$id'");
if (mysqli_num_rows($p) == 0) {
    die("Data tidak ditemukan");
}
$p = mysqli_fetch_assoc($p);

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
<title>Print Struk</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    background:#f1f1f1;
    font-family:'Poppins', sans-serif;
}

.box{
    width:320px;
    margin:40px auto;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.header{text-align:center;}
.header h2{margin:0;color:#5a3825;}

.info{font-size:13px;margin-top:10px;}
.info p{margin:2px 0;}

.divider{border-top:1px dashed #ddd;margin:10px 0;}

.table{width:100%;font-size:13px;}
.table th{text-align:left;color:#777;}
.table td{padding:5px 0;}
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
    width:320px;
    margin:auto;
    margin-top:15px;
}

.btn{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:#ddd;
    text-align:center;
    text-decoration:none;
    display:block;
    color:black;
}

/* PRINT MODE */
@media print {
    body * {
        visibility: hidden;
    }

    .box, .box * {
        visibility: visible;
    }

    .box {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none;
    }

    .btn-area {
        display: none;
    }
}
</style>

<script>
function printStruk(){
    window.print();
}

/* 🔥 INI KUNCINYA */
window.onafterprint = function(){
    window.location.href = 'detail_pesanan.php?id=<?= $id ?>';
};
</script>

</head>

<!-- AUTO PRINT -->
<body onload="printStruk()">

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
<p style="font-size:11px;color:#999;">Scan untuk detail</p>
</div>

<div class="footer">
Terima kasih ☕
</div>

</div>

<!-- fallback tombol -->
<div class="btn-area">
<a href="detail_pesanan.php?id=<?= $id ?>" class="btn">
⬅ Kembali
</a>
</div>

</body>
</html>