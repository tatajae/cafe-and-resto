<?php
include "../koneksi.php";
?>
<div class="container-box">

<h4>👤 Profil Saya</h4>

<hr>

<p>
<b>Username:</b>
<?= $_SESSION['username']; ?>
</p>

<a href="edit_profil.php" class="btn btn-secondary">
    Edit Profil
</a>

</div>