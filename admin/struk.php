<?php
include "../koneksi.php";

$id = $_GET['id'];

// ambil data pesanan
$data = mysqli_query($conn, "SELECT * FROM pesanan WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if(!$d){
    echo "Data tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>

    <style>
        body{
            font-family: monospace;
            background:#fff;
            text-align:center;
        }

        .struk{
            width:300px;
            margin:auto;
            padding:20px;
            border:1px dashed #000;
        }

        h3{
            margin:0;
        }

        .line{
            border-top:1px dashed black;
            margin:10px 0;
        }

        table{
            width:100%;
            font-size:14px;
        }

        td{
            padding:3px;
        }

        .right{
            text-align:right;
        }

        @media print {
            body{
                margin:0;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="struk">

    <h3>☕ Black Coffee</h3>
    <p>Terima Kasih</p>

    <div class="line"></div>

    <table>
        <tr>
            <td>Nama</td>
            <td>: <?= $d['nama_pemesan']; ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?= $d['tanggal']; ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: <?= $d['status']; ?></td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td>Total</td>
            <td class="right">Rp <?= number_format($d['total']); ?></td>
        </tr>
    </table>

    <div class="line"></div>

    <p>*** Terima Kasih ***</p>

</div>

</body>
</html>