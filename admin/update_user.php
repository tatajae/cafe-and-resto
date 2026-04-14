<?php

include "../koneksi.php";

$id=$_POST['id'];
$username=$_POST['username'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$password=$_POST['password'];
$role=$_POST['role'];

mysqli_query($conn,"UPDATE users SET
username='$username',
nama='$nama',
email='$email',
password='$password',
role='$role'
WHERE id_user='$id'");

header("location:index.php?menu=user");

?>