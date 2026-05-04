<?php
include "../koneksi.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'] ?? 0;

/* AMBIL PESANAN */
$p = mysqli_query($conn, "
SELECT * FROM pesanan 
WHERE id_pesanan='$id' AND id_user='$id_user'
");

if(mysqli_num_rows($p) == 0){
    echo "<script>
    alert('Data tidak ditemukan');
    window.location='dashboard.php?page=pesanan';
    </script>";
    exit;
}

$p = mysqli_fetch_assoc($p);

/* DETAIL PESANAN */
$detail = mysqli_query($conn, "
SELECT d.*, p.nama_produk
FROM detail_pesanan d
JOIN produk p ON d.id_produk = p.id_produk
WHERE d.id_pesanan='$id'
");
?>

<div class="container-box">

<h4>📦 Detail Pesanan</h4>

<p><b>Nama:</b> <?= $p['nama_pemesan']; ?></p>
<p><b>Meja:</b> <?= $p['meja']; ?></p>
<p><b>Tanggal:</b> <?= date('d-m-Y H:i', strtotime($p['tanggal'])); ?></p>
<p><b>Pembayaran:</b> <?= $p['pembayaran']; ?></p>

<p>
<b>Status:</b>

<?php if($p['status']=="pending"){ ?>
<span class="badge bg-warning text-dark">Pending</span>

<?php } elseif($p['status']=="diproses"){ ?>
<span class="badge bg-primary">Diproses</span>

<?php } elseif($p['status']=="selesai"){ ?>
<span class="badge bg-success">Selesai</span>

<?php } elseif($p['status']=="dibatalkan"){ ?>
<span class="badge bg-danger">Dibatalkan</span>
<?php } ?>

</p>

<hr>

<table class="table table-bordered text-center">

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

<h5 class="text-end">
Total: Rp <?= number_format($total,0,',','.'); ?>
</h5>

<hr>

<!-- ========================= -->
<!-- ACTION BUTTONS -->
<!-- ========================= -->

<?php if($p['status']=="pending"){ ?>

<a href="batal_pesanan.php?id=<?= $p['id_pesanan']; ?>" 
class="btn btn-danger"
onclick="return confirm('Yakin mau batalkan pesanan ini?')">
❌ Batalkan Pesanan
</a>

<?php } ?>

<!-- STRUK BUTTON (SEMUANYA BISA) -->
<a href="struk.php?id=<?= $p['id_pesanan']; ?>" target="_blank" class="btn btn-dark">
🧾 Cetak Struk
</a>

<br><br>

<a href="dashboard.php?page=pesanan" class="btn btn-secondary">
⬅ Kembali
</a>

</div>