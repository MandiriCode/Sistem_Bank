<?php
include 'header.php';
include '../../include/config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telp = $_POST['no_telp'];


    mysqli_query($conn, "INSERT INTO admin (nama_admin, alamat_admin, email_admin, password_admin, no_telp_admin) 
        VALUES ('$nama', '$alamat', '$email', '$password', '$no_telp')");

    header("Location: data_admin.php");
}
?>

<div class="col-md-10 p-4">
    <h3>Tambah Admin </h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <textarea name="email" class="form-control" required></textarea>
        </div>   
         <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>     
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_telp" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="data_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
