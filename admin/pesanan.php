<?php
include "../koneksi.php";

/*
PASTIKAN SAAT INSERT PESANAN
STATUS DEFAULT = Pending
*/
?>

<div class="container mt-5 mb-5">

    <div class="card border-0 shadow-lg rounded-4 p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            
            <h1 class="fw-bold" style="color:#5C3D2E;">
                📦 Data Pesanan
            </h1>

            <a href="index.php?menu=dashboard" 
               class="btn btn-dark rounded-pill px-4">
                Kembali
            </a>

        </div>

        <!-- TABLE -->
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
                        <th width="350">Aksi</th>
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

                    // STATUS DEFAULT
                    $status = strtolower($d['status']);

                    // JIKA STATUS KOSONG
                    if(empty($status)){
                        $status = 'pending';
                    }
                ?>

                    <tr>

                        <!-- NO -->
                        <td><?= $no++ ?></td>

                        <!-- NAMA -->
                        <td>
                            <b><?= $d['nama_pemesan'] ?></b>
                        </td>

                        <!-- MEJA -->
                        <td><?= $d['meja'] ?></td>

                        <!-- PEMBAYARAN -->
                        <td><?= $d['pembayaran'] ?></td>

                        <!-- TOTAL -->
                        <td>
                            <b class="text-success">
                                Rp <?= number_format($d['total']) ?>
                            </b>
                        </td>

                        <!-- STATUS -->
                        <td>

                            <?php if($status == 'pending'){ ?>

                                <span class="badge bg-warning text-dark p-2">
                                    Pending
                                </span>

                            <?php } elseif($status == 'diproses'){ ?>

                                <span class="badge bg-primary p-2">
                                    Diproses
                                </span>

                            <?php } elseif($status == 'selesai'){ ?>

                                <span class="badge bg-success p-2">
                                    Selesai
                                </span>

                            <?php } elseif($status == 'dibatalkan'){ ?>

                                <span class="badge bg-danger p-2">
                                    Dibatalkan
                                </span>

                            <?php } ?>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <!-- DETAIL -->
                            <a href="index.php?menu=detail_pesanan&id=<?= $d['id_pesanan'] ?>"
                               class="btn btn-info btn-sm rounded-pill">
                                Detail
                            </a>

                            <!-- JIKA STATUS PENDING -->
                            <?php if($status == 'pending'){ ?>

                                <!-- PROSES -->
                                <a href="index.php?menu=konfirmasi_pembayaran&id=<?= $d['id_pesanan'] ?>"
                                   class="btn btn-success btn-sm rounded-pill"
                                   onclick="return confirm('Proses pesanan ini?')">
                                    Proses
                                </a>

                            <?php } ?>

                            <!-- JIKA STATUS DIPROSES -->
                            <?php if($status == 'diproses'){ ?>

                                <!-- SELESAI -->
                                <a href="selesai_pesanan.php?id=<?= $d['id_pesanan'] ?>"
                                   class="btn btn-primary btn-sm rounded-pill"
                                   onclick="return confirm('Selesaikan pesanan ini?')">
                                    Selesai
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