<?php
session_start();
include "../koneksi.php";

// cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_produk = $_GET['id'] ?? 0;

// cek produk sudah ada di keranjang atau belum
$cek = mysqli_query($conn, "SELECT * FROM keranjang 
                           WHERE id_user='$id_user' AND id_produk='$id_produk'");

if(mysqli_num_rows($cek) > 0){

    // kalau sudah ada → tambah jumlah
    mysqli_query($conn, "UPDATE keranjang 
                         SET jumlah = jumlah + 1 
                         WHERE id_user='$id_user' AND id_produk='$id_produk'");

} else {

    // kalau belum → insert baru
    mysqli_query($conn, "INSERT INTO keranjang (id_user, id_produk, jumlah)
                         VALUES ('$id_user','$id_produk',1)");
}

// balik ke menu
header("Location: dashboard.php?page=keranjang");
exit;
?>