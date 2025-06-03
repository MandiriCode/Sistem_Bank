<?php
include "../../include/config.php";
session_start();

// Cek apakah nasabah sudah login
if (!isset($_SESSION['id_nasabah'])) {
    header("Location: ../login.php");
    exit;
}

$id_nasabah = $_SESSION['id_nasabah'];
$nominal = isset($_POST['nominal']) ? (int)$_POST['nominal'] : 0;

// Validasi nominal
if ($nominal <= 0) {
    echo "<script>alert('Nominal tidak valid!'); window.location='../tarik.php';</script>";
    exit;
}

// Ambil data nasabah dari database
$stmt = $conn->prepare("SELECT * FROM nasabah WHERE id_nasabah = ?");
$stmt->bind_param("i", $id_nasabah);
$stmt->execute();
$result = $stmt->get_result();
$nasabah = $result->fetch_assoc();

if (!$nasabah) {
    echo "<script>alert('Nasabah tidak ditemukan!'); window.location='../login.php';</script>";
    exit;
}

$saldo_sekarang = (int)$nasabah['saldo'];

// Cek apakah saldo cukup
if ($saldo_sekarang < $nominal) {
    echo "<script>alert('Saldo tidak mencukupi!'); window.location='../tarik.php';</script>";
    exit;
}

// Kurangi saldo dan update
$saldo_baru = $saldo_sekarang - $nominal;
$update_stmt = $conn->prepare("UPDATE nasabah SET saldo = ? WHERE id_nasabah = ?");
$update_stmt->bind_param("ii", $saldo_baru, $id_nasabah);
$update_stmt->execute();

// Simpan ke tabel transaksi
$tanggal = date('Y-m-d H:i:s');
$tipe = 'tarik';
$nama_nasabah = $nasabah['nama_nasabah'];
$insert_stmt = $conn->prepare("INSERT INTO transaksi (id_nasabah, nama_nasabah, tipe, jumlah, tanggal) VALUES (?, ?, ?, ?, ?)");
$insert_stmt->bind_param("issis", $id_nasabah, $nama_nasabah, $tipe, $nominal, $tanggal);
$insert_stmt->execute();

echo "<script>alert('Penarikan saldo berhasil!'); window.location='../index.php';</script>";
?>
