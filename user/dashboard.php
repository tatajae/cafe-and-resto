<?php
session_start();
include "../koneksi.php";

if ($_SESSION['role'] != "user") {
    header("location:../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f5f5;
}

/* NAVBAR */
.navbar{
    background:#5a3825;
}

.navbar-brand, .nav-link{
    color:white !important;
}

/* BOX */
.container-box{
    background:white;
    padding:25px;
    margin-top:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
<div class="container">

<a class="navbar-brand">☕ Cafe User</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="dashboard.php?page=home">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="dashboard.php?page=menu">Menu</a>
</li>

<li class="nav-item">
<a class="nav-link" href="dashboard.php?page=pesanan">Pesanan Saya</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../logout.php">Logout</a>
</li>

</ul>

</div>
</nav>

<!-- ISI -->
<div class="container">
    <?php include "menu.php"; ?>
</div>

<?php include "footer.php"; ?>

</body>
</html>