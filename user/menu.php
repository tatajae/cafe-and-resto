<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {

    case 'home':
        include "home.php";
        break;

    case 'menu':
        include "menu_produk.php";
        break;

    case 'pesanan':
        include "pesanan.php";
        break;

    default:
        echo "<h4 class='text-center mt-5'>Halaman tidak ditemukan</h4>";
        break;
}
?>