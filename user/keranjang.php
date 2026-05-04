<?php
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

/* ambil keranjang */
$keranjang = mysqli_query($conn, "
SELECT k.*, p.nama_produk, p.harga, p.gambar
FROM keranjang k
JOIN produk p ON k.id_produk = p.id_produk
WHERE k.id_user='$id_user'
");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Keranjang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#a97458;
    font-family:Poppins;
}

.box{
    background:#fff;
    padding:25px;
    margin-top:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:1px solid #eee;
    padding:15px 0;
}

.item img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
}

.qty-box a{
    text-decoration:none;
    padding:5px 10px;
    background:#000;
    color:#fff;
    border-radius:5px;
}

.total-box{
    font-size:20px;
    font-weight:bold;
    text-align:right;
    margin-top:20px;
}

.checkout-btn{
    width:100%;
    padding:12px;
    background:#000;
    color:#fff;
    border:none;
    border-radius:10px;
    margin-top:15px;
}
</style>

</head>

<body>

<div class="container">

<div class="box">

<h3>🛒 Keranjang Kamu</h3>

<!-- ===================== -->
<!-- BUTTON TAMBAH MENU -->
<!-- ===================== -->
<a href="dashboard.php?page=menu" class="btn btn-dark w-100 mb-3">
➕ Tambah Menu
</a>

<?php if(mysqli_num_rows($keranjang) == 0){ ?>

<p>Keranjang masih kosong 😢</p>

<a href="dashboard.php?page=menu" class="btn btn-warning w-100">
Pilih Menu Sekarang
</a>

<?php } else { ?>

<?php while($k = mysqli_fetch_assoc($keranjang)) { 

$subtotal = $k['harga'] * $k['jumlah'];
$total += $subtotal;

?>

<div class="item">

<!-- gambar -->
<img src="../gambar/<?= $k['gambar']; ?>">

<!-- nama -->
<div style="width:180px;">
<b><?= $k['nama_produk']; ?></b><br>
<small>Rp <?= number_format($k['harga'],0,',','.'); ?></small>
</div>

<!-- qty -->
<div class="qty-box">
<a href="kurang.php?id=<?= $k['id_keranjang']; ?>">-</a>
<strong><?= $k['jumlah']; ?></strong>
<a href="tambah.php?id=<?= $k['id_keranjang']; ?>">+</a>
</div>

<!-- subtotal -->
<div>
<b>Rp <?= number_format($subtotal,0,',','.'); ?></b>
</div>

<!-- hapus -->
<div>
<a href="hapus_keranjang.php?id=<?= $k['id_keranjang']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus item ini?')">
🗑
</a>
</div>

</div>

<?php } ?>

<!-- TOTAL -->
<div class="total-box">
TOTAL: Rp <?= number_format($total,0,',','.'); ?>
</div>

<!-- CHECKOUT -->
<a href="dashboard.php?page=checkout">
<button class="checkout-btn">
💳 Checkout
</button>
</a>

<?php } ?>

</div>

</div>

</body>
</html>