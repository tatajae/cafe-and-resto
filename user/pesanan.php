<?php
include "../koneksi.php";

$id_user = $_SESSION['id_user'] ?? 0;

$data = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_user='$id_user' 
    ORDER BY id_pesanan DESC
") or die(mysqli_error($conn));
?>

<div class="container-box">

<h4>📦 Pesanan Saya</h4>

<?php if(mysqli_num_rows($data) == 0){ ?>

<p>Belum ada pesanan.</p>
<a href="dashboard.php?page=menu" class="btn btn-dark">Pesan Sekarang</a>

<?php } else { ?>

<table class="table table-bordered mt-3">

<tr>
<th>No</th>
<th>Tanggal</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php $no=1; while($d = mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $no++ ?></td>

<td><?= date('d-m-Y H:i', strtotime($d['tanggal'])); ?></td>

<td>Rp <?= number_format($d['total'],0,',','.'); ?></td>

<td>
<?php if($d['status']=="pending"){ ?>
<span class="badge bg-warning">Pending</span>
<?php } elseif($d['status']=="diproses"){ ?>
<span class="badge bg-primary">Diproses</span>
<?php } else { ?>
<span class="badge bg-success">Selesai</span>
<?php } ?>
</td>

<td>
<a href="dashboard.php?page=detail_pesanan&id=<?= $d['id_pesanan']; ?>" 
class="btn btn-info btn-sm">
Detail
</a>
</td>

</tr>

<?php } ?>

</table>

<?php } ?>

</div>