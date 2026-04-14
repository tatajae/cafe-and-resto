<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// kalau user biasa, jangan masuk dashboard
if ($_SESSION['role'] == 'pengguna') {
    header("Location: ../index.php");
    exit;
}

// kalau admin / author → lanjut ke dashboard
include "dashboard.php";
?>