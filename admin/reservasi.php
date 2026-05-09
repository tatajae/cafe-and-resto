<?php
include "../koneksi.php";

/* CEK ADMIN */
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../login.php");
    exit;
}

/* AMBIL DATA */
$data = mysqli_query($conn, "
    SELECT r.*, u.nama 
    FROM reservasi r
    JOIN users u ON r.id_user = u.id_user
    ORDER BY r.id_reservasi DESC
");

$total_reservasi = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Reservasi Admin</title>

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
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.stat-card{
background:#5a3825;
color:white;
padding:20px;
border-radius:15px;
text-align:center;
}

.table th{
background:#5a3825;
color:white;
}

.table tbody tr:hover{
background:#f8f1ec;
transition:0.3s;
}

.btn{
border-radius:10px;
}

</style>

</head>

<body>

<div class="container">

<div class="container-box">

<h3 class="text-center mb-4">
Data Reservasi
</h3>

<!-- NOTIF -->
<?php if(isset($_SESSION['notif'])){ ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">

<?= $_SESSION['notif']; ?>

<button type="button" class="btn-close" data-bs-dismiss="alert"></button>

</div>

<?php unset($_SESSION['notif']); } ?>

<!-- Statistik -->
<div class="row mb-4">

<div class="col-md-4">

<div class="stat-card">

<h2><?= $total_reservasi; ?></h2>
<p>Total Reservasi</p>

</div>

</div>

</div>

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<tr>
<th>No</th>
<th>Nama User</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah Orang</th>
<th>Status</th>
<th width="220">Aksi</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>

<td><?= date('H:i', strtotime($d['jam'])); ?></td>

<td><?= $d['jumlah_orang']; ?> orang</td>

<td>

<?php if($d['status']=="menunggu"){ ?>

<span class="badge bg-warning text-dark">
Menunggu
</span>

<?php } elseif($d['status']=="disetujui"){ ?>

<span class="badge bg-success">
Disetujui
</span>

<?php } elseif($d['status']=="dibatalkan"){ ?>

<span class="badge bg-secondary">
Dibatalkan
</span>

<?php } else { ?>

<span class="badge bg-danger">
Ditolak
</span>

<?php } ?>

</td>

<td>

<!-- SETUJUI -->
<a href="update_status_reservasi.php?id=<?= $d['id_reservasi']; ?>&status=disetujui" 
class="btn btn-success btn-sm">
✔ Setuju
</a>

<!-- TOLAK -->
<a href="update_status_reservasi.php?id=<?= $d['id_reservasi']; ?>&status=ditolak" 
class="btn btn-warning btn-sm">
✖ Tolak
</a>

<!-- HAPUS -->
<a href="hapus_reservasi.php?id=<?= $d['id_reservasi']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus reservasi ini?')">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>