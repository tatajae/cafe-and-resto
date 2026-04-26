<?php
include "../koneksi.php";

$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran ORDER BY id DESC");
?>

<div class="container-box">
    <h4>Data Pembayaran</h4>

    <table class="table table-bordered">
        <tr style="background:#5a3825;color:white;">
            <th>No</th>
            <th>Nama</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $no = 1;
        while($b = mysqli_fetch_assoc($pembayaran)) { 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $b['nama']; ?></td>

            <td>
                <img src="../bukti/<?= $b['bukti']; ?>" width="80">
            </td>

            <td>
                <?php
                if($b['status'] == 'menunggu'){
                    echo "<span class='badge bg-warning'>Menunggu</span>";
                } elseif($b['status'] == 'diterima'){
                    echo "<span class='badge bg-success'>Diterima</span>";
                } elseif($b['status'] == 'ditolak'){
                    echo "<span class='badge bg-danger'>Ditolak</span>";
                } else {
                    echo $b['status'];
                }
                ?>
            </td>

            <td>
                <a href="update_pembayaran.php?id=<?= $b['id']; ?>&status=diterima" class="btn btn-sm btn-success">Terima</a>
                <a href="update_pembayaran.php?id=<?= $b['id']; ?>&status=ditolak" class="btn btn-sm btn-danger">Tolak</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>