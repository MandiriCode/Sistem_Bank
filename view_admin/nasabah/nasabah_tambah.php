<?php
session_start();
include 'header.php';
include '../../include/config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $no_rek = $_POST['no_rek'];
    $saldo = $_POST['saldo'];
    $password = $_POST['password'];


    // Check for duplicate account number
    $no_rek_check = $_POST['no_rek'];
    $check_query = "SELECT * FROM nasabah WHERE no_rek_nasabah = '$no_rek_check'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error_message'] = "Nomor rekening sudah ada!";
        header("Location: nasabah_tambah.php");
        exit;
    } else {
        mysqli_query($conn, "INSERT INTO nasabah (nama_nasabah, no_hp_nasabah, alamat_nasabah, no_rek_nasabah, saldo, password_nasabah)
            VALUES ('$nama', '$no_hp', '$alamat', '$no_rek', '$saldo', '$password')");
    }

    header("Location: data_nasabah.php");
}
?>

<div class="col-md-10 p-4">
    <h3>Tambah Nasabah Baru</h3>
    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']); // Clear the error message after displaying
    }
    ?>
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
