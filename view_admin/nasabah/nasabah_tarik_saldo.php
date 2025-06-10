<?php
include 'header.php';
include '../../include/config.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nasabah WHERE id_nasabah='$id'"));

if (isset($_POST['tarik'])) {
    $tarik = $_POST['saldo'];
    $getNama = mysqli_query($conn, "SELECT nama_nasabah FROM nasabah WHERE id_nasabah = '$id'");
    $nasabah = mysqli_fetch_assoc($getNama);
    $nama_nasabah = $nasabah['nama_nasabah'] ?? 'Tidak Diketahu';

    if ($tarik <= $data['saldo']) {
        mysqli_query($conn, "UPDATE nasabah SET saldo = saldo - $tarik WHERE id_nasabah='$id'");
        mysqli_query($conn, "INSERT INTO transaksi (id_nasabah, tipe, jumlah, tanggal, nama_nasabah) VALUES ('$id', 'tarik', '$tarik', NOW(), '$nama_nasabah')");
        header("Location: data_nasabah.php");
    } else {
        echo "<script>alert('Saldo tidak mencukupi!');</script>";
    }
}
?>

<div class="col-md-10 p-4">
    <h3>Tarik Saldo</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nominal Tarik</label>
            <input type="number" name="saldo" class="form-control" required>
        </div>
        <button type="submit" name="tarik" class="btn btn-danger">Proses</button>
    </form>
</div>
