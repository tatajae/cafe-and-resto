
<!-- =========================
     MONITOR PESANAN
========================= -->
<?php if($page == "monitor_pesanan"){ ?>

<h3 class="title">
📦 Monitor Pesanan
</h3>

<table class="table table-bordered table-hover">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Meja</th>
<th>Total</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

$q = mysqli_query($conn,"
SELECT * FROM pesanan
ORDER BY id_pesanan DESC
");

while($d = mysqli_fetch_assoc($q)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_pemesan']; ?></td>

<td><?= $d['meja']; ?></td>

<td>
Rp <?= number_format($d['total'],0,',','.'); ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<?php } ?>
