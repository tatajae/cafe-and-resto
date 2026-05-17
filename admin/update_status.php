<?php
include "../koneksi.php";

$id = $_GET['id'];

/* AMBIL STATUS */
$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT status
FROM pesanan
WHERE id_pesanan='$id'
"));

$status = strtolower(trim($data['status'] ?? 'pending'));

/* LOGIKA STATUS */
if($status == 'dibayar'){

    $update = 'diproses';

}
elseif($status == 'diproses'){

    $update = 'selesai';

}
else{

    $update = $status;

}

/* UPDATE */
mysqli_query($conn,"
UPDATE pesanan
SET status='$update'
WHERE id_pesanan='$id'
");

/* KEMBALI */
header("Location: index.php?menu=pesanan");
exit;
?>