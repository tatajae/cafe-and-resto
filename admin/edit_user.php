<?php
include "../koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($conn,"SELECT * FROM users WHERE id_user='$id'");
$d=mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit User</title>

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

<h3>Edit User</h3>

<form action="update_user.php" method="POST">

<input type="hidden" name="id" value="<?php echo $d['id_user']; ?>">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>">
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?php echo $d['nama']; ?>">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" value="<?php echo $d['email']; ?>">
</div>

<div class="mb-3">
<label>Password</label>
<input type="text" name="password" class="form-control" value="<?php echo $d['password']; ?>">
</div>

<div class="mb-3">
<label>Role</label>

<select name="role" class="form-control">

<option <?php if($d['role']=="admin") echo "selected"; ?>>admin</option>
<option <?php if($d['role']=="user") echo "selected"; ?>>user</option>
<option <?php if($d['role']=="pemilik") echo "selected"; ?>>pemilik</option>

</select>

</div>

<button class="btn btn-dark">Update</button>

<a href="index.php?menu=user" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>

</body>
</html>