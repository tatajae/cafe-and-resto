<?php
include "../koneksi.php";

$query = mysqli_query($conn,"
SELECT DATE(tanggal_bayar) as tgl, SUM(total) as total
FROM pesanan
WHERE status='lunas'
GROUP BY DATE(tanggal_bayar)
ORDER BY tgl ASC
");

$tanggal = [];
$total = [];

while($row = mysqli_fetch_assoc($query)){
    $tanggal[] = $row['tgl'];
    $total[] = $row['total'];
}

echo json_encode([
    "tanggal" => $tanggal,
    "total" => $total
]);
?>