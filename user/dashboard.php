<?php
session_start();
include "../koneksi.php";

if($_SESSION['role'] != "user"){
header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard User</title>
</head>

<body>

<h2>Dashboard User</h2>

<p>Selamat datang <?php echo $_SESSION['username']; ?></p>

<a href="lihat_menu.php">Lihat Menu</a>
<br><br>
<a href="pesanan_saya.php">Pesanan Saya</a>
<br><br>
<a href="../logout.php">Logout</a>

</body>
</html>