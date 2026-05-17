<?php
include "../koneksi.php";
$id = $_GET['id'];

/* AMBIL DATA PESANAN */
$p = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan='$id'
"));

/* CEK STATUS */
$status = strtolower(trim($p['status']));

/* WARNA BADGE */
$badge = "secondary";
$text_status = ucfirst($status);

if($status == "pending"){
    $badge = "warning text-dark";
    $text_status = "Pending";
}

elseif($status == "diproses"){
    $badge = "primary";
    $text_status = "Diproses";
}

elseif($status == "selesai"){
    $badge = "success";
    $text_status = "Selesai";
}

elseif($status == "dibatalkan"){
    $badge = "danger";
    $text_status = "Dibatalkan";
}

/* AMBIL DETAIL PESANAN */
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

.container-box{
    background:white;
    padding:30px;
    margin-top:30px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.header{
    border-bottom:2px solid #eee;
    margin-bottom:25px;
    padding-bottom:10px;
}

.info-box{
    background:#f8f3ef;
    padding:18px;
    border-radius:12px;
    height:100%;
}

.info-box p{
    margin-bottom:10px;
    font-size:15px;
}

.table thead{
    background:#5a3825;
    color:white;
}

.table tbody tr:hover{
    background:#f8f3ef;
}

.total-box{
    background:#5a3825;
    color:white;
    padding:18px;
    border-radius:12px;
    text-align:right;
    font-size:20px;
    font-weight:bold;
}

.badge-status{
    padding:8px 14px;
    border-radius:10px;
    font-size:14px;
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

    <!-- INFO KIRI -->
    <div class="col-md-6 mb-3">

        <div class="info-box">

            <p>
                <b>Nama Pemesan :</b><br>
                <?= $p['nama_pemesan']; ?>
            </p>

            <p>
                <b>No Meja :</b><br>
                <?= $p['meja']; ?>
            </p>

            <p>
                <b>Pembayaran :</b><br>
                <?= $p['pembayaran']; ?>
            </p>

        </div>

    </div>

    <!-- INFO KANAN -->
    <div class="col-md-6 mb-3">

        <div class="info-box">

            <p>
                <b>Tanggal :</b><br>
                <?= date('d M Y H:i', strtotime($p['tanggal'])); ?>
            </p>

            <p>
                <b>Status :</b><br>

                <span class="badge bg-<?= $badge; ?> badge-status">
                    <?= $text_status; ?>
                </span>
            </p>

        </div>

    </div>

</div>

<!-- TABEL -->
<div class="table-responsive">

<table class="table table-bordered align-middle">

    <thead>
        <tr>
            <th>Produk</th>
            <th width="150">Harga</th>
            <th width="100">Jumlah</th>
            <th width="180">Subtotal</th>
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

        <td>
            <?= $d['nama_produk']; ?>
        </td>

        <td>
            Rp <?= number_format($d['harga'],0,',','.'); ?>
        </td>

        <td>
            <?= $d['jumlah']; ?>
        </td>

        <td>
            Rp <?= number_format($sub,0,',','.'); ?>
        </td>

    </tr>

    <?php } ?>

    </tbody>

</table>

</div>

<!-- FOOTER -->
<div class="row mt-4">

    <div class="col-md-6 mb-3">

        <a href="index.php?menu=pesanan&id=<?= $id ?>" class="btn">
        ⬅ Kembali
        </a>

        <?php if($status == "selesai"){ ?>

        <a href="struk.php?id=<?= $p['id_pesanan']; ?>" 
           target="_blank"
           class="btn btn-dark">
            🧾 Cetak Struk
        </a>

        <?php } ?>

    </div>

    <div class="col-md-6">

        <div class="total-box">
            Total : Rp <?= number_format($total,0,',','.'); ?>
        </div>

    </div>

</div>

</div>

</div>

</body>
</html>