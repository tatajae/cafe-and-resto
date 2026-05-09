<?php
include "../koneksi.php";

/* CEK LOGIN */
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

/* CEK ID */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID pesanan tidak ditemukan di URL");
}

$id_pesanan = $_GET['id'];

/* AMBIL DATA PESANAN */
$query = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan='$id_pesanan'
");

$pesanan = mysqli_fetch_assoc($query);

/* CEK DATA */
if (!$pesanan) {
    die("Data pesanan tidak ditemukan di database");
}
?>

<div class="container-box">

    <h4>Pembayaran</h4>

    <!-- STATUS DINAMIS -->
    <div class="alert alert-warning">
        Status : <?= $pesanan['status']; ?>
    </div>

    <!-- TOTAL -->
    <h5>Total Pembayaran</h5>
    <h3>Rp <?= number_format($pesanan['total']); ?></h3>

    <hr>

    <!-- METODE -->
    <h5>Metode Pembayaran</h5>
    <b><?= $pesanan['pembayaran']; ?></b>

    <hr>

    <!-- =========================
         CASH PAYMENT
    ========================== -->
    <?php if ($pesanan['pembayaran'] == "Cash") { ?>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Pembayaran Cash (Bayar di Tempat)</h5>
                <p>Silakan lakukan pembayaran langsung di kasir saat mengambil pesanan.</p>

                <div class="alert alert-info mb-0">
                    Status: Menunggu pembayaran di tempat
                </div>
            </div>
        </div>

    <?php } ?>

    <!-- =========================
         E-WALLET
    ========================== -->
    <?php if ($pesanan['pembayaran'] == "DANA") { ?>
        <a href="https://link.dana.id/" target="_blank" class="btn btn-primary mb-3">Buka DANA</a>
    <?php } ?>

    <?php if ($pesanan['pembayaran'] == "OVO") { ?>
        <a href="https://www.ovo.id/" target="_blank" class="btn btn-primary mb-3">Buka OVO</a>
    <?php } ?>

    <?php if ($pesanan['pembayaran'] == "GoPay") { ?>
        <a href="https://gopay.co.id/" target="_blank" class="btn btn-primary mb-3">Buka GoPay</a>
    <?php } ?>

    <hr>

    <!-- =========================
         BANK
    ========================== -->
    <?php if ($pesanan['pembayaran'] == "BCA") { ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5>BCA Virtual Account</h5>
                <p><b>1234567890</b></p>
                <p>a/n Cafe Resto</p>
            </div>
        </div>
    <?php } ?>

    <?php if ($pesanan['pembayaran'] == "BRI") { ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5>BRI Virtual Account</h5>
                <p><b>9876543210</b></p>
                <p>a/n Cafe Resto</p>
            </div>
        </div>
    <?php } ?>

    <?php if ($pesanan['pembayaran'] == "BNI") { ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5>BNI Virtual Account</h5>
                <p><b>1122334455</b></p>
                <p>a/n Cafe Resto</p>
            </div>
        </div>
    <?php } ?>

    <?php if ($pesanan['pembayaran'] == "Mandiri") { ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5>Mandiri Virtual Account</h5>
                <p><b>5566778899</b></p>
                <p>a/n Cafe Resto</p>
            </div>
        </div>
    <?php } ?>

    <!-- =========================
         UPLOAD BUKTI (BUKAN CASH)
    ========================== -->
    <?php if ($pesanan['pembayaran'] != "Cash") { ?>

        <h5>Upload Bukti Pembayaran</h5>

        <form action="upload_pembayaran.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_pesanan" value="<?= $id_pesanan; ?>">

            <div class="mb-3">
                <label>File Bukti</label>
                <input type="file" name="bukti" class="form-control" required>
            </div>

            <button class="btn btn-success">
                Upload & Konfirmasi
            </button>

        </form>

    <?php } else { ?>

        <div class="alert alert-success">
            Pembayaran Cash tidak perlu upload bukti. Silakan bayar langsung di kasir.
        </div>

    <?php } ?>

</div>