 <!-- pesanan.php -->

<?php
include "../koneksi.php";
?>

<div class="container mt-5 mb-5">

    <div class="card border-0 shadow-lg rounded-4 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="fw-bold" style="color:#5C3D2E;">
                📦 Data Pesanan
            </h1>

            <a href="index.php?menu=dashboard"
               class="btn btn-dark rounded-pill px-4">
                Kembali
            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle text-center">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>No Meja</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th width="400">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;

                $query = mysqli_query($conn,"
                SELECT * FROM pesanan
                ORDER BY id_pesanan DESC
                ");

                while($d = mysqli_fetch_array($query)){

                    $status = strtolower(trim($d['status']));
                ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td>
                        <b><?= $d['nama_pemesan'] ?></b>
                    </td>

                    <td><?= $d['meja'] ?></td>

                    <td><?= $d['pembayaran'] ?></td>

                    <td>

                        <b class="text-success">
                            Rp <?= number_format($d['total'],0,',','.') ?>
                        </b>

                    </td>

                    <td>

                        <?php if($status == 'pending'){ ?>

                            <span class="badge bg-warning text-dark p-2">
                                Pending
                            </span>

                        <?php } ?>

                        <?php if($status == 'dibayar'){ ?>

                            <span class="badge bg-success p-2">
                                Dibayar
                            </span>

                        <?php } ?>

                        <?php if($status == 'diproses'){ ?>

                            <span class="badge bg-primary p-2">
                                Diproses
                            </span>

                        <?php } ?>

                        <?php if($status == 'selesai'){ ?>

                            <span class="badge bg-dark p-2">
                                Selesai
                            </span>

                        <?php } ?>

                    </td>

                    <td>

                        <a href="index.php?menu=detail_pesanan&id=<?= $d['id_pesanan'] ?>"
                           class="btn btn-info btn-sm rounded-pill">

                            Detail

                        </a>

                        <?php if($status == 'dibayar'){ ?>

                            <a href="update_status.php?id=<?= $d['id_pesanan'] ?>"
                               class="btn btn-primary btn-sm rounded-pill"
                               onclick="return confirm('Proses pesanan ini?')">

                                🍳 Proses

                            </a>

                        <?php } ?>

                        <?php if($status == 'diproses'){ ?>

                            <a href="index.php?menu=struk_print&id=<?= $d['id_pesanan'] ?>"
                               target="_blank"
                               class="btn btn-dark btn-sm rounded-pill">

                                🧾 Struk

                            </a>

                            <a href="update_status.php?id=<?= $d['id_pesanan'] ?>"
                               class="btn btn-success btn-sm rounded-pill"
                               onclick="return confirm('Pesanan sudah selesai diantar?')">

                                ✔ Selesai

                            </a>

                        <?php } ?>

                    </td>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>