<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){

$username=$_POST['username'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$password=$_POST['password'];
$role=$_POST['role'];

mysqli_query($conn,"INSERT INTO users VALUES(NULL,'$username','$nama','$email','$password','$role')");

header("location:index.php?menu=user");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah User</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.form-box{
background:white;
padding:30px;
margin-top:50px;
border-radius:15px;
}

</style>

</head>

<body>

<div class="container">

<div class="form-box">

<h3>Tambah User</h3>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control">
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
<label>Role</label>

<select name="role" class="form-control">

<option>admin</option>
<option>user</option>
<option>pemilik</option>

</select>

</div>

<button name="simpan" class="btn btn-dark">Simpan</button>

<a href="index.php?menu=user" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>

</body>
</html>