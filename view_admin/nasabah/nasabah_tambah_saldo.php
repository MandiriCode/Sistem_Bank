<?php
include 'header.php';
include '../../include/config.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nasabah WHERE id_nasabah='$id'"));

if (isset($_POST['tambah'])) {
    $tambah = $_POST['saldo'];
    $getNama = mysqli_query($conn, "SELECT nama_nasabah FROM nasabah WHERE id_nasabah = '$id'");
    $nasabah = mysqli_fetch_assoc($getNama);
    $nama_nasabah = $nasabah['nama_nasabah'] ?? 'Tidak Diketahu';


    mysqli_query($conn, "UPDATE nasabah SET saldo = saldo + $tambah WHERE id_nasabah='$id'");

    // Simpan ke histori transaksi
    mysqli_query($conn, "INSERT INTO transaksi (id_nasabah, tipe, jumlah, tanggal, nama_nasabah) VALUES ('$id', 'tambah', '$tambah', NOW(), '$nama_nasabah')");
    header("Location: data_nasabah.php");
}
?>

<div class="col-md-10 p-4">
    <h3>Tambah Saldo</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nominal Tambah</label>
            <input type="number" name="saldo" class="form-control" required>
        </div>
        <button type="submit" name="tambah" class="btn btn-success">Proses</button>
    </form>
</div>
