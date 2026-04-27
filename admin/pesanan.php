<?php
include "../koneksi.php";

// PROTEKSI LOGIN
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// PROTEKSI ROLE
if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// AMBIL DATA PESANAN
$data = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body{background:#a97458;font-family:Poppins;}
        .container-box{
            background:white;
            padding:25px;
            margin-top:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }
        .btn-sm{margin:2px;}
    </style>
</head>

<body>

<div class="container">
    <div class="container-box">
        <h3>Data Pesanan</h3>

        <table class="table table-bordered table-striped">
            <tr class="table-dark">
                <th>No</th>
                <th>Nama</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php $no=1; while($p = mysqli_fetch_assoc($data)){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama'] ?></td>
                <td>Rp <?= number_format($p['total']) ?></td>
                <td>
                    <?php if($p['status'] == 'Pending'){ ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php }elseif($p['status'] == 'Diproses'){ ?>
                        <span class="badge bg-primary">Diproses</span>
                    <?php }elseif($p['status'] == 'Selesai'){ ?>
                        <span class="badge bg-success">Selesai</span>
                    <?php }else{ ?>
                        <span class="badge bg-danger">Dibatalkan</span>
                    <?php } ?>
                </td>

                <td>
                    <!-- DETAIL -->
                    <a href="detail_pesanan.php?id=<?= $p['id'] ?>" class="btn btn-info btn-sm">Detail</a>

                    <!-- UPDATE STATUS -->
                    <a href="update_status.php?id=<?= $p['id'] ?>&status=Diproses" class="btn btn-primary btn-sm">Proses</a>
                    <a href="update_status.php?id=<?= $p['id'] ?>&status=Selesai" class="btn btn-success btn-sm">Selesai</a>
                    <a href="update_status.php?id=<?= $p['id'] ?>&status=Dibatalkan" class="btn btn-danger btn-sm">Batal</a>

                    <!-- CETAK STRUK -->
                    <a href="../struk.php?id=<?= $p['id'] ?>" target="_blank" class="btn btn-dark btn-sm">Struk</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</div>

</body>
</html>