<!-- DASHBOARD -->
<div class="container">
    <div class="container-box">
        <h3>Dashboard</h3>
        <div class="row">
            <div class="col-md-3"><div class="stat-card">Produk<br><b><?= $total_produk ?></b></div></div>
            <div class="col-md-3"><div class="stat-card">User<br><b><?= $total_user ?></b></div></div>
            <div class="col-md-3"><div class="stat-card">Reservasi<br><b><?= $total_reservasi ?></b></div></div>
            <div class="col-md-3"><div class="stat-card">Pesanan<br><b><?= $total_pesanan ?></b></div></div>
        </div>
    </div>

    <!-- PESANAN TERBARU -->
    <div class="container-box">
        <h4>Pesanan Terbaru</h4>
        <table class="table">
            <tr><th>Nama</th><th>Total</th><th>Status</th></tr>
            <?php while($p = mysqli_fetch_assoc($pesanan)){ ?>
            <tr>
                <td><?= $p['nama'] ?></td>
                <td>Rp <?= $p['total'] ?></td>
                <td><?= $p['status'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- PEMBAYARAN TERBARU -->
    <div class="container-box">
        <h4>Pembayaran Terbaru</h4>
        <table class="table">
            <tr><th>User</th><th>Bukti</th><th>Status</th></tr>
            <?php while($b = mysqli_fetch_assoc($pembayaran)){ ?>
            <tr>
                <td><?= $b['user'] ?></td>
                <td><img src="../bukti/<?= $b['bukti'] ?>" width="80"></td>
                <td><?= $b['status'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>