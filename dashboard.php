<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Black Coffee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#a97458;
}

.navbar{
    background:#5a3825;
}

.navbar a{
    color:white !important;
}

.container-box{
    background:white;
    padding:25px;
    margin-top:20px;
    border-radius:15px;
}

.carousel-caption{
background:rgba(0,0,0,0.5);
padding:15px;
border-radius:10px;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
<div class="container">

<a class="navbar-brand">☕ Black Coffee</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php?page=home">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=produk">Produk</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=reservasi">Reservasi</a>
</li>

<li class="nav-item">
<a class="nav-link" href="login.php">Login</a>
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