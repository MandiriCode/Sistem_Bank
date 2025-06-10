<?php
session_start();
include "../../include/config.php";

$no_rek_nasabah = trim($_POST['no_rek_nasabah']);
$password_nasabah = trim($_POST['password_nasabah']);

// Kunci login jika melebihi batas percobaan
if (isset($_SESSION['locked']) && time() < $_SESSION['locked']) {
    $remaining = $_SESSION['locked'] - time();
    echo "<script>alert('Terlalu banyak percobaan. Silakan coba lagi dalam $remaining detik.'); window.location='../login.php';</script>";
    exit;
}

// Cek ke database
$stmt = $conn->prepare("SELECT * FROM nasabah WHERE no_rek_nasabah = ?");
$stmt->bind_param("s", $no_rek_nasabah);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    if ($password_nasabah === $data['password_nasabah']) {
        // Login berhasil
        $_SESSION['id_nasabah'] = $data['id_nasabah'];
        unset($_SESSION['attempt']);
        unset($_SESSION['locked']);
        header("Location: ../index.php");
        exit;
    } else {
        // Password salah
        $_SESSION['attempt'] = ($_SESSION['attempt'] ?? 0) + 1;

        if ($_SESSION['attempt'] >= 3) {
            $_SESSION['locked'] = time() + 30; // Blokir selama 30 detik
            echo "<script>alert('3 kali salah. Silakan coba lagi dalam 30 detik.'); window.location='../login.php';</script>";
        } else {
            $sisa = 3 - $_SESSION['attempt'];
            echo "<script>alert('Password salah! Sisa percobaan: $sisa'); window.location='../login.php';</script>";
        }
    }
} else {
    echo "<script>alert('Nomor rekening tidak ditemukan!'); window.location='../login.php';</script>";
}
