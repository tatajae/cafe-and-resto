<?php
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$pesanan = mysqli_query($conn, "
SELECT * FROM pesanan
WHERE id_user='$id_user'
ORDER BY id_pesanan DESC
");
?>

<div class="container-box">

    <h4 class="mb-4">Pesanan Saya</h4>

    <?php if(mysqli_num_rows($pesanan) == 0){ ?>

        <div class="alert alert-warning">
            Belum ada pesanan.
        </div>

    <?php } else { ?>

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th width="230">Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php 
            $no = 1;

            while($p = mysqli_fetch_assoc($pesanan)){

                // ambil status dari database
                $status = strtolower(trim($p['status'] ?? 'pending'));
            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td>
                    <?= date('d-m-Y H:i', strtotime($p['tanggal'])); ?>
                </td>

                <td>
                    <b>
                        Rp <?= number_format($p['total']); ?>
                    </b>
                </td>

                <td>
                    <?= $p['pembayaran']; ?>
                </td>

                <!-- STATUS -->
                <td>

                    <?php
                    if($status == 'pending'){
                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                    }
                    elseif($status == 'diproses'){
                        echo '<span class="badge bg-info text-dark">Diproses</span>';
                    }
                    elseif($status == 'selesai'){
                        echo '<span class="badge bg-success">Selesai</span>';
                    }
                    elseif($status == 'dibatalkan'){
                        echo '<span class="badge bg-danger">Dibatalkan</span>';
                    }
                    else{
                        echo '<span class="badge bg-secondary">Pending</span>';
                    }
                    ?>

                </td>

                <!-- KETERANGAN -->
                <td>

                    <?php
                    if($status == "pending"){
                        echo "Menunggu konfirmasi admin";
                    }
                    elseif($status == "diproses"){
                        echo "Pesanan sedang diproses";
                    }
                    elseif($status == "selesai"){
                        echo "Pesanan selesai";
                    }
                    elseif($status == "dibatalkan"){
                        echo "Pesanan dibatalkan";
                    }
                    else{
                        echo "Menunggu konfirmasi admin";
                    }
                    ?>

                </td>

                <!-- AKSI -->
                <td>

                    <!-- DETAIL -->
                    <a href="dashboard.php?page=detail_pesanan&id=<?= $p['id_pesanan']; ?>"
                       class="btn btn-sm btn-primary">
                        Detail
                    </a>

                    <!-- BAYAR -->
                    <?php if($status == 'pending'){ ?>

                        <a href="dashboard.php?page=pembayaran&id=<?= $p['id_pesanan']; ?>"
                           class="btn btn-sm btn-success">
                            Bayar
                        </a>

                    <?php } ?>

                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

    <?php } ?>

</div>