<?php
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

if (isset($_POST['nama'])) {

    $nama = $_POST['nama'];
    $meja = $_POST['meja'];
    $pembayaran = $_POST['pembayaran'];

    /* HITUNG TOTAL */
    $keranjang = mysqli_query($conn, "
        SELECT k.*, p.harga
        FROM keranjang k
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user='$id_user'
    ");

    $total = 0;
    while ($k = mysqli_fetch_assoc($keranjang)) {
        $total += $k['harga'] * $k['jumlah'];
    }

    /* STATUS AWAL */
    $status = "belum_bayar";

    /* SIMPAN PESANAN */
    mysqli_query($conn, "
        INSERT INTO pesanan 
        (id_user, nama_pemesan, meja, pembayaran, tanggal, total, status)
        VALUES 
        ('$id_user', '$nama', '$meja', '$pembayaran', NOW(), '$total', '$status')
    ");

    $id_pesanan = mysqli_insert_id($conn);

    /* SIMPAN DETAIL */
    $keranjang2 = mysqli_query($conn, "
        SELECT k.*, p.harga
        FROM keranjang k
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user='$id_user'
    ");

    while ($k = mysqli_fetch_assoc($keranjang2)) {
        mysqli_query($conn, "
            INSERT INTO detail_pesanan 
            (id_pesanan, id_produk, jumlah, harga)
            VALUES 
            ('$id_pesanan', '".$k['id_produk']."', '".$k['jumlah']."', '".$k['harga']."')
        ");
    }

    /* HAPUS KERANJANG */
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_user='$id_user'");

    /* REDIRECT KE HALAMAN PEMBAYARAN (INI YANG BENAR) */
    echo "
    <script>
    alert('Pesanan berhasil dibuat!');
    window.location='dashboard.php?page=pembayaran&id=$id_pesanan';
    </script>
    ";

    exit;
}

/* AMBIL KERANJANG */
$keranjang = mysqli_query($conn, "
    SELECT k.*, p.nama_produk, p.harga
    FROM keranjang k
    JOIN produk p ON k.id_produk = p.id_produk
    WHERE k.id_user='$id_user'
");

$total = 0;
?>

<div class="container-box">

<h4>Checkout</h4>

<?php if(mysqli_num_rows($keranjang) == 0){ ?>

<div class="alert alert-warning">
Keranjang kosong.
</div>

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
<td>Rp <?= number_format($k['harga']); ?></td>
<td><?= $k['jumlah']; ?></td>
<td>Rp <?= number_format($subtotal); ?></td>
</tr>

<?php } ?>

</table>

<h5>Total Bayar : Rp <?= number_format($total); ?></h5>

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

<label>Metode Pembayaran</label>

<select name="pembayaran" class="form-control" required>

<option value="">-- Pilih Pembayaran --</option>

<optgroup label="E-Wallet">
<option value="DANA">DANA</option>
<option value="OVO">OVO</option>
<option value="GoPay">GoPay</option>
</optgroup>

<optgroup label="Transfer Bank">
<option value="BCA">BCA</option>
<option value="BRI">BRI</option>
<option value="BNI">BNI</option>
<option value="Mandiri">Mandiri</option>
</optgroup>

<option value="Cash">Cash</option>

</select>

</div>

<button class="btn btn-success">
Proses Pesanan
</button>

</form>

<?php } ?>

</div>