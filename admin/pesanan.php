<?php
include "../koneksi.php";

/* CEK LOGIN */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

/* CEK ROLE ADMIN */
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

/* AMBIL DATA - SUDAH HIDE DIBATALKAN */
$data = mysqli_query($conn, "
SELECT * FROM pesanan 
WHERE status != 'dibatalkan'
ORDER BY id_pesanan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pesanan</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body{
    background:#a97458;
    font-family:Poppins;
}

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

<h3 class="mb-4">📦 Data Pesanan</h3>

<table class="table table-bordered text-center">

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
<td><?= $p['nama_pemesan'] ?></td>
<td>Rp <?= number_format($p['total'],0,',','.') ?></td>

<td>
<?php if($p['status']=='pending'){ ?>
<span class="badge bg-warning text-dark">Pending</span>

<?php } elseif($p['status']=='diproses'){ ?>
<span class="badge bg-primary">Diproses</span>

<?php } elseif($p['status']=='selesai'){ ?>
<span class="badge bg-success">Selesai</span>
<?php } ?>
</td>

<td>

<!-- DETAIL -->
<a href="detail_pesanan.php?id=<?= $p['id_pesanan'] ?>" 
class="btn btn-info btn-sm">
Detail
</a>

<?php if($p['status']=='pending'){ ?>

<!-- PROSES -->
<a href="update_status.php?id=<?= $p['id_pesanan'] ?>&status=diproses" 
class="btn btn-primary btn-sm"
onclick="return confirm('Terima pesanan ini?')">
⚙ Proses
</a>

<?php } elseif($p['status']=='diproses'){ ?>

<!-- SELESAI -->
<a href="update_status.php?id=<?= $p['id_pesanan'] ?>&status=selesai" 
class="btn btn-success btn-sm"
onclick="return confirm('Pesanan sudah selesai?')">
✔ Selesai
</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>