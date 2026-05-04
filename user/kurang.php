<?php
session_start();
include "../koneksi.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'];

/* cek dulu jumlah */
$data = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT jumlah FROM keranjang 
WHERE id_keranjang='$id' AND id_user='$id_user'
"));

if($data['jumlah'] > 1){

    mysqli_query($conn, "
    UPDATE keranjang 
    SET jumlah = jumlah - 1 
    WHERE id_keranjang='$id' AND id_user='$id_user'
    ");

} else {

    /* kalau 1 → hapus */
    mysqli_query($conn, "
    DELETE FROM keranjang 
    WHERE id_keranjang='$id' AND id_user='$id_user'
    ");
}

header("Location: dashboard.php?page=keranjang");
exit;
?>