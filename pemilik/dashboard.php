<?php
include "../koneksi.php";

if($_SESSION['role']!="pemilik"){
header("location:../login.php");
}

/* Hitung data */

$total_produk = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM produk"));
$total_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$total_reservasi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reservasi"));

/* Ambil reservasi terbaru */

$reservasi = mysqli_query($conn,"SELECT * FROM reservasi ORDER BY id_reservasi DESC LIMIT 5");

/* Ambil produk */

$produk = mysqli_query($conn,"SELECT * FROM produk");

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Pemilik</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

/* Navbar */

.navbar{
background:#5a3825;
}

.navbar-brand{
color:white;
font-weight:bold;
}

.nav-link{
color:white !important;
}

/* Container */

.container-box{
background:white;
padding:30px;
margin-top:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* Statistik */

.stat-card{
background:#5a3825;
color:white;
padding:20px;
border-radius:15px;
text-align:center;
}

/* Produk Card */

.card{
border:none;
border-radius:15px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.card img{
height:200px;
object-fit:cover;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand">☕ Dashboard Pemilik</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../logout.php">Logout</a>
</li>

</ul>

</div>

</nav>


<!-- STATISTIK -->

<div class="container">

<div class="container-box">

<h3 class="text-center mb-4">Statistik Cafe</h3>

<div class="row">

<div class="col-md-4">

<div class="stat-card">

<h2><?php echo $total_produk; ?></h2>

<p>Total Produk</p>

</div>

</div>

<div class="col-md-4">

<div class="stat-card">

<h2><?php echo $total_user; ?></h2>

<p>Total User</p>

</div>

</div>

<div class="col-md-4">

<div class="stat-card">

<h2><?php echo $total_reservasi; ?></h2>

<p>Total Reservasi</p>

</div>

</div>

</div>

</div>

</div>


<!-- RESERVASI TERBARU -->

<div class="container">

<div class="container-box">

<h4>Reservasi Terbaru</h4>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah Orang</th>

</tr>

<?php
$no=1;
while($r=mysqli_fetch_assoc($reservasi)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $r['nama']; ?></td>
<td><?php echo $r['email']; ?></td>
<td><?php echo $r['tanggal']; ?></td>
<td><?php echo $r['jam']; ?></td>
<td><?php echo $r['jumlah_orang']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>


<!-- DAFTAR PRODUK -->

<div class="container">

<div class="container-box">

<h4 class="text-center mb-4">Daftar Produk</h4>

<div class="row">

<?php while($p=mysqli_fetch_assoc($produk)){ ?>

<div class="col-md-3 mb-4">

<div class="card">

<img src="../gambar/<?php echo $p['gambar']; ?>">

<div class="card-body text-center">

<h5><?php echo $p['nama_produk']; ?></h5>

<p><?php echo $p['kategori']; ?></p>

<p><b>Rp <?php echo $p['harga']; ?></b></p>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</div>
<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
include "footer.php";
?>
</body>
</html>