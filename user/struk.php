<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
include "../koneksi.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

/* =========================
   AMBIL DATA
========================= */
$id = $_GET['id'] ?? 0;
$id_user = $_SESSION['id_user'] ?? 0;

/* PESANAN */
$pesanan = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan='$id' AND id_user='$id_user'
"));

if (!$pesanan) {
    die("Data pesanan tidak ditemukan atau akses tidak diizinkan.");
}

/* DETAIL PESANAN */
$detail = mysqli_query($conn, "
    SELECT d.*, p.nama_produk 
    FROM detail_pesanan d
    JOIN produk p ON d.id_produk = p.id_produk
    WHERE d.id_pesanan='$id'
");

/* =========================
   HTML STRUK
========================= */
$html = "
<style>
    body {
        font-family: Arial, sans-serif;
        color: #222;
    }

    .container {
        padding: 20px;
    }

    .header {
        text-align: center;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .header h2 {
        margin: 0;
        font-size: 20px;
        letter-spacing: 1px;
    }

    .header p {
        margin: 5px 0 0;
        font-size: 12px;
        color: #666;
    }

    .info {
        margin-top: 15px;
        font-size: 13px;
        line-height: 1.6;
    }

    .info b {
        display: inline-block;
        width: 120px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 13px;
    }

    table th {
        background: #333;
        color: #fff;
        padding: 8px;
        font-size: 12px;
    }

    table td {
        padding: 8px;
        border-bottom: 1px solid #eee;
    }

    .total {
        margin-top: 15px;
        text-align: right;
        font-size: 15px;
        font-weight: bold;
        border-top: 2px dashed #ccc;
        padding-top: 10px;
    }

    .footer {
        margin-top: 25px;
        text-align: center;
        font-size: 12px;
        color: #666;
    }
</style>

<div class='container'>

    <div class='header'>
        <h2>Cafe & Resto</h2>
        <p>Struk Pembayaran</p>
    </div>

    <div class='info'>
        <div><b>Nama Pemesan</b>: {$pesanan['nama_pemesan']}</div>
        <div><b>Meja</b>: {$pesanan['meja']}</div>
        <div><b>Tanggal</b>: {$pesanan['tanggal']}</div>
        <div><b>Pembayaran</b>: {$pesanan['pembayaran']}</div>
        <div><b>Status</b>: {$pesanan['status']}</div>
    </div>

    <table>
        <tr>
            <th>Menu</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
";

/* =========================
   LOOP DETAIL
========================= */
$total = 0;

while ($row = mysqli_fetch_assoc($detail)) {
    $subtotal = $row['harga'] * $row['jumlah'];
    $total += $subtotal;

    $html .= "
        <tr>
            <td>{$row['nama_produk']}</td>
            <td>{$row['jumlah']}</td>
            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
        </tr>
    ";
}

/* =========================
   TOTAL & FOOTER
========================= */
$html .= "
    </table>

    <div class='total'>
        TOTAL BAYAR: Rp " . number_format($total, 0, ',', '.') . "
    </div>

    <div class='footer'>
        Terima kasih telah berkunjung
    </div>

</div>
";

/* =========================
   GENERATE PDF
========================= */
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("struk-$id.pdf", ["Attachment" => 0]);
?>