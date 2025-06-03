<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 bg-white p-4 shadow rounded">
            <h4 class="text-center mb-3">Login</h4>
            <form action="proses/proses_login_nasabah.php" method="post">
                <!-- <input type="text" name="nama_nasabah" class="form-control mb-3" placeholder="Username" required>
                <input type="number" name="no_hp_nasabah" class="form-control mb-3" placeholder="No Telepon" required> -->
                <label for="no_rek_nasabah" class="form-label">Nomor Rekening :</label>
                <input type="text" name="no_rek_nasabah" class="form-control mb-3"  required>

                <label for="password_nasabah" class="form-label">Password</label>
                <input type="password" name="password_nasabah" class="form-control mb-3"required>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
