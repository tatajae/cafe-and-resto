<!-- konfirmasi_pembayaran.php -->

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

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM pesanan
WHERE id_pesanan='$id'
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

if(isset($_POST['bayar'])){

    $uang_bayar = $_POST['uang_bayar'];

    $total = $data['total'];

    $kembalian = $uang_bayar - $total;

    if($uang_bayar < $total){

        echo "
        <script>
            alert('Uang bayar kurang!');
        </script>
        ";

    }else{

        mysqli_query($conn,"
        UPDATE pesanan
        SET status='dibayar'
        WHERE id_pesanan='$id'
        ");

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
            '".$data['pembayaran']."',
            '$uang_bayar',
            '$kembalian',
            'Berhasil',
            NOW()
        )
        ");

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

        .btn{
            border-radius:12px;
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
                Uang Bayar
            </label>

            <input type="number"
                   name="uang_bayar"
                   class="form-control"
                   placeholder="Masukkan uang bayar"
                   required>

        </div>

        <button type="submit"
                name="bayar"
                class="btn btn-success w-100">

            ✔ Konfirmasi Pembayaran

        </button>

    </form>

</div>

</div>

</div>

</body>
</html>