<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        include "home.php";
        break;

    case 'menu':
        include "menu_produk.php";
        break;

    case 'keranjang':
        include "keranjang.php";
        break;

    case 'checkout':
        include "checkout.php";
        break;

    case 'pesanan':
        include "pesanan.php";
        break;

    case 'reservasi':
        include "reservasi.php";
        break;

    case 'profil':
        include "profil.php";
        break;

    case 'detail_pesanan':
        include "detail_pesanan.php";
        break;

    default:
        echo "<h4 class='text-center mt-5'>Halaman tidak ditemukan</h4>";
        break;
}
?>