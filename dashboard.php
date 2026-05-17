<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Black Coffee</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    background:#a97458;
    font-family:'Poppins', sans-serif;
}

/* navbar */
.navbar{
    background:#5a3825;
}

.navbar-brand,
.navbar a{
    color:white !important;
    font-weight:500;
}

/* card */
.card{
    border:none;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

/* carousel */
.carousel-item img{
    height:550px;
    object-fit:cover;
    filter:brightness(55%);
}

.carousel-caption{
    bottom:120px;
    background:rgba(0,0,0,0.4);
    padding:20px;
    border-radius:20px;
}

.carousel-caption h1{
    font-size:55px;
    font-weight:bold;
}

.carousel-caption p{
    font-size:22px;
}

/* tombol */
.btn-cute{
    background:#6f4e37;
    color:white;
    border:none;
    border-radius:50px;
    padding:10px 25px;
    transition:0.3s;
}

.btn-cute:hover{
    background:#8b5e3c;
    color:white;
    transform:scale(1.05);
}

/* menu */
.menu-card{
    transition:0.3s;
}

.menu-card:hover{
    transform:translateY(-10px) scale(1.03);
}

/* pembayaran */
.pay-box{
    background:#fff;
    border-radius:20px;
    padding:30px 20px;
    transition:0.3s;
    height:100%;
}

.pay-box:hover{
    transform:translateY(-8px);
    background:#fff1e8;
}

.pay-icon{
    font-size:60px;
    margin-bottom:15px;
}

/* testimoni */
.testi-box{
    background:#fff;
    border-radius:20px;
    padding:25px;
    transition:0.3s;
}

.testi-box:hover{
    transform:scale(1.03);
}

/* judul */
.judul{
    font-weight:bold;
    color:#6f4e37;
}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand">
☕ Black Coffee
</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php?page=home">
Home
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=produk">
Produk
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="index.php?page=reservasi">
Reservasi
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="login.php">
Login
</a>
</li>

</ul>

</div>

</nav>
<!-- ISI --> 
 <div class="container"> 
    <?php include "menu.php"; ?> 
</div>
<!-- FOOTER -->
<?php include "footer.php"; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>