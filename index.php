<?php
include "koneksi.php";

$keyword = "";

if(isset($_GET['cari'])){
    $keyword = $_GET['keyword'];
    $query = mysqli_query($conn,"SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
}else{
    $query = mysqli_query($conn,"SELECT * FROM produk");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Cafe</title>

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

.navbar a{
color:white !important;
}

/* Dropdown Menu */

.dropdown-menu{
background:#5a3825;
border:none;
}

.dropdown-item{
color:white;
}

.dropdown-item:hover{
background:#7a4a32;
color:#ffd6a5;
}

/* Hero */

.hero{
text-align:center;
padding:60px;
color:white;
}

/* Search */

.search-box{
margin-top:20px;
}

/* Card */

.card{
border:none;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.card img{
border-radius:15px 15px 0 0;
}

.section{
padding:40px 0;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand text-white">☕ Black Coffee</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="reservasi.php">Reservasi</a>
</li>

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
Produk
</a>

<ul class="dropdown-menu">

<li><a class="dropdown-item" href="makanan.php">Makanan</a></li>
<li><a class="dropdown-item" href="">Dessert</a></li>
<li><a class="dropdown-item" href="#">Coffee</a></li>
<li><a class="dropdown-item" href="#">Non Coffee</a></li>

</ul>

</li>

<li class="nav-item">
<a class="nav-link" href="#">Gallery</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">Contact</a>
</li>

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
Akun
</a>

<ul class="dropdown-menu">

<li><a class="dropdown-item" href="login.php">Login</a></li>
<li><a class="dropdown-item" href="daftar.php">Daftar</a></li>

</ul>

</li>

</ul>

</div>

</div>

</nav>


<!-- HERO -->

<div class="hero">

<h1>Welcome to Black Coffee</h1>

<p>Nikmati kopi terbaik dan makanan lezat</p>

</div>


<!-- SEARCH -->

<div class="container search-box">

<form method="GET">

<div class="input-group">

<input type="text" name="keyword" class="form-control" placeholder="Cari produk...">

<button class="btn btn-dark" name="cari">Cari</button>

</div>

</form>

</div>


<!-- PRODUK -->

<div class="container section">

<h2 class="text-center mb-4">Daftar Produk</h2>

<div class="row">

<?php while($data = mysqli_fetch_assoc($query)){ ?>

<div class="col-md-3 mb-4">

<div class="card">

<img src="gambar/<?php echo $data['gambar']; ?>" height="200" class="card-img-top">

<div class="card-body text-center">

<h5><?php echo $data['nama_produk']; ?></h5>

<p>Rp <?php echo $data['harga']; ?></p>

<button class="btn btn-dark">Pesan</button>

</div>

</div>

</div>

<?php } ?>

</div>

</div>


<!-- INFO -->

<div class="container section text-center">

<div class="row">

<div class="col-md-4">

<h3>50+</h3>
<p>Produk</p>

</div>

<div class="col-md-4">

<h3>1000+</h3>
<p>Pelanggan</p>

</div>

<div class="col-md-4">

<h3>10+</h3>
<p>Cabang</p>

</div>

</div>

</div>


<!-- BOOTSTRAP JS (WAJIB UNTUK DROPDOWN) -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>