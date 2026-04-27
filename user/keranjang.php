<?php
$id = $_SESSION['id_user'];

$data = mysqli_query($conn, "
SELECT k.*, p.nama_produk, p.harga, p.gambar 
FROM keranjang k
JOIN produk p ON k.id_produk = p.id_produk
WHERE k.id_user='$id'
");
?>

<div class="container-box">

<h4>🛒 Keranjang Saya</h4>

<table class="table">

<tr>
<th>Produk</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
<th>Aksi</th>
</tr>

<?php 
$total = 0;
while($d = mysqli_fetch_assoc($data)){

$subtotal = $d['harga'] * $d['jumlah'];
$total += $subtotal;
?>

<tr>
<td><?= $d['nama_produk']; ?></td>
<td>Rp <?= number_format($d['harga']); ?></td>
<td><?= $d['jumlah']; ?></td>
<td>Rp <?= number_format($subtotal); ?></td>
<td>
<a href="hapus_keranjang.php?id=<?= $d['id_keranjang']; ?>" 
class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>

<?php } ?>

</table>

<h5>Total: Rp <?= number_format($total); ?></h5>

<a href="dashboard.php?page=checkout" class="btn btn-success">
Checkout
</a>

</div>