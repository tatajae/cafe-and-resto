<?php
include "../koneksi.php";

/* AMBIL DATA LAPORAN */
$query = mysqli_query($conn,"
SELECT * FROM laporan
ORDER BY id_laporan DESC
");

/* TOTAL PEMASUKAN */
$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) as total_pemasukan
FROM laporan
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Pemasukan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#a97458;
    font-family:Poppins;
}

.box{
    background:white;
    padding:30px;
    border-radius:20px;
    margin-top:40px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.total-box{
    background:#5a3825;
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

.table{
    font-size:14px;
}

.badge-status{
    background:#198754;
    color:white;
    padding:8px 12px;
    border-radius:10px;
    font-size:12px;
}

</style>

</head>

<body>

<div class="container">

<div class="box">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            📊 Laporan Pemasukan
        </h3>

        <a href="index.php?menu=dashboard"
           class="btn btn-dark">
            Kembali
        </a>

    </div>

    <!-- TOTAL -->
    <div class="total-box">

        <h5>Total Pemasukan</h5>

        <h2>
            Rp <?= number_format($total['total_pemasukan'] ?? 0,0,',','.'); ?>
        </h2>

    </div>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle text-center">

            <thead class="table-dark">

                <tr>
                    <th>No</th>
                    <th>ID Pesanan</th>
                    <th>Nama Pemesan</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Uang Bayar</th>
                    <th>Kembalian</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>

            </thead>

            <tbody>

            <?php
            $no = 1;

            while($d = mysqli_fetch_assoc($query)){
            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        #<?= $d['id_pesanan']; ?>
                    </td>

                    <td>
                        <?= $d['nama_pemesan']; ?>
                    </td>

                    <td>
                        <?= $d['metode']; ?>
                    </td>

                    <td>
                        <b class="text-success">
                            Rp <?= number_format($d['total'],0,',','.'); ?>
                        </b>
                    </td>

                    <td>
                        Rp <?= number_format($d['uang_bayar'] ?? 0,0,',','.'); ?>
                    </td>

                    <td>
                        Rp <?= number_format($d['kembalian'] ?? 0,0,',','.'); ?>
                    </td>

                    <td>

                        <span class="badge-status">
                            <?= $d['status'] ?? 'Berhasil'; ?>
                        </span>

                    </td>

                    <td>
                        <?= date('d M Y H:i', strtotime($d['tanggal'])); ?>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</div>

</body>
</html>