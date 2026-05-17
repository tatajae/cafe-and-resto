<?php
session_start();
include "../koneksi.php";

$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn,"
SELECT * FROM users
WHERE id_user='$id_user'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // jika password diisi
    if($password != ""){

        $password = md5($password);

        mysqli_query($conn,"
        UPDATE users SET
        username='$username',
        password='$password'
        WHERE id_user='$id_user'
        ");

    }

    // update session username
    $_SESSION['username'] = $username;

    echo "
    <script>
        alert('Profil berhasil diupdate');
        window.location='index.php?page=profil';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Profil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#a97458;
    font-family:Poppins,sans-serif;
}

.card{
    border:none;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
}

.btn-save{
    background:#5a3825;
    color:white;
    border:none;
}

.btn-save:hover{
    background:#6f4e37;
    color:white;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4 mx-auto" style="max-width:500px;">

<h3 class="mb-4 text-center">
✏️ Edit Profil
</h3>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Username
</label>

<input type="text"
       name="username"
       class="form-control"
       value="<?= $d['username']; ?>"
       required>

</div>

<button type="submit"
        name="update"
        class="btn btn-save w-100">

    Simpan Perubahan

</button>

<a href="index.php?page=profil"
   class="btn btn-secondary w-100 mt-2">

    Kembali

</a>

</form>

</div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>