<?php
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<style>
/* Background */
body{
    background:#a97458;
    font-family:Poppins;
}

/* Box utama */
.container-box{
    background:white;
    padding:30px;
    margin-top:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* Judul kategori */
.judul-kategori{
    font-weight:600;
    color:#5a3825;
    border-left:6px solid #5a3825;
    padding-left:10px;
}

/* Card produk */
.card{
    border:none;
    border-radius:15px;
    overflow:hidden;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

/* Gambar */
.card img{
    height:200px;
    object-fit:cover;
}

/* Harga */
.harga{
    color:#5a3825;
    font-weight:bold;
}

/* Tombol */
.btn-custom{
    background:#5a3825;
    color:white;
    border:none;
}

.btn-custom:hover{
    background:#3d2518;
}

/* Garis antar kategori */
.garis{
    border-bottom:2px dashed #ddd;
    margin:20px 0;
}
</style>


<div class="container">
<div class="container-box">

<h3 class="mb-4 text-center">☕ Menu Kami</h3>

<?php while($k = mysqli_fetch_assoc($kategori)){ ?>

    <!-- Judul kategori -->
    <h4 class="judul-kategori mt-4 mb-3">
        <?= $k['nama_kategori']; ?>
    </h4>

    <div class="row">

    <?php
    $produk = mysqli_query($conn, "
        SELECT * FROM produk 
        WHERE id_kategori = '".$k['id_kategori']."'
    ");

    while($p = mysqli_fetch_assoc($produk)){
    ?>

        <div class="col-md-3 mb-4">

            <div class="card h-100">

                <img src="gambar/<?= $p['gambar']; ?>">

                <div class="card-body text-center">

                    <h5><?= $p['nama_produk']; ?></h5>

                    <p class="harga">
                        Rp <?= number_format($p['harga'],0,',','.'); ?>
                    </p>

                    <a href="login.php" class="btn btn-custom btn-sm w-100">
                        ☕ Pesan Sekarang
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

    <div class="garis"></div>

<?php } ?>

</div>
</div>