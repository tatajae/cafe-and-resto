

<div class="container">

<div class="container-box">

<h3 class="text-center mb-4">Dashboard Pemilik</h3>

<!-- Statistik -->

<div class="row mb-4">

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