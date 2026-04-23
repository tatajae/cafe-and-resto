<?php
include "../koneksi.php";

/* Header supaya jadi file Excel */
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Reservasi.xls");

/* Ambil filter */
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
?>

<h3>Laporan Reservasi</h3>

<table border="1">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Jumlah Orang</th>
</tr>

<?php 
$no = 1;
while($r = mysqli_fetch_assoc($data)){
?>
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