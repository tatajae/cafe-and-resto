<?php

$page = $_GET['page'] ?? 'home';

switch($page){

    case 'home':
        include "dashboard.php";
    break;

    case 'monitor_pesanan':
        include "monitor_pesanan.php";
    break;

    case 'laporan_penjualan':
        include "laporan_penjualan.php";
    break;

    case 'metode_pembayaran':
        include "metode_pembayaran.php";
    break;

    case 'produk_terlaris':
        include "produk_terlaris.php";
    break;

    case 'keuangan':
        include "keuangan.php";
    break;

    case 'export_data':
        include "export_data.php";
    break;

    case 'notifikasi':
        include "notifikasi.php";
    break;

    default:
        include "dashboard.php";
    break;
}
?>