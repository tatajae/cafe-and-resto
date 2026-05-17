<!-- DASHBOARD -->
<div class="container">

    <!-- STATISTIK -->
    <div class="container-box">
        <h3>Dashboard</h3>

        <div class="row">

            <div class="col-md-3">
                <div class="stat-card">
                    Produk <br>
                    <b><?= $total_produk ?></b>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    User <br>
                    <b><?= $total_user ?></b>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    Reservasi <br>
                    <b><?= $total_reservasi ?></b>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    Pesanan <br>
                    <b><?= $total_pesanan ?></b>
                </div>
            </div>

        </div>
    </div>

    <!-- 💰 TAMBAHAN: RINGKASAN KEUANGAN (INI YANG KAMU KURANG) -->
    <div class="container-box">
        <h4>Ringkasan Keuangan</h4>

        <div class="row">

            <div class="col-md-4">
                <div class="stat-card">
                    Total Pemasukan <br>
                    <b>Rp <?= number_format($total_pemasukan['total']); ?></b>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    Cash <br>
                    <b>
                        Rp <?= number_format(mysqli_fetch_assoc(mysqli_query($conn,"
                        SELECT SUM(total) AS total FROM pesanan 
                        WHERE pembayaran='Cash' AND status='lunas'
                        "))['total']); ?>
                    </b>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    E-Wallet <br>
                    <b>
                        Rp <?= number_format(mysqli_fetch_assoc(mysqli_query($conn,"
                        SELECT SUM(total) AS total FROM pesanan 
                        WHERE pembayaran IN ('DANA','OVO','GoPay') AND status='lunas'
                        "))['total']); ?>
                    </b>
                </div>
            </div>

        </div>

    </div>

    <!-- 📦 PESANAN TERBARU -->
    <div class="container-box">
        <h4>Pesanan Terbaru</h4>

        <table class="table table-striped">
            <tr>
                <th>Nama</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>

            <?php while($p = mysqli_fetch_assoc($pesanan)){ ?>
            <tr>
                <td><?= $p['nama_pemesan'] ?></td>
                <td>Rp <?= number_format($p['total']) ?></td>
                <td><?= $p['pembayaran'] ?></td>
                <td><?= $p['status'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- 💳 PEMBAYARAN TERBARU -->
    <div class="container-box">
        <h4>Pembayaran Terbaru</h4>

        <table class="table table-striped">
            <tr>
                <th>User</th>
                <th>Bukti</th>
                <th>Status</th>
            </tr>

            <?php while($b = mysqli_fetch_assoc($pembayaran)){ ?>
            <tr>
                <td><?= $b['nama'] ?></td>
                <td>
                    <img src="bukti/<?= $b['bukti'] ?>" width="80">
                </td>
                <td><?= $b['status'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>