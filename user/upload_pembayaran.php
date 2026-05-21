<?php
session_start();
include "../koneksi.php";

/* ======================
   CEK LOGIN USER
====================== */

if (!isset($_SESSION['id_user'])) {

    header("Location: ../login.php");
    exit;
}

/* ======================
   AMBIL ID PESANAN
====================== */

$id_pesanan = $_POST['id_pesanan'];

/* ======================
   AMBIL DATA PESANAN
====================== */

$pesanan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM pesanan
WHERE id_pesanan='$id_pesanan'
"));

if(!$pesanan){

    echo "
    <script>
    alert('Pesanan tidak ditemukan');
    window.history.back();
    </script>
    ";

    exit;
}

/* ======================
   DATA PESANAN
====================== */

$nama   = $pesanan['nama_pemesan'];
$metode = $pesanan['pembayaran'];
$total  = $pesanan['total'];

/* ======================
   VALIDASI FILE
====================== */

$bukti = $_FILES['bukti']['name'];
$tmp   = $_FILES['bukti']['tmp_name'];

$ext = strtolower(pathinfo($bukti, PATHINFO_EXTENSION));

$allowed = ['jpg','jpeg','png'];

if(!in_array($ext, $allowed)){

    echo "
    <script>
    alert('Format file harus JPG, JPEG, atau PNG');
    window.history.back();
    </script>
    ";

    exit;
}

/* ======================
   UPLOAD FILE
====================== */

$nama_baru = time().'_'.$bukti;

move_uploaded_file(
    $tmp,
    "../bukti/".$nama_baru
);

/* ======================
   SIMPAN PEMBAYARAN
====================== */

mysqli_query($conn,"
INSERT INTO pembayaran
(
    id_pesanan,
    metode,
    total,
    nama,
    bukti,
    status
)
VALUES
(
    '$id_pesanan',
    '$metode',
    '$total',
    '$nama',
    '$nama_baru',
    'menunggu'
)
");

/* ======================
   UPDATE STATUS PESANAN
====================== */

mysqli_query($conn,"
UPDATE pesanan
SET status='menunggu_verifikasi'
WHERE id_pesanan='$id_pesanan'
");

/* ======================
   REDIRECT
====================== */

echo "
<script>
alert('Bukti pembayaran berhasil diupload');
window.location='dashboard.php?page=pesanan';
</script>
";
?>