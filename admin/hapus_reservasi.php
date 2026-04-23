<?php

include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM reservasi WHERE id_reservasi='$id'");

header("location:reservasi.php");

?>