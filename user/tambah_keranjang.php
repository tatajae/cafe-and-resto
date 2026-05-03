<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_produk = $_GET['id_produk'] ?? 0;

// validasi
if($id_produk == 0){
    die("ID produk tidak ditemukan!");
}

// cek
$cek = mysqli_query($conn, "SELECT * FROM keranjang 
                           WHERE id_user='$id_user' AND id_produk='$id_produk'");

if(mysqli_num_rows($cek) > 0){

    mysqli_query($conn, "UPDATE keranjang 
                         SET jumlah = jumlah + 1 
                         WHERE id_user='$id_user' AND id_produk='$id_produk'")
                         or die(mysqli_error($conn));

} else {

    mysqli_query($conn, "INSERT INTO keranjang (id_user, id_produk, jumlah)
                         VALUES ('$id_user','$id_produk',1)")
                         or die(mysqli_error($conn));
}

header("Location: dashboard.php?page=keranjang");
exit;
?>