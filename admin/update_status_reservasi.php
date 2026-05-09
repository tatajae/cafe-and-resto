<?php
session_start();
include "../koneksi.php";

/* AMBIL DATA */
$id = $_GET['id'];
$status = $_GET['status'];

/* UPDATE STATUS */
$query = mysqli_query($conn, "
    UPDATE reservasi 
    SET status='$status'
    WHERE id_reservasi='$id'
");

/* NOTIF */
if($query){

    if($status == "disetujui"){
        $_SESSION['notif'] = "Reservasi berhasil disetujui";
    }

    elseif($status == "ditolak"){
        $_SESSION['notif'] = "Reservasi berhasil ditolak";
    }

    elseif($status == "dibatalkan"){
        $_SESSION['notif'] = "Reservasi berhasil dibatalkan";
    }

}else{

    $_SESSION['notif'] = "Gagal update status";

}

/* KEMBALI */
header("Location: index.php?menu=reservasi");
exit;
?>