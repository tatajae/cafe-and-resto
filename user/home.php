<?php
$id = $_SESSION['id_user'] ?? 0;

$total_pesanan = 0;

$q = mysqli_query($conn, "SHOW TABLES LIKE 'pesanan'");
if(mysqli_num_rows($q) > 0){

    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesanan WHERE id_user='$id'");
    $data = mysqli_fetch_assoc($result);
    $total_pesanan = $data['total'] ?? 0;
}
?>

<div class="container-box">

<h3>Selamat Datang, <?= $_SESSION['username']; ?> 👋</h3>
<p>Senang melihat kamu kembali di Black Coffee ☕</p>

<hr>

<div class="row text-center">

<div class="col-md-4 mb-3">
<div class="card p-3 shadow-sm">
<h6>Total Pesanan</h6>
<h3><?= $total_pesanan ?></h3>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card p-3 shadow-sm">
<h6>Status</h6>
<span class="badge bg-success">Aktif</span>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card p-3 shadow-sm">
<h6>Aksi Cepat</h6>
<a href="dashboard.php?page=menu" class="btn btn-dark btn-sm mt-2">Pesan Sekarang</a>
</div>
</div>

</div>

</div>