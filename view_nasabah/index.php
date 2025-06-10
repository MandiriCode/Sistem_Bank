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
</head>
<body>
    <div class="dashboard-card text-center">
        <h3 class="mb-4">Selamat Datang, Nasabah!</h3>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="feature" onclick="window.location='tarik.php'">
                    <i class="fas fa-money-bill-wave"></i>
                    <h5>Tarik Saldo</h5>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="feature" onclick="window.location='stor.php'">
                    <i class="fas fa-wallet"></i>
                    <h5>Setor Saldo</h5>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="feature" onclick="window.location='cek_saldo.php'">
                    <i class="fas fa-eye"></i>
                    <h5>Cek Saldo</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature" onclick="window.location='transfer.php'">
                    <i class="fas fa-exchange-alt"></i>
                    <h5>Transfer</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature" onclick="window.location='logout.php'">
                    <i class="fas fa-exchange-alt"></i>
                    <h5>LogOut</h5>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
