<?php
include 'header.php';
include '../../include/config.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telp = $_POST['no_telp'];

    mysqli_query($conn, "UPDATE admin SET nama_admin='$nama', alamat_admin='$alamat', email_admin='$email', password_admin='$password', no_telp_admin='$no_telp' WHERE id_admin='$id'");
    header("Location: data_admin.php");
}
?>

<div class="col-md-10 p-4">
    <h3>Edit Data</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama_admin'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat_admin'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?= $data['email_admin'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" value="<?= $data['password_admin'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_telp" class="form-control" value="<?= $data['no_telp_admin'] ?>" required>
        </div>
       
        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
        <a href="data_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
