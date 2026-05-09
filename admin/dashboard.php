<?php
// ===============================
// ADMIN DASHBOARD FINAL
// ===============================
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
$pesanan = mysqli_query($conn, "
SELECT * FROM pesanan 
ORDER BY id_pesanan DESC 
LIMIT 5
");

$pembayaran = mysqli_query($conn,"
SELECT * FROM pembayaran
ORDER BY id DESC
LIMIT 5
");
// ===============================
// HITUNG DATA
// ===============================
$total_produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk"));
$total_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_reservasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reservasi"));
$total_pesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesanan"));

$total_pemasukan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total) AS total FROM pesanan WHERE status='lunas'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body{
            background:#a97458;
            font-family:Poppins;
        }

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
    </style>
</head>

<body>

<!-- NAVBAR BARU (SUDAH DIRAPIKAN) -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand">☕ Black Coffee Admin</a>

        <ul class="navbar-nav ms-auto">

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">Dashboard</a>
            </li>

            <!-- OPERASIONAL -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Operasional</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php?menu=pesanan">Pesanan</a></li>
                    <li><a class="dropdown-item" href="index.php?menu=pembayaran">Pembayaran</a></li>
                    <li><a class="dropdown-item" href="index.php?menu=reservasi">Reservasi</a></li>
                </ul>
            </li>

            <!-- KEUANGAN -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Keuangan</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php?menu=laporan_pemasukan">Laporan Pemasukan</a></li>
                    <li><a class="dropdown-item" href="index.php?menu=laporan_harian">Laporan Harian</a></li>
                </ul>
            </li>

            <!-- MASTER DATA -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Master Data</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php?menu=produk">Produk</a></li>
                    <li><a class="dropdown-item" href="index.php?menu=user">User</a></li>
                </ul>
            </li>

            <!-- LOGOUT -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>

        </ul>

    </div>
</nav>

<!-- DASHBOARD CONTENT -->
<div class="container">

    <?php include "menu.php"; ?>

</div>
    <?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>