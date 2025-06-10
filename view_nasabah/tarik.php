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
    <title>Tarik Saldo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tarik-card">
        <h4 class="mb-4 text-center">Tarik Saldo</h4>
        <form action="proses/proses_tarik.php" method="post">
            <div class="d-flex flex-wrap justify-content-between mb-3">
                <button type="button" class="btn btn-outline-primary btn-nominal" onclick="setNominal(100000)">Rp 100.000</button>
                <button type="button" class="btn btn-outline-primary btn-nominal" onclick="setNominal(300000)">Rp 300.000</button>
                <button type="button" class="btn btn-outline-primary btn-nominal" onclick="setNominal(500000)">Rp 500.000</button>
                <button type="button" class="btn btn-outline-primary btn-nominal" onclick="setNominal(1000000)">Rp 1.000.000</button>
            </div>
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal Lainnya</label>
                <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal...">
            </div>
            <button type="submit" class="btn btn-success mb-3 w-100">Tarik Sekarang</button>
        </form>
         <button class="btn btn-secondary w-100" onclick="window.location='index.php'">Kembali</button>
    </div>

    <script>
        function setNominal(amount) {
            document.getElementById('nominal').value = amount;
        }
    </script>
</body>
</html>
