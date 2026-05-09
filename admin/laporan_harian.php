<?php
include "../koneksi.php";

$data = mysqli_query($conn,"
SELECT DATE(tanggal) as tanggal,
SUM(total) as total
FROM pembayaran
WHERE status='Berhasil'
GROUP BY DATE(tanggal)
ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Harian</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#a97458;
    font-family:Poppins;
}

.box{
    background:white;
    padding:30px;
    border-radius:20px;
    margin-top:40px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
</style>

</head>

<body>

<div class="container">

<div class="box">

<h3 class="mb-4">
    📊 Laporan Harian
</h3>

<table class="table table-bordered">

<tr class="table-dark">
<th>Tanggal</th>
<th>Total</th>
</tr>

<?php while($d = mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= $d['tanggal']; ?>
</td>

<td>
Rp <?= number_format($d['total'],0,',','.'); ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>