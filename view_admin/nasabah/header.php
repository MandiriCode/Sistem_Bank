
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bank</title>
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
    
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
        }
        .sidebar a:hover {
            background-color: #003366;
        }
        .stat-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .nav-title {
            color: #00BFFF;
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
                <li class="nav-item mb-2"><a href="../index.php">Dashboard</a></li>
                <li class="nav-item mb-2"><a href="data_nasabah.php">Data Nasabah</a></li>
                <li class="nav-item mb-2"><a href="../admin/data_admin.php">Data Admin</a></li>
                <li class="nav-item mb-2"><a href="../laporan/laporan.php">Laporan</a></li>
                <li class="nav-item mb-2"><a href="../logout.php"><b>LOG OUT</b></a></li>

            </ul>
        </div>
</body>
</html>

