<!-- =========================
     QUERY DATA REAL DATABASE
========================= -->

<?php

/* TOTAL PEMASUKAN */
$total_pemasukan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) AS total
FROM laporan
WHERE status='Berhasil'
"));

/* TOTAL CASH */
$total_cash = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) AS total
FROM laporan
WHERE metode='Cash'
AND status='Berhasil'
"));

/* TOTAL E-WALLET */
$total_ewallet = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) AS total
FROM laporan
WHERE metode!='Cash'
AND status='Berhasil'
"));

/* PESANAN TERBARU */
$pesanan = mysqli_query($conn,"
SELECT *
FROM pesanan
ORDER BY id_pesanan DESC
LIMIT 5
");

/* =========================
   PEMBAYARAN TERBARU
========================= */

$pembayaran = mysqli_query($conn,"
SELECT *
FROM pembayaran
WHERE bukti IS NOT NULL
AND bukti != ''
ORDER BY id DESC
LIMIT 5
");

?>

<!-- =========================
     DASHBOARD
========================= -->

<div class="container">

    <!-- STATISTIK -->
    <div class="container-box">

        <h3 class="mb-4">
            📊 Dashboard Pemilik
        </h3>

        <div class="row g-4">

            <div class="col-md-3">

                <div class="stat-card">

                    Produk <br>

                    <h3>
                        <?= $total_produk ?>
                    </h3>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-card">

                    User <br>

                    <h3>
                        <?= $total_user ?>
                    </h3>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-card">

                    Reservasi <br>

                    <h3>
                        <?= $total_reservasi ?>
                    </h3>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-card">

                    Pesanan <br>

                    <h3>
                        <?= $total_pesanan ?>
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
         RINGKASAN KEUANGAN
    ========================= -->

    <div class="container-box mt-4">

        <h4 class="mb-4">
            💰 Ringkasan Keuangan
        </h4>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="stat-card">

                    Total Pemasukan <br>

                    <h4>
                        Rp <?= number_format($total_pemasukan['total'] ?? 0,0,',','.') ?>
                    </h4>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    Cash <br>

                    <h4>
                        Rp <?= number_format($total_cash['total'] ?? 0,0,',','.') ?>
                    </h4>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    E-Wallet <br>

                    <h4>
                        Rp <?= number_format($total_ewallet['total'] ?? 0,0,',','.') ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
         PESANAN TERBARU
    ========================= -->

    <div class="container-box mt-4">

        <h4 class="mb-4">
            📦 Pesanan Terbaru
        </h4>

        <div class="table-responsive">

            <table class="table table-striped table-bordered text-center align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($p = mysqli_fetch_assoc($pesanan)){ ?>

                    <tr>

                        <td>
                            <?= $p['nama_pemesan'] ?>
                        </td>

                        <td>
                            Rp <?= number_format($p['total'],0,',','.') ?>
                        </td>

                        <td>
                            <?= $p['pembayaran'] ?>
                        </td>

                        <td>

                            <?php if($p['status'] == 'pending'){ ?>

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            <?php } ?>

                            <?php if($p['status'] == 'dibayar'){ ?>

                                <span class="badge bg-success">
                                    Dibayar
                                </span>

                            <?php } ?>

                            <?php if($p['status'] == 'diproses'){ ?>

                                <span class="badge bg-primary">
                                    Diproses
                                </span>

                            <?php } ?>

                            <?php if($p['status'] == 'selesai'){ ?>

                                <span class="badge bg-dark">
                                    Selesai
                                </span>

                            <?php } ?>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- =========================
         PEMBAYARAN TERBARU
    ========================= -->

    <div class="container-box mt-4 mb-5">

        <h4 class="mb-4">
            💳 Pembayaran Terbaru
        </h4>

        <div class="table-responsive">

            <table class="table table-striped table-bordered text-center align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Nama</th>
                        <th>Bukti</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($b = mysqli_fetch_assoc($pembayaran)){ ?>

                    <tr>

                        <td>
                            <?= $b['nama'] ?>
                        </td>

                        <td>

                            <?php if(!empty($b['bukti'])){ ?>

                                <img src="../bukti/<?= $b['bukti'] ?>"
                                     width="90"
                                     height="90"
                                     style="object-fit:cover;border-radius:10px;">

                            <?php } else { ?>

                                <span class="text-danger">
                                    Tidak ada bukti
                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <?php if($b['status'] == 'pending'){ ?>

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            <?php } ?>

                            <?php if($b['status'] == 'dibayar'){ ?>

                                <span class="badge bg-success">
                                    Dibayar
                                </span>

                            <?php } ?>

                            <?php if($b['status'] == 'diproses'){ ?>

                                <span class="badge bg-primary">
                                    Diproses
                                </span>

                            <?php } ?>

                            <?php if($b['status'] == 'selesai'){ ?>

                                <span class="badge bg-dark">
                                    Selesai
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