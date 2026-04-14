<!-- DASHBOARD -->
<div class="container">

    <div class="container-box">

        <h3 class="text-center mb-4">Dashboard Admin</h3>

        <div class="row mb-4">

            <div class="col-md-4">
                <div class="stat-card">
                    <h2><?php echo $total_produk; ?></h2>
                    <p>Total Produk</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <h2><?php echo $total_user; ?></h2>
                    <p>Total User</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <h2><?php echo $total_reservasi; ?></h2>
                    <p>Total Reservasi</p>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- PRODUK -->
<div class="container">

    <div class="container-box">

        <h3 class="text-center mb-4">Daftar Produk</h3>

        <div class="row">

            <?php while($p = mysqli_fetch_assoc($produk)){ ?>

            <div class="col-md-3 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="../gambar/<?php echo $p['gambar']; ?>" class="card-img-top">

                    <div class="card-body text-center">

                        <h5><?php echo $p['nama_produk']; ?></h5>
                        <p><?php echo $p['kategori']; ?></p>

                        <p>
                            <b>Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?></b>
                        </p>

                        <a href="edit_produk.php?id=<?php echo $p['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>

                        <a href="hapus_produk.php?id=<?php echo $p['id_produk']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin mau hapus produk ini?')">
                           Hapus
                        </a>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</div>