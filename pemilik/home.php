<div class="container-box">

<h3 class="text-center mb-4">Dashboard Pemilik</h3>

<!-- KPI -->
<div class="row mb-4">

<div class="col-md-4">
<div class="stat-card">
<h2><?= $total_produk ?></h2>
<p>Total Produk</p>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h2><?= $total_user ?></h2>
<p>Total User</p>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h2><?= $total_reservasi ?></h2>
<p>Total Reservasi</p>
</div>
</div>

</div>

<!-- GRAFIK -->
<div class="card mb-4">
<div class="card-body">
<h5>Grafik Reservasi</h5>
<canvas id="chart"></canvas>
</div>
</div>

<!-- RESERVASI -->
<h4>Reservasi Terbaru</h4>

<table class="table table-bordered">

<tr>
<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Jumlah</th>
</tr>

<?php $no=1; while($r=mysqli_fetch_assoc($reservasi)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r['nama'] ?></td>
<td><?= $r['email'] ?></td>
<td><?= $r['tanggal'] ?></td>
<td><?= $r['jam'] ?></td>
<td><?= $r['jumlah_orang'] ?></td>
</tr>
<?php } ?>

</table>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'],
        datasets: [{
            label: 'Reservasi',
            data: [12,19,3,5,2,10,8]
        }]
    }
});
</script>