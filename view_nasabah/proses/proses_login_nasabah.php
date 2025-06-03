<?php
session_start();
include "../../include/config.php";

$no_rek_nasabah = trim($_POST['no_rek_nasabah']);
$password_nasabah = trim($_POST['password_nasabah']);

// Cari berdasarkan nomor rekening
$stmt = $conn->prepare("SELECT * FROM nasabah WHERE no_rek_nasabah = ?");
$stmt->bind_param("s", $no_rek_nasabah);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    if ($password_nasabah === $data['password_nasabah']) {
        // Simpan hanya ID nasabah di sesi
        $_SESSION['id_nasabah'] = $data['id_nasabah'];
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='../login.php';</script>";
    }
} else {
    echo "<script>alert('Nomor rekening tidak ditemukan!'); window.location='../login.php';</script>";
}
