<?php
include "../koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

/* Hitung jumlah data */
$total_produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk"));
$total_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_reservasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reservasi"));

/* Ambil data produk */
$produk = mysqli_query($conn, "SELECT * FROM produk");

/* Ambil pesanan */
$pesanan = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC LIMIT 5");

/* Ambil pembayaran */
$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran ORDER BY id DESC LIMIT 5");
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

        .card img{
            height:180px;
            object-fit:cover;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand">☕ Black Coffee Admin</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?menu=produk">Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?menu=reservasi">Reservasi</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?menu=user">User</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<!-- ISI HALAMAN -->
<div class="container">
    <?php include "menu.php"; ?>
</div>

<?php include "footer.php"; ?>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>