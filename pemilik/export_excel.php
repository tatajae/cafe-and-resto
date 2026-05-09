<?php
include "../koneksi.php";

/* =========================
   EXPORT EXCEL KEUANGAN
========================= */

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Keuangan.xls");

/* =========================
   FILTER TANGGAL
========================= */

$awal  = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';

if($awal && $akhir){

    $query = mysqli_query($conn,"
    SELECT * FROM laporan
    WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir'
    ORDER BY tanggal DESC
    ");

}else{

    $query = mysqli_query($conn,"
    SELECT * FROM laporan
    ORDER BY tanggal DESC
    ");
}

/* =========================
   TOTAL PEMASUKAN
========================= */

if($awal && $akhir){

    $total = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(total) as total_pemasukan
    FROM laporan
    WHERE DATE(tanggal) BETWEEN '$awal' AND '$akhir'
    "));

}else{

    $total = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(total) as total_pemasukan
    FROM laporan
    "));
}

?>

<h2>
    Laporan Keuangan Cafe & Resto
</h2>

<p>
    Total Pemasukan :
    <b>
        Rp <?= number_format($total['total_pemasukan'] ?? 0,0,',','.'); ?>
    </b>
</p>

<table border="1" cellpadding="10">

<tr style="background:#5a3825;color:white;">

    <th>No</th>
    <th>ID Pesanan</th>
    <th>Nama Pemesan</th>
    <th>Metode</th>
    <th>Total</th>
    <th>Tanggal</th>

</tr>

<?php
$no = 1;

while($d = mysqli_fetch_assoc($query)){
?>

<tr>

    <td>
        <?= $no++; ?>
    </td>

    <td>
        #<?= $d['id_pesanan']; ?>
    </td>

    <td>
        <?= $d['nama_pemesan']; ?>
    </td>

    <td>
        <?= $d['metode']; ?>
    </td>

    <td>
        Rp <?= number_format($d['total'],0,',','.'); ?>
    </td>

    <td>
        <?= date('d-m-Y H:i', strtotime($d['tanggal'])); ?>
    </td>

</tr>

<?php } ?>

</table>