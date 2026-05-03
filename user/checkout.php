<?php
include "../koneksi.php";

/* DEBUG (hapus kalau sudah normal) */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* CEK LOGIN */
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

/* =====================
   PROSES CHECKOUT
===================== */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = $_POST['nama'];
    $meja = $_POST['meja'];
    $pembayaran = $_POST['pembayaran'];

    // ambil keranjang
    $keranjang = mysqli_query($conn, "
        SELECT k.*, p.harga
        FROM keranjang k
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user='$id_user'
    ") or die(mysqli_error($conn));

    $total = 0;

    while ($k = mysqli_fetch_assoc($keranjang)) {
        $total += $k['harga'] * $k['jumlah'];
    }

    // validasi keranjang
    if ($total == 0) {
        echo "<script>alert('Keranjang kosong!'); window.location='dashboard.php?page=menu';</script>";
        exit;
    }

    // ✅ FIX KOLOM (nama_pemesan)
    mysqli_query($conn, "
        INSERT INTO pesanan (id_user, nama_pemesan, meja, pembayaran, tanggal, total, status)
        VALUES ('$id_user','$nama','$meja','$pembayaran',NOW(),'$total','pending')
    ") or die(mysqli_error($conn));

    $id_pesanan = mysqli_insert_id($conn);

    // ambil ulang keranjang
    $keranjang2 = mysqli_query($conn, "
        SELECT k.*, p.harga
        FROM keranjang k
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user='$id_user'
    ");

    // simpan detail
    while ($k = mysqli_fetch_assoc($keranjang2)) {

        mysqli_query($conn, "
            INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, harga)
            VALUES ('$id_pesanan','".$k['id_produk']."','".$k['jumlah']."','".$k['harga']."')
        ") or die(mysqli_error($conn));
    }

    // kosongkan keranjang
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_user='$id_user'");

    echo "<script>
        alert('Pesanan berhasil!');
        window.location='dashboard.php?page=pesanan';
    </script>";
    exit;
}


/* =====================
   TAMPILKAN KERANJANG
===================== */
$keranjang = mysqli_query($conn, "
    SELECT k.*, p.nama_produk, p.harga
    FROM keranjang k
    JOIN produk p ON k.id_produk = p.id_produk
    WHERE k.id_user='$id_user'
");

$total = 0;
?>

<div class="container-box">

<h4>💳 Checkout</h4>

<?php if(mysqli_num_rows($keranjang) == 0){ ?>

<p>Keranjang kosong.</p>
<a href="dashboard.php?page=menu" class="btn btn-dark">Pilih Menu</a>

<?php } else { ?>

<table class="table table-bordered">

<tr>
<th>Produk</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
</tr>

<?php while($k = mysqli_fetch_assoc($keranjang)){ 
$subtotal = $k['harga'] * $k['jumlah'];
$total += $subtotal;
?>

<tr>
<td><?= $k['nama_produk']; ?></td>
<td>Rp <?= number_format($k['harga'],0,',','.'); ?></td>
<td><?= $k['jumlah']; ?></td>
<td>Rp <?= number_format($subtotal,0,',','.'); ?></td>
</tr>

<?php } ?>

</table>

<h5>Total Bayar: Rp <?= number_format($total,0,',','.'); ?></h5>

<hr>

<form method="POST">

<div class="mb-3">
<label>Nama Pemesan</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Nomor Meja</label>
<input type="text" name="meja" class="form-control" required>
</div>

<div class="mb-3">
<label>Pembayaran</label>
<select name="pembayaran" class="form-control">
<option>Transfer Bank</option>
<option>OVO</option>
<option>Dana</option>
<option>Cash</option>
</select>
</div>

<button class="btn btn-success">Proses Pesanan</button>

</form>

<?php } ?>

</div>