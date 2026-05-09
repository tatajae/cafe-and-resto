<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_pesanan = $_POST['id_pesanan'];

/* ======================
   VALIDASI FILE
====================== */

$bukti = $_FILES['bukti']['name'];
$tmp = $_FILES['bukti']['tmp_name'];

$ext = strtolower(pathinfo($bukti, PATHINFO_EXTENSION));

$allowed = ['jpg', 'jpeg', 'png'];

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

move_uploaded_file($tmp, "../bukti/".$nama_baru);

/* ======================
   SIMPAN PEMBAYARAN
====================== */

mysqli_query($conn, "
INSERT INTO pembayaran
(id_pesanan, bukti, status)
VALUES
('$id_pesanan', '$nama_baru', 'menunggu')
");

/* ======================
   UPDATE PESANAN
====================== */

mysqli_query($conn, "
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