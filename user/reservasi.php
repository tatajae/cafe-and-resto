<?php
include "../koneksi.php";

$id_user = $_SESSION['id_user'];

if(isset($_POST['tanggal'])){

$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$jumlah = $_POST['jumlah'];

// ✅ VALIDASI DI SINI
if($tanggal < date('Y-m-d')){
    echo "<script>alert('Tanggal tidak boleh di masa lalu!');</script>";
} else {

    mysqli_query($conn, "
    INSERT INTO reservasi (id_user, tanggal, jam, jumlah_orang)
    VALUES ('$id_user','$tanggal','$jam','$jumlah')
    ");

    echo "<script>alert('Reservasi berhasil!');</script>";
}

}
?>

<div class="container-box">

<h4>📅 Reservasi Meja</h4>

<form method="POST">

<div class="row">

<div class="col-md-4 mb-3">
<label>Tanggal</label>
<input type="date" name="tanggal" class="form-control" required>
</div>

<div class="col-md-4 mb-3">
<label>Jam</label>
<input type="time" name="jam" class="form-control" required>
</div>

<div class="col-md-4 mb-3">
<label>Jumlah Orang</label>
<input type="number" name="jumlah" class="form-control" required>
</div>

</div>

<button class="btn btn-primary">Reservasi</button>

</form>

<hr>

<h5>Riwayat Reservasi</h5>

<?php
$data = mysqli_query($conn, "
SELECT * FROM reservasi 
WHERE id_user='$id_user'
ORDER BY id_reservasi DESC
");
?>

<table class="table mt-3">

<tr>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah</th>
<th>Status</th>
</tr>

<?php while($d = mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $d['tanggal']; ?></td>
<td><?= $d['jam']; ?></td>
<td><?= $d['jumlah_orang']; ?> orang</td>
<td>

<?php if($d['status']=="menunggu"){ ?>
<span class="badge bg-warning">Menunggu</span>

<?php } elseif($d['status']=="disetujui"){ ?>
<span class="badge bg-success">Disetujui</span>

<?php } else { ?>
<span class="badge bg-danger">Ditolak</span>
<?php } ?>

</td>
</tr>

<?php } ?>

</table>

</div>