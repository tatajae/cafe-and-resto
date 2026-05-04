<?php
include "../koneksi.php";

$id = $_GET['id'] ?? 0;
$status = $_GET['status'] ?? '';

// validasi
$allowed = ['pending','diproses','selesai','dibatalkan'];

if(!in_array($status, $allowed)){
    die("Status tidak valid!");
}

// cek apakah id ada
$cek = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_pesanan='$id'");
if(mysqli_num_rows($cek) == 0){
    die("ID tidak ditemukan!");
}

// update
$query = mysqli_query($conn, "
UPDATE pesanan 
SET status='$status' 
WHERE id_pesanan='$id'
");

// cek berhasil / tidak
if($query){
    header("Location: index.php?menu=pesanan");
} else {
    echo "Gagal update: " . mysqli_error($conn);
}