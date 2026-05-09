<?php   
include "../koneksi.php";

/* =========================
   LOGIN ADMIN
========================= */
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

/* =========================
   AMBIL ID PESANAN
========================= */
$id = $_GET['id'];

/* =========================
   AMBIL DATA PESANAN
========================= */
$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM pesanan
WHERE id_pesanan='$id'
"));

/* =========================
   JIKA DATA TIDAK ADA
========================= */
if(!$data){

    echo "
    <script>
        alert('Data pesanan tidak ditemukan!');
        window.location='index.php?menu=verifikasi';
    </script>
    ";

    exit;
}

/* =========================
   PROSES PEMBAYARAN
========================= */
if(isset($_POST['bayar'])){

    $uang_bayar = $_POST['uang_bayar'];

    $total = $data['total'];

    /* HITUNG KEMBALIAN */
    $kembalian = $uang_bayar - $total;

    /* VALIDASI */
    if($uang_bayar < $total){

        echo "
        <script>
            alert('Uang bayar kurang!');
        </script>
        ";

    }else{

        /* =========================
           UPDATE STATUS PESANAN
        ========================= */
        mysqli_query($conn,"
        UPDATE pesanan
        SET status='Diproses'
        WHERE id_pesanan='$id'
        ");

        /* =========================
           SIMPAN PEMBAYARAN
        ========================= */
        mysqli_query($conn,"
        INSERT INTO pembayaran
        (
            id_pesanan,
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
            '$total',
            'Cash',
            '$uang_bayar',
            '$kembalian',
            'Berhasil',
            NOW()
        )
        ");

        /* =========================
           SIMPAN KE LAPORAN
        ========================= */
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
            '$total',
            '$uang_bayar',
            '$kembalian',
            'Berhasil',
            NOW()
        )
        ");

        /* =========================
           REDIRECT STRUK
        ========================= */
        echo "
        <script>
            alert('Pembayaran berhasil!');
            window.location='index.php?menu=struk_cash&id=$id';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Konfirmasi Pembayaran Cash</title>

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

.info-box{
    background:#f8f9fa;
    padding:15px;
    border-radius:15px;
    margin-bottom:20px;
    font-size:14px;
}

.form-control{
    height:50px;
    border-radius:12px;
    font-size:14px;
}

.btn{
    border-radius:12px;
    padding:10px 20px;
    font-size:14px;
}

.badge-status{
    background:#ffc107;
    color:black;
    padding:8px 12px;
    border-radius:10px;
    font-size:12px;
}

</style>

</head>

<body>

<div class="container">

<div class="col-md-6 mx-auto">

<div class="box">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="title">
            💵 Pembayaran Cash
        </h3>

        <a href="index.php?menu=verifikasi"
           class="btn btn-dark">
            Kembali
        </a>

    </div>

    <!-- TOTAL -->
    <div class="total-box">

        <h5>Total Pembayaran</h5>

        <h1>
            Rp <?= number_format($data['total'],0,',','.'); ?>
        </h1>

    </div>

    <!-- INFO -->
    <div class="info-box">

        <div class="mb-2">
            <b>Nama Pemesan :</b>
            <?= $data['nama_pemesan']; ?>
        </div>

        <div class="mb-2">
            <b>No Meja :</b>
            <?= $data['meja']; ?>
        </div>

        <div>
            <b>Status :</b>

            <span class="badge-status">
                Pending
            </span>
        </div>

    </div>

    <!-- FORM -->
    <form method="POST">

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Uang Bayar
            </label>

            <input type="number"
                   name="uang_bayar"
                   class="form-control"
                   placeholder="Masukkan uang pembayaran"
                   required>

        </div>

        <div class="d-flex gap-2">

            <button type="submit"
                    name="bayar"
                    class="btn btn-success w-100">
                Konfirmasi Pembayaran
            </button>

            <a href="index.php?menu=verifikasi"
               class="btn btn-secondary w-100">
                Batal
            </a>

        </div>

    </form>

</div>

</div>

</div>

</body>
</html>