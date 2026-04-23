<?php
include "../koneksi.php";

if($_SESSION['role']!="admin"){
header("location:../login.php");
}

$data = mysqli_query($conn,"SELECT * FROM reservasi");
$total_reservasi = mysqli_num_rows($data);

?>

<!DOCTYPE html>
<html>
<head>

<title>Reservasi Admin</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.container-box{
background:white;
padding:30px;
margin-top:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.stat-card{
background:#5a3825;
color:white;
padding:20px;
border-radius:15px;
text-align:center;
}

</style>

</head>

<body>

<div class="container">

<div class="container-box">

<h3 class="text-center mb-4">Data Reservasi</h3>

<!-- Statistik -->

<div class="row mb-4">

<div class="col-md-4">

<div class="stat-card">

<h2><?php echo $total_reservasi; ?></h2>

<p>Total Reservasi</p>

</div>

</div>

</div>


<table class="table table-bordered">

<tr>

<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah Orang</th>
<th>Pesan</th>
<th>Aksi</th>

</tr>

<?php
$no=1;
while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['email']; ?></td>
<td><?php echo $d['tanggal']; ?></td>
<td><?php echo $d['jam']; ?></td>
<td><?php echo $d['jumlah_orang']; ?></td>
<td><?php echo $d['pesan']; ?></td>

<td>

<a href="hapus_reservasi.php?id=<?php echo $d['id_reservasi']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus reservasi ini?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>