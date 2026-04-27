<?php
session_start();
include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id'");

header("Location: dashboard.php?page=keranjang");
exit;
?>