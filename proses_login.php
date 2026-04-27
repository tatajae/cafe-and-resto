<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

$query = mysqli_query($conn, "SELECT * FROM users 
                             WHERE username='$username' 
                             AND password='$password' 
                             AND role='$role'");

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user']; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    if ($role == 'admin') {
        header("Location: admin/index.php");
    } elseif ($role == 'pemilik') {
        header("Location: pemilik/index.php");
    } elseif ($role == 'user'){
        header('Location: user/index.php');
    } else {
        header("Location: index.php");
    }
    exit;

} else {
    header("Location: login.php?pesan=Login gagal!");
    exit;
}
?>