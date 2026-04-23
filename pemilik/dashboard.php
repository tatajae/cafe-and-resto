<?php
include "../koneksi.php";

if ($_SESSION['role'] != "pemilik") {
    header("location:../login.php");
}

/* DATA */
$total_produk = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM produk"));
$total_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$total_reservasi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reservasi"));

$reservasi = mysqli_query($conn,"SELECT * FROM reservasi ORDER BY id_reservasi DESC LIMIT 5");
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

/* NAVBAR */
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

/* BOX */
.container-box{
background:white;
padding:30px;
margin-top:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* STAT */
.stat-card{
background:#5a3825;
color:white;
padding:20px;
border-radius:15px;
text-align:center;
}
</style>

</head>

<body>

<!-- NAVBAR LANGSUNG DI SINI -->
<nav class="navbar navbar-expand-lg">
<div class="container">

<a class="navbar-brand">☕ Dashboard Pemilik</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php?page=home">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=laporan">Laporan</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../logout.php">Logout</a>
</li>

</ul>

</div>
</nav>

<!-- ISI HALAMAN -->
<div class="container">
    <?php include "menu.php"; ?>
</div>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>