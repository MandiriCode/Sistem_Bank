<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../include/config.php'; // Sesuaikan path file config.php-mu

$statistik_query = mysqli_query($conn, "
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan,
        SUM(
            CASE 
                WHEN tipe = 'tambah' OR tipe = 'transfer_masuk' THEN jumlah
                WHEN tipe = 'tarik' OR tipe = 'transfer_keluar' THEN -jumlah
                ELSE 0
            END
        ) AS saldo_bulan
    FROM transaksi
    GROUP BY bulan
    ORDER BY bulan
");

$bulan_array = [];
$saldo_array = [];
$total = 0;

while ($row = mysqli_fetch_assoc($statistik_query)) {
    $total += $row['saldo_bulan']; // kumulatif saldo
    $bulan_array[] = $row['bulan'];
    $saldo_array[] = round($total / 1000000, 2); // jadi juta (jt)
}

// Ambil data total saldo nasabah
$saldo_result = mysqli_query($conn, "SELECT SUM(saldo) as total_saldo FROM nasabah");
$saldo = mysqli_fetch_assoc($saldo_result)['total_saldo'] ?? 0;

// Hitung total nasabah
$nasabah_result = mysqli_query($conn, "SELECT COUNT(*) as total_nasabah FROM nasabah");
$total_nasabah = mysqli_fetch_assoc($nasabah_result)['total_nasabah'] ?? 0;

// Hitung total admin
$admin_result = mysqli_query($conn, "SELECT COUNT(*) as total_admin FROM admin");
$total_admin = mysqli_fetch_assoc($admin_result)['total_admin'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bank</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f1f4f9;
        }
        .sidebar {
            background-color: #002244;
            height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #003366;
        }
        .stat-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            transition: all 0.3s ease-in-out;
            transform: scale(0.95);
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
        .stat-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }
        .nav-title {
            color: #00BFFF;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-4">
            <h4 class="text-center nav-title">BANK APP</h4>
            <hr class="text-light">
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="index.php">Dashboard</a></li>
                <li class="nav-item mb-2"><a href="nasabah/data_nasabah.php">Data Nasabah</a></li>
                <li class="nav-item mb-2"><a href="admin/data_admin.php">Data Admin</a></li>
                <li class="nav-item mb-2"><a href="laporan/laporan.php">Laporan</a></li>
                <li class="nav-item mb-2"><a href="logout.php"><b>LOG OUT</b></a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h3 class="mb-4">Dashboard</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Total Saldo Nasabah</h5>
                        <h2 class="text-success">Rp <?= number_format($saldo, 0, ',', '.') ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Total Data Nasabah</h5>
                        <h2 class="text-primary"><?= $total_nasabah ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Jumlah Admin</h5>
                        <h2 class="text-warning"><?= $total_admin ?></h2>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h5>Statistik Saldo</h5>
                <canvas id="saldoChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('saldoChart').getContext('2d');
    const saldoChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($bulan_array); ?>,
            datasets: [{
                label: 'Total Saldo (juta)',
                data: <?= json_encode($saldo_array); ?>,
                backgroundColor: 'rgba(0, 191, 255, 0.2)',
                borderColor: '#00BFFF',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#00BFFF',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + ' jt';
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            }
        }
    });
</script>
</body>
</html>
