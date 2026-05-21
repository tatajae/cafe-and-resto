<?php
include "../koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

/* =========================
   AMBIL DATA
========================= */

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT 
    pesanan.*,
    pembayaran.bukti,
    pembayaran.status as status_pembayaran
FROM pesanan
LEFT JOIN pembayaran
ON pesanan.id_pesanan = pembayaran.id_pesanan
WHERE pesanan.id_pesanan='$id'
"));

if(!$data){

    echo "
    <script>
    alert('Data tidak ditemukan!');
    window.location='index.php?menu=pembayaran';
    </script>
    ";

    exit;
}

/* =========================
   PROSES VERIFIKASI
========================= */

if(isset($_POST['verifikasi'])){

    $metode = $data['pembayaran'];

    /* =========================
       PEMBAYARAN CASH
    ========================= */

    if($metode == "Cash"){

        $uang_bayar = $_POST['uang_bayar'];

        if($uang_bayar < $data['total']){

            echo "
            <script>
            alert('Uang bayar kurang!');
            </script>
            ";

        }else{

            $kembalian = $uang_bayar - $data['total'];

            /* UPDATE STATUS PESANAN */
            mysqli_query($conn,"
            UPDATE pesanan
            SET status='dibayar'
            WHERE id_pesanan='$id'
            ");

            /* INSERT PEMBAYARAN */
            mysqli_query($conn,"
            INSERT INTO pembayaran
            (
                id_pesanan,
                nama,
                total,
                metode,
                uang_bayar,
                kembalian,
                status,
                tanggal
            )
            VALUES
            (
                '$id',
                '".$data['nama_pemesan']."',
                '".$data['total']."',
                'Cash',
                '$uang_bayar',
                '$kembalian',
                'Berhasil',
                NOW()
            )
            ");

            /* INSERT LAPORAN */
            mysqli_query($conn,"
            INSERT INTO laporan
            (
                id_pesanan,
                nama_pemesan,
                metode,
                total,
                uang_bayar,
                kembalian,
                status,
                tanggal
            )
            VALUES
            (
                '$id',
                '".$data['nama_pemesan']."',
                'Cash',
                '".$data['total']."',
                '$uang_bayar',
                '$kembalian',
                'Berhasil',
                NOW()
            )
            ");

            echo "
            <script>
            alert('Pembayaran cash berhasil!');
            window.location='index.php?menu=pesanan';
            </script>
            ";
        }

    }else{

        /* =========================
           TRANSFER / E-WALLET
        ========================= */

        mysqli_query($conn,"
        UPDATE pembayaran
        SET status='Berhasil'
        WHERE id_pesanan='$id'
        ");

        mysqli_query($conn,"
        UPDATE pesanan
        SET status='dibayar'
        WHERE id_pesanan='$id'
        ");

        /* CEK LAPORAN */
        $cek = mysqli_num_rows(mysqli_query($conn,"
        SELECT * FROM laporan
        WHERE id_pesanan='$id'
        "));

        if($cek == 0){

            mysqli_query($conn,"
            INSERT INTO laporan
            (
                id_pesanan,
                nama_pemesan,
                metode,
                total,
                uang_bayar,
                kembalian,
                status,
                tanggal
            )
            VALUES
            (
                '$id',
                '".$data['nama_pemesan']."',
                '".$data['pembayaran']."',
                '".$data['total']."',
                '".$data['total']."',
                '0',
                'Berhasil',
                NOW()
            )
            ");
        }

        echo "
        <script>
        alert('Pembayaran berhasil diverifikasi!');
        window.location='index.php?menu=pesanan';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Konfirmasi Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#a97458;
    font-family:Poppins;
}

.box{
    background:white;
    padding:30px;
    border-radius:20px;
    margin-top:40px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.title{
    color:#5a3825;
    font-weight:bold;
}

.total-box{
    background:#5a3825;
    color:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

.form-control{
    height:50px;
    border-radius:12px;
}

.img-bukti{
    width:100%;
    max-height:400px;
    object-fit:contain;
    border-radius:15px;
    border:2px solid #ddd;
}

</style>

</head>

<body>

<div class="container">

<div class="col-md-6 mx-auto">

<div class="box">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3 class="title">
💵 Konfirmasi Pembayaran
</h3>

<a href="index.php?menu=pembayaran"
   class="btn btn-dark">
Kembali
</a>

</div>

<div class="total-box">

<h5>Total Pembayaran</h5>

<h1>
Rp <?= number_format($data['total'],0,',','.'); ?>
</h1>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label fw-bold">
Nama Pemesan
</label>

<input type="text"
       class="form-control"
       value="<?= $data['nama_pemesan']; ?>"
       readonly>

</div>

<div class="mb-3">

<label class="form-label fw-bold">
Metode Pembayaran
</label>

<input type="text"
       class="form-control"
       value="<?= $data['pembayaran']; ?>"
       readonly>

</div>

<?php if($data['pembayaran'] == "Cash"){ ?>

<div class="mb-3">

<label class="form-label fw-bold">
Uang Bayar
</label>

<input type="number"
       name="uang_bayar"
       class="form-control"
       placeholder="Masukkan uang bayar"
       required>

</div>

<?php } else { ?>

<div class="mb-4">

<label class="form-label fw-bold mb-2">
Bukti Pembayaran
</label>

<br>

<img src="../bukti/<?= $data['bukti']; ?>"
     class="img-bukti">

</div>

<?php } ?>

<button type="submit"
        name="verifikasi"
        class="btn btn-success w-100">

✔ Konfirmasi Pembayaran

</button>

</form>

</div>

</div>

</div>

</body>
</html>