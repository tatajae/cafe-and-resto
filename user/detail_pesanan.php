<?php
include "../koneksi.php";

/* DEBUG (hapus kalau sudah normal) */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* CEK LOGIN */
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id = $_GET['id'] ?? 0;

// validasi ID
if($id == 0){
    echo "<script>alert('ID tidak valid'); window.location='dashboard.php?page=pesanan';</script>";
    exit;
}

// ambil pesanan (aman sesuai user)
$p = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan='$id' AND id_user='$id_user'
")) or die(mysqli_error($conn));

// kalau tidak ada
if(!$p){
    echo "<script>alert('Data tidak ditemukan'); window.location='dashboard.php?page=pesanan';</script>";
    exit;
}

// ambil detail produk
$detail = mysqli_query($conn, "
    SELECT d.*, p.nama_produk
    FROM detail_pesanan d
    JOIN produk p ON d.id_produk = p.id_produk
    WHERE d.id_pesanan='$id'
");
?>

<div class="container-box">

<h4>📦 Detail Pesanan</h4>

<div class="row mb-3">

<div class="col-md-6">
<p><b>Nama:</b> <?= $p['nama_pemesan']; ?></p>
<p><b>Meja:</b> <?= $p['meja']; ?></p>
</div>

<div class="col-md-6">
<p><b>Tanggal:</b> <?= date('d-m-Y H:i', strtotime($p['tanggal'])); ?></p>
<p><b>Pembayaran:</b> <?= $p['pembayaran']; ?></p>
</div>

</div>

<p>
<b>Status:</b>
<?php if($p['status']=="pending"){ ?>
<span class="badge bg-warning">Pending</span>
<?php } elseif($p['status']=="diproses"){ ?>
<span class="badge bg-primary">Diproses</span>
<?php } else { ?>
<span class="badge bg-success">Selesai</span>
<?php } ?>
</p>

<hr>

<table class="table table-bordered">

<tr class="table-dark">
<th>Produk</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
</tr>

<?php 
$total = 0;
while($d = mysqli_fetch_assoc($detail)){ 
$subtotal = $d['harga'] * $d['jumlah'];
$total += $subtotal;
?>

<tr>
<td><?= $d['nama_produk']; ?></td>
<td>Rp <?= number_format($d['harga'],0,',','.'); ?></td>
<td><?= $d['jumlah']; ?></td>
<td>Rp <?= number_format($subtotal,0,',','.'); ?></td>
</tr>

<?php } ?>

</table>

<h5 class="text-end">Total: Rp <?= number_format($total,0,',','.'); ?></h5>

<a href="dashboard.php?page=pesanan" class="btn btn-secondary">
⬅ Kembali
</a>

</div>