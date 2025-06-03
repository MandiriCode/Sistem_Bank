<?php
include "../../include/config.php";
session_start();

if (!isset($_SESSION['id_nasabah'])) {
    header("Location: ../login.php");
    exit;
}

$id_pengirim = $_SESSION['id_nasabah'];
$no_rek_tujuan = trim($_POST['no_rek_tujuan']);
$jumlah_transfer = (int)$_POST['jumlah'];

// Validasi input
if ($jumlah_transfer <= 0) {
    echo "<script>alert('Jumlah transfer tidak valid!'); window.location='../transfer.php';</script>";
    exit;
}

// Ambil data pengirim
$stmt_pengirim = $conn->prepare("SELECT * FROM nasabah WHERE id_nasabah = ?");
$stmt_pengirim->bind_param("i", $id_pengirim);
$stmt_pengirim->execute();
$data_pengirim = $stmt_pengirim->get_result()->fetch_assoc();

// Cek saldo cukup
if ($data_pengirim['saldo'] < $jumlah_transfer) {
    echo "<script>alert('Saldo tidak cukup!'); window.location='../transfer.php';</script>";
    exit;
}

// Cek apakah rekening tujuan ada
$stmt_penerima = $conn->prepare("SELECT * FROM nasabah WHERE no_rek_nasabah = ?");
$stmt_penerima->bind_param("s", $no_rek_tujuan);
$stmt_penerima->execute();
$data_penerima = $stmt_penerima->get_result()->fetch_assoc();

if (!$data_penerima) {
    echo "<script>alert('Rekening tujuan tidak ditemukan!'); window.location='../transfer.php';</script>";
    exit;
}

$id_penerima = $data_penerima['id_nasabah'];

// Mulai transaksi database
$conn->begin_transaction();

try {
    // Kurangi saldo pengirim
    $stmt1 = $conn->prepare("UPDATE nasabah SET saldo = saldo - ? WHERE id_nasabah = ?");
    $stmt1->bind_param("ii", $jumlah_transfer, $id_pengirim);
    $stmt1->execute();

    // Tambah saldo penerima
    $stmt2 = $conn->prepare("UPDATE nasabah SET saldo = saldo + ? WHERE id_nasabah = ?");
    $stmt2->bind_param("ii", $jumlah_transfer, $id_penerima);
    $stmt2->execute();

    $tanggal = date('Y-m-d H:i:s');

    // Catat transaksi pengirim
    $stmt3 = $conn->prepare("INSERT INTO transaksi (id_nasabah, nama_nasabah, tipe, jumlah, tanggal, keterangan) 
                             VALUES (?, ?, 'transfer_keluar', ?, ?, ?)");
    $stmt3->bind_param("isiss", $id_pengirim, $data_pengirim['nama_nasabah'], $jumlah_transfer, $tanggal, $no_rek_tujuan);
    $stmt3->execute();

    // Catat transaksi penerima
    $stmt4 = $conn->prepare("INSERT INTO transaksi (id_nasabah, nama_nasabah, tipe, jumlah, tanggal, keterangan) 
                             VALUES (?, ?, 'transfer_masuk', ?, ?, ?)");
    $stmt4->bind_param("isiss", $id_penerima, $data_penerima['nama_nasabah'], $jumlah_transfer, $tanggal, $data_pengirim['no_rek_nasabah']);
    $stmt4->execute();

    // Commit transaksi
    $conn->commit();

    echo "<script>alert('Transfer berhasil!'); window.location='../index.php';</script>";
} catch (Exception $e) {
    $conn->rollback();
    echo "<script>alert('Terjadi kesalahan saat transfer!'); window.location='../transfer.php';</script>";
}
?>
