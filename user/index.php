<?php
session_start();

// cek login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// pastikan role user
if ($_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit;
}

// arahkan ke dashboard utama
header("Location: dashboard.php");
exit;
?>