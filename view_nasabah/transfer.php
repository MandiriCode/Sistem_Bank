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
    <div class="tarik-card  ">
        <h4 class="mb-4 text-center">Transfer Saldo</h4>

        <form action="proses/proses_transfer.php" method="post" >
    <div class="mb-3">
        <label for="no_rek_tujuan" class="form-label">No Rekening Tujuan</label>
        <input type="text" class="form-control" name="no_rek_tujuan" required>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Transfer (Rp)</label>
        <input type="number" class="form-control" name="jumlah" required>
    </div>
    <button type="submit" class="btn btn-primary mb-3 w-100">Kirim</button>
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
