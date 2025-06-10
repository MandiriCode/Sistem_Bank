<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login & Register Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style_admin.css">

</head>

<body>

  <div class="container-wrapper">
    <div class="forms-container" id="formSlider">
      <!-- Login Form -->
      <div class="form-box">
        <h4>Login Admin</h4>
        <form action="proses_login_admin.php" method="post">
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" name="email_admin" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-4 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="passwordLogin" name="password_admin" class="form-control" placeholder="Password"
              required>
            <span class="input-group-text" onclick="togglePassword('passwordLogin', this)" style="cursor:pointer;">
              <i class="bi bi-eye-slash" id="icon-passwordLogin"></i>
            </span>
          </div>
          <button class="btn btn-primary w-100">Login</button>
          <div class="toggle-text">Belum punya akun? <a onclick="showRegister()">Register</a></div>
        </form>
      </div>

      <!-- Register Form -->
      <div class="form-box">
        <h4>Register Admin</h4>
        <form action="proses_register_admin.php" method="post">
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="nama_admin" class="form-control" placeholder="Nama Lengkap" required>
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
            <input type="text" name="alamat_admin" class="form-control" placeholder="Alamat" required>
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
            <input type="number" name="no_telp_admin" class="form-control" placeholder="No Telpon" required>
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" name="email_admin" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-4 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="passwordRegister" name="password_admin" class="form-control"
              placeholder="Password" required>
            <span class="input-group-text" onclick="togglePassword('passwordRegister', this)" style="cursor:pointer;">
              <i class="bi bi-eye-slash" id="icon-passwordRegister"></i>
            </span>
          </div>
          <button class="btn btn-primary w-100" type="submit" name="simpan">Register</button>
          <div class="toggle-text">Sudah punya akun? <a onclick="showLogin()">Login</a></div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      const icon = document.getElementById('icon-' + id);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      }
    }

    function showRegister() {
      document.getElementById('formSlider').style.transform = 'translateX(-50%)';
    }

    function showLogin() {
      document.getElementById('formSlider').style.transform = 'translateX(0%)';
    }
  </script>

</body>

</html>