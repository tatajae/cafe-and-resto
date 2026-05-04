<?php
session_start();
include "../koneksi.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'];

/* tambah jumlah */
mysqli_query($conn, "
UPDATE keranjang 
SET jumlah = jumlah + 1 
WHERE id_keranjang='$id' AND id_user='$id_user'
");

header("Location: dashboard.php?page=keranjang");
exit;
?>