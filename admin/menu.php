<?php 
if(isset($_GET['menu'])){
  $menu=$_GET['menu'];
}
else{
  $menu="";
}
if($menu=="produk"){
  include "produk.php";
}
else if($menu=="user"){
  include "user.php";
}
else if($menu=="edit_produk"){
  include "edit_produk.php";
}

else if($menu=="hapus_produk"){
  include "hapus_produk.php";
}

else if($menu=="tambah_produk"){
  include "tambah_produk.php";
}

else if($menu=="update_produk"){
  include "update_produk.php";
}

else if($menu=="tambah_user"){
  include "tambah_user.php";
}

else if($menu=="edit_user"){
  include "edit_user.php";
}

else if($menu=="hapus_user"){
  include "hapus_user.php";
}

else if($menu=="reservasi"){
  include "reservasi.php";
}

else if($menu=="kategori"){
  include "kategori.php";
}

else if($menu=="tambah_kategori"){
  include "tambah_kategori.php";
}


else{
  include "home.php";
}
?>