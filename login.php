<?php

session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>Login Cafe & Resto</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#a97458;
font-family:Poppins;
}

.login-container{
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.login-card{
background:white;
padding:40px;
border-radius:15px;
width:400px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.logo{
font-size:28px;
font-weight:bold;
text-align:center;
margin-bottom:20px;
}

.btn-coffee{
background:#6b3e2e;
color:white;
}

.btn-coffee:hover{
background:#4e2c20;
color:white;
}

</style>

</head>

<body>

<div class="login-container">

<div class="login-card">

<div class="logo">
☕ Black Coffee
</div>

<h4 class="text-center mb-4">Login Account</h4>
    <?php if(isset($_GET['pesan'])): ?>
        <p class="error"><?php echo $_GET['pesan']; ?></p>
    <?php endif; ?>
<form action="proses_login.php" method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Role</label>

<select name="role" class="form-control" required>

<option value="">Pilih Role</option>
<option value="admin">Admin</option>
<option value="pemilik">Pemilik</option>
<option value="user">User</option>

</select>

</div>

<button type="submit" class="btn btn-coffee w-100">Login</button>

<p class="text-center mt-3">
Belum punya akun? <a href="register.php">Daftar</a>
</p>

</form>

</div>

</div>

</body>
</html>