
<?php
include '../include/config.php';

session_start();
if (!isset($_SESSION['id_nasabah'])) {
    header("Location: login.php");
    exit;
}

$id_nasabah = $_SESSION['id_nasabah'];
$stmt = $conn->prepare("SELECT * FROM nasabah WHERE id_nasabah = ?");
$stmt->bind_param("i", $id_nasabah);
$stmt->execute();
$result = $stmt->get_result();
$data_nasabah = $result->fetch_assoc();

// Cek saldo dengan prepared statement
$stmtSaldo = $conn->prepare("SELECT saldo AS total_saldo FROM nasabah WHERE id_nasabah = ?");
$stmtSaldo->bind_param("i", $id_nasabah);
$stmtSaldo->execute();
$resultSaldo = $stmtSaldo->get_result();
$saldo = $resultSaldo->fetch_assoc()['total_saldo'] ?? 0;
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Nasabah</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body>
    <div class="dashboard-card text-center">
        <h3 class="mb-4">Saldo Yang Anda Miliki Saat Ini !!</h3>
        
                    <div class="stat-card">
                        <h2 class="text-success mb-4">Rp <?= number_format($saldo, 0, ',', '.') ?></h2>
                    </div>
                    <button class="btn btn-secondary"><a style="text-decoration: none; color: white;" href="index.php">KEMBALI</a></button>
                </div>
</body>
</html>
