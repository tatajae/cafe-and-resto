<?php
include "../koneksi.php";

/* CEK ADMIN */
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../login.php");
    exit;
}

/* DATA */
$data = mysqli_query($conn,"
SELECT reservasi.*, users.nama
FROM reservasi
JOIN users ON reservasi.id_user = users.id_user
ORDER BY reservasi.id_reservasi DESC
");

$total_reservasi = mysqli_num_rows($data);
?>

<style>

.container-box{
    background:white;
    padding:30px;
    margin-top:20px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.title{
    color:#5a3825;
    font-weight:700;
}

.table thead{
    background:#5a3825;
    color:white;
}

.stat-card{
    background:#5a3825;
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
}

</style>

<div class="container">

<div class="container-box">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="title">
            📅 Data Reservasi
        </h3>

        <a href="index.php?menu=dashboard"
           class="btn btn-dark">
            ← Kembali
        </a>

    </div>

    <!-- TOTAL -->
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="stat-card">

                <h2><?= $total_reservasi; ?></h2>

                <p>Total Reservasi</p>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table table-bordered table-hover text-center align-middle">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jumlah Orang</th>
                    <th>Status</th>
                    <th width="250">Aksi</th>
                </tr>

            </thead>

            <tbody>

            <?php
            $no = 1;

            while($d = mysqli_fetch_assoc($data)){
            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $d['nama']; ?></td>

                <td><?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>

                <td><?= date('H:i', strtotime($d['jam'])); ?></td>

                <td><?= $d['jumlah_orang']; ?> Orang</td>

                <td>

                    <?php if($d['status']=="menunggu"){ ?>

                        <span class="badge bg-warning text-dark">
                            Menunggu
                        </span>

                    <?php } elseif($d['status']=="disetujui"){ ?>

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    <?php } elseif($d['status']=="ditolak"){ ?>

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-secondary">
                            Dibatalkan
                        </span>

                    <?php } ?>

                </td>

                <td>

                    <?php if($d['status']=="menunggu"){ ?>

                        <a href="update_status_reservasi.php?id=<?= $d['id_reservasi']; ?>&status=disetujui"
                           class="btn btn-success btn-sm">

                            ✔ Setuju

                        </a>

                        <a href="update_status_reservasi.php?id=<?= $d['id_reservasi']; ?>&status=ditolak"
                           class="btn btn-warning btn-sm">

                            ✖ Tolak

                        </a>

                    <?php } ?>

                    <a href="hapus_reservasi.php?id=<?= $d['id_reservasi']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Hapus reservasi ini?')">

                        🗑 Hapus

                    </a>

                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</div>