<?php
include "../koneksi.php";

/* FILTER TANGGAL */
$awal  = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';

if ($awal && $akhir) {
    $query = "SELECT * FROM reservasi 
              WHERE tanggal BETWEEN '$awal' AND '$akhir'
              ORDER BY tanggal DESC";
} else {
    $query = "SELECT * FROM reservasi ORDER BY tanggal DESC";
}

$data = mysqli_query($conn, $query);

/* HITUNG TOTAL */
$total_data = mysqli_num_rows($data);
?>

<div class="container-box">

<h3 class="mb-4 text-center">Laporan Reservasi</h3>

<!-- FILTER -->
<form method="GET" class="row mb-4">

<input type="hidden" name="page" value="laporan">

<div class="col-md-4">
<label>Tanggal Awal</label>
<input type="date" name="awal" class="form-control" value="<?= $awal ?>">
</div>

<div class="col-md-4">
<label>Tanggal Akhir</label>
<input type="date" name="akhir" class="form-control" value="<?= $akhir ?>">
</div>

<div class="col-md-4 d-flex align-items-end">
<button class="btn btn-dark w-100">Filter</button>
</div>

<a href="export_excel.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" 
   class="btn btn-success mb-3">
   ⬇ Export Excel
</a>

</form>

<!-- INFO -->
<div class="mb-3">
<b>Total Data: <?= $total_data ?></b>
</div>

<!-- TABEL -->
<table class="table table-bordered table-striped">

<tr>
<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah Orang</th>
</tr>

<?php $no = 1; while($r = mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r['nama'] ?></td>
<td><?= $r['email'] ?></td>
<td><?= $r['tanggal'] ?></td>
<td><?= $r['jam'] ?></td>
<td><?= $r['jumlah_orang'] ?></td>
</tr>
<?php } ?>

</table>

</div>