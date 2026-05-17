<?php
include "../koneksi.php";

require_once "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$id = $_GET['id'] ?? 0;

/* =========================
   VALIDASI ID
========================= */
if(!$id){
    die("ID tidak valid");
}

/* =========================
   DATA PESANAN
========================= */
$q = mysqli_query($conn,"
    SELECT * FROM pesanan
    WHERE id_pesanan='$id'
");

if(mysqli_num_rows($q) == 0){
    die("Data tidak ditemukan");
}

$p = mysqli_fetch_assoc($q);

/* =========================
   DETAIL PESANAN
========================= */
$detail = mysqli_query($conn,"
    SELECT d.*, pr.nama_produk
    FROM detail_pesanan d
    JOIN produk pr ON d.id_produk = pr.id_produk
    WHERE d.id_pesanan='$id'
");

/* =========================
   DATA PEMBAYARAN
========================= */
$bayar = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM pembayaran
    WHERE id_pesanan='$id'
    ORDER BY id DESC
"));

/* =========================
   QR CODE
========================= */
if(!file_exists("../uploads")){
    mkdir("../uploads",0777,true);
}

$qrData = 
"ORDER #".$p['id_pesanan'].
" | ".$p['nama_pemesan'].
" | Rp ".$p['total'];

$qr = new QrCode($qrData);

$writer = new PngWriter();

$result = $writer->write($qr);

$qrPath = "../uploads/qr_".$id.".png";

$result->saveToFile($qrPath);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Struk Pembayaran</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

<style>

body{
    background:#f1f1f1;
    font-family:'Poppins', sans-serif;
}

.box{
    width:350px;
    margin:30px auto;
    background:white;
    padding:20px;
    border-radius:18px;
    box-shadow:0 15px 30px rgba(0,0,0,0.12);
}

.header{
    text-align:center;
}

.header h2{
    margin:0;
    color:#5a3825;
    font-size:24px;
    font-weight:600;
}

.header small{
    color:#888;
    font-size:12px;
}

.info{
    font-size:13px;
    margin-top:12px;
}

.info p{
    margin:4px 0;
}

.divider{
    border-top:1px dashed #ccc;
    margin:12px 0;
}

.table{
    width:100%;
    font-size:13px;
}

.table th{
    text-align:left;
    color:#666;
    padding-bottom:8px;
    font-weight:600;
}

.table td{
    padding:6px 0;
}

.right{
    text-align:right;
}

.total-box{
    margin-top:10px;
    border-top:1px solid #eee;
    padding-top:10px;
}

.total-row{
    display:flex;
    justify-content:space-between;
    margin:5px 0;
    font-size:13px;
}

.grand-total{
    font-weight:600;
    font-size:15px;
}

.qr{
    text-align:center;
    margin-top:15px;
}

.qr img{
    border-radius:10px;
}

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
    font-size:14px;
    cursor:pointer;
}

.btn-dark{
    background:black;
    color:white;
}

.btn-secondary{
    background:#ddd;
    color:black;
}

@media print{

    body{
        background:white;
    }

    .box{
        box-shadow:none;
        margin:0 auto;
    }

    .btn-area{
        display:none;
    }

}

</style>

</style>

</head>

<body onload="window.print()">

<div class="box">

    <!-- HEADER -->
    <div class="header">

        <h2>☕ BLACK COFFEE</h2>
        <small>Cafe & Resto</small>

    </div>

    <!-- INFO -->
    <div class="info">

        <p><b>ID:</b> #<?= $p['id_pesanan']; ?></p>

        <p><b>Nama:</b> <?= $p['nama_pemesan']; ?></p>

        <p><b>Meja:</b> <?= $p['meja']; ?></p>

        <p><b>Pembayaran:</b> <?= $bayar['metode'] ?? 'Cash'; ?></p>

        <p>
            <b>Tanggal:</b>
            <?= date('d M Y H:i', strtotime($p['tanggal'])); ?>
        </p>

    </div>

    <div class="divider"></div>

    <!-- DETAIL PESANAN -->
    <table class="table">

        <tr>
            <th>Menu</th>
            <th class="right">Qty</th>
            <th class="right">Total</th>
        </tr>

        <?php
        $grandTotal = 0;

        while($d = mysqli_fetch_assoc($detail)){

            $subTotal = $d['harga'] * $d['jumlah'];

            $grandTotal += $subTotal;
        ?>

        <tr>

            <td><?= $d['nama_produk']; ?></td>

            <td class="right">
                <?= $d['jumlah']; ?>
            </td>

            <td class="right">
                Rp <?= number_format($subTotal,0,',','.'); ?>
            </td>

        </tr>

        <?php } ?>

    </table>

    <div class="divider"></div>

    <!-- TOTAL -->
    <div class="total-box">

        <div class="total-row grand-total">

            <span>Total</span>

            <span>
                Rp <?= number_format($grandTotal,0,',','.'); ?>
            </span>

        </div>

        <div class="total-row">

            <span>Uang Bayar</span>

            <span>
                Rp <?= number_format($bayar['uang_bayar'] ?? 0,0,',','.'); ?>
            </span>

        </div>

        <div class="total-row">

            <span>Kembalian</span>

            <span>
                Rp <?= number_format($bayar['kembalian'] ?? 0,0,',','.'); ?>
            </span>

        </div>

    </div>

    <!-- QR -->
    <div class="qr">

        <img src="<?= $qrPath ?>" width="120">

    </div>

    <!-- FOOTER -->
    <div class="footer">
        Terima kasih sudah berkunjung ☕
    </div>

</div>

<!-- BUTTON -->
<div class="btn-area">

    <a href="struk_cash.php?id=<?= $id ?>" class="btn btn-dark">
        🖨 Print Ulang
    </a>

    <a href="index.php?menu=pesanan" class="btn btn-secondary">
        ⬅ Kembali
    </a>

</div>

</body>
</html>