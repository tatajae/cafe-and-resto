<?php
include "../koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>

<title>Data User</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.navbar{
background:#5a3825;
}

.nav-link{
color:white !important;
}

.container-box{
background:white;
padding:30px;
margin-top:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

</style>

</head>

<body>
<div class="container">

<div class="container-box">

<h3>Data User</h3>

<a href="index.php?menu=tambah_user" class="btn btn-dark mb-3">Tambah User</a>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Username</th>
<th>Email</th>
<th>Role</th>
<th>Aksi</th>

</tr>

<?php
$no=1;
while($d=mysqli_fetch_array($data)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['username']; ?></td>
<td><?php echo $d['email']; ?></td>
<td><?php echo $d['role']; ?></td>

<td>

<a href="index.php?menu=edit_user&id=<?php echo $d['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="index.php?menu=hapus_userid=<?php echo $d['id_user']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus user?')">Hapus</a>

</td>

</tr>

<?php } ?>

</table>
    <button onclick =history.back() class="btn btn-secondary md 3">← Kembali</button>
</div>

</div>

</body>
</html>