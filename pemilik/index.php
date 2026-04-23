<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] == 'pengguna') {
    header("Location: ../index.php");
    exit;
}

// langsung ke dashboard (layout utama)
include "dashboard.php";
?>