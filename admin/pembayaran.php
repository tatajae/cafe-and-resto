<?php
include "../koneksi.php";

/* CEK LOGIN ADMIN */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

/* AMBIL DATA PESANAN */
$data = mysqli_query($conn,"
SELECT * FROM pesanan
ORDER BY id_pesanan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#a97458;
            font-family:Poppins;
        }

        .container-box{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
            margin-top:40px;
        }

        .title{
            color:#5a3825;
            font-weight:bold;
        }

        .table thead{
            background:#5a3825;
            color:white;
        }

        .img-bukti{
            width:90px;
            height:90px;
            object-fit:cover;
            border-radius:10px;
            border:2px solid #ddd;
        }

        .badge-pending{
            background:#ffc107;
            color:black;
            padding:8px 12px;
            border-radius:10px;
        }

        .badge-diproses{
            background:#0dcaf0;
            color:black;
            padding:8px 12px;
            border-radius:10px;
        }

        .badge-selesai{
            background:#198754;
            color:white;
            padding:8px 12px;
            border-radius:10px;
        }

        .badge-batal{
            background:#dc3545;
            color:white;
            padding:8px 12px;
            border-radius:10px;
        }

        .btn-cash{
            background:#198754;
            color:white;
        }

        .btn-transfer{
            background:#0d6efd;
            color:white;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="title">
                ☕ Verifikasi Pembayaran
            </h3>

            <a href="dashboard.php" class="btn btn-dark">
                Kembali
            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th width="320">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                while($d = mysqli_fetch_assoc($data)){

                    $status = strtolower(trim($d['status']));
                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        <?= $d['nama_pemesan']; ?>
                    </td>

                    <td>
                        <b>
                            Rp <?= number_format($d['total'],0,',','.'); ?>
                        </b>
                    </td>

                    <td>
                        <?= $d['pembayaran']; ?>
                    </td>

                    <!-- BUKTI -->
                    <td>

                        <?php if(!empty($d['bukti'])){ ?>

                            <img src="../bukti/<?= $d['bukti']; ?>"
                                 class="img-bukti">

                        <?php } else { ?>

                            <span class="text-danger">
                                Tidak Ada Bukti
                            </span>

                        <?php } ?>

                    </td>

                    <!-- STATUS -->
                    <td>

                        <?php if($status == 'pending'){ ?>

                            <span class="badge-pending">
                                Pending
                            </span>

                        <?php } ?>

                        <?php if($status == 'diproses'){ ?>

                            <span class="badge-diproses">
                                Diproses
                            </span>

                        <?php } ?>

                        <?php if($status == 'selesai'){ ?>

                            <span class="badge-selesai">
                                Selesai
                            </span>

                        <?php } ?>

                        <?php if($status == 'dibatalkan'){ ?>

                            <span class="badge-batal">
                                Dibatalkan
                            </span>

                        <?php } ?>

                    </td>

                    <!-- AKSI -->
                    <td>

                        <?php if($status == 'pending'){ ?>

                            <!-- CASH -->
                            <?php if($d['pembayaran'] == 'Cash'){ ?>

                                <a href="konfirmasi_cash.php?id=<?= $d['id_pesanan']; ?>"
                                   class="btn btn-cash btn-sm">
                                    💵 Bayar Cash
                                </a>

                            <?php } else { ?>

                                <!-- E-WALLET / TRANSFER -->
                                <a href="terima_pembayaran.php?id=<?= $d['id_pesanan']; ?>"
                                   class="btn btn-transfer btn-sm"
                                   onclick="return confirm('Terima pembayaran ini?')">
                                    ✔ Terima
                                </a>

                            <?php } ?>

                            <!-- TOLAK -->
                            <a href="tolak_pembayaran.php?id=<?= $d['id_pesanan']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin tolak pembayaran?')">
                                ✖ Tolak
                            </a>

                        <?php } ?>

                        <?php if($status == 'diproses'){ ?>

                            <a href="update_status.php?id=<?= $d['id_pesanan']; ?>&status=selesai"
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Pesanan sudah selesai?')">
                                ✔ Selesaikan
                            </a>

                        <?php } ?>

                        <?php if($status == 'selesai'){ ?>

                            <span class="text-success">
                                Pesanan selesai
                            </span>

                        <?php } ?>

                        <?php if($status == 'dibatalkan'){ ?>

                            <span class="text-danger">
                                Pembayaran ditolak
                            </span>

                        <?php } ?>

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