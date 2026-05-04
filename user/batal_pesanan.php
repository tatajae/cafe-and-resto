<?php
session_start();
include "../koneksi.php";

$id_user = $_SESSION['id_user'];
$id = $_GET['id'] ?? 0;

/* validasi keamanan */
$cek = mysqli_query($conn, "
SELECT * FROM pesanan 
WHERE id_pesanan='$id' 
AND id_user='$id_user' 
AND status='pending'
");

if(mysqli_num_rows($cek) > 0){

    mysqli_query($conn, "
    UPDATE pesanan 
    SET status='dibatalkan'
    WHERE id_pesanan='$id'
    ");

    echo "<script>
    alert('Pesanan berhasil dibatalkan');
    window.location='dashboard.php?page=pesanan';
    </script>";

} else {

    echo "<script>
    alert('Pesanan tidak bisa dibatalkan');
    window.location='dashboard.php?page=pesanan';
    </script>";

}
?>