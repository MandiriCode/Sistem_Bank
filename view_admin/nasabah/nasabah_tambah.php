<?php
include 'header.php';
include '../../include/config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $no_rek = $_POST['no_rek'];
    $saldo = $_POST['saldo'];
    $password = $_POST['password'];


    mysqli_query($conn, "INSERT INTO nasabah (nama_nasabah, no_hp_nasabah, alamat_nasabah, no_rek_nasabah, saldo, password_nasabah) 
        VALUES ('$nama', '$no_hp', '$alamat', '$no_rek', '$saldo', '$password')");

    header("Location: data_nasabah.php");
}
?>

<div class="col-md-10 p-4">
    <h3>Tambah Nasabah Baru</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Nasabah</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="no_rek" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Saldo Awal</label>
            <input type="number" name="saldo" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="nasabah.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
