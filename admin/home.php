<div class="container">

    <!-- STATISTIK -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="stat-card">
                <h5>Total Produk</h5>
                <h3><?= $total_produk; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <h5>Total User</h5>
                <h3><?= $total_user; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <h5>Total Reservasi</h5>
                <h3><?= $total_reservasi; ?></h3>
            </div>
        </div>
    </div>

    <!-- PRODUK -->
    <div class="container-box">
        <h4>Daftar Produk</h4>
        <div class="row">

        <?php while($p = mysqli_fetch_assoc($produk)) { ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="../upload/<?= $p['gambar']; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5><?= $p['nama_produk']; ?></h5>
                        <p>Rp <?= number_format($p['harga']); ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
    </div>

    <!-- PESANAN -->
    <div class="container-box">
        <h4>Pesanan Terbaru</h4>

        <table class="table">
            <tr>
                <th>Nama</th>
                <th>Total</th>
                <th>Status</th>
            </tr>

            <?php while($ps = mysqli_fetch_assoc($pesanan)) { ?>
            <tr>
                <td><?= $ps['nama_pemesan']; ?></td>
                <td>Rp <?= number_format($ps['total']); ?></td>
                <td><?= $ps['status']; ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

    <!-- PEMBAYARAN -->
    <div class="container-box">
        <h4>Pembayaran</h4>

        <table class="table">
            <tr>
                <th>Nama</th>
                <th>Bukti</th>
                <th>Status</th>
            </tr>

            <?php while($b = mysqli_fetch_assoc($pembayaran)) { ?>
            <tr>
                <td><?= $b['nama']; ?></td>
                <td>
                    <img src="../bukti/<?= $b['bukti']; ?>" width="80">
                </td>
                <td><?= $b['status']; ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>