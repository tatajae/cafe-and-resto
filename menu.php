<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page){

    case 'home':
        include "home.php";
        break;

    case 'produk':
        include "produk.php";
        break;

    case 'reservasi':
        include "reservasi.php";
        break;

    default:
        echo "<h4 class='text-center mt-5'>Halaman tidak ditemukan</h4>";
        break;
}