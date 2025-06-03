<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(-45deg, #6a11cb, #2575fc, #43e97b, #38f9d7);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      font-family: 'Segoe UI', sans-serif;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .login-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      z-index: 2;
      position: relative;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #2575fc;
    }

    .btn-primary {
      background-color: #2575fc;
      border: none;
    }

    .btn-primary:hover {
      background-color: #1a5ee3;
    }

    /* Bubbles Layer */
    .bubbles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      pointer-events: none;
    }

    .bubbles span {
      position: absolute;
      display: block;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      bottom: -150px;
      animation: rise 10s infinite ease-in;
    }

    @keyframes rise {
      0% {
        transform: translateY(0) scale(1);
        opacity: 0.5;
      }
      100% {
        transform: translateY(-1200px) scale(0.5);
        opacity: 0;
      }
    }

    /* Gelembung variasi */
    .bubbles span:nth-child(1) { left: 10%; width: 25px; height: 25px; animation-duration: 12s; }
    .bubbles span:nth-child(2) { left: 25%; width: 40px; height: 40px; animation-duration: 18s; }
    .bubbles span:nth-child(3) { left: 40%; width: 20px; height: 20px; animation-duration: 15s; }
    .bubbles span:nth-child(4) { left: 60%; width: 35px; height: 35px; animation-duration: 22s; }
    .bubbles span:nth-child(5) { left: 75%; width: 30px; height: 30px; animation-duration: 20s; }
    .bubbles span:nth-child(6) { left: 85%; width: 15px; height: 15px; animation-duration: 17s; }
    .bubbles span:nth-child(7) { left: 50%; width: 45px; height: 45px; animation-duration: 25s; }

  </style>
</head>
<body>

  <!-- Bubbles -->
  <div class="bubbles">
    <span></span><span></span><span></span>
    <span></span><span></span><span></span>
    <span></span>
  </div>

  <!-- Login Card -->
  <div class="login-box">
    <h4 class="text-center">Login Admin</h4>
    <form action="proses_login_admin.php" method="post">
      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
        <input type="text" name="email_admin" class="form-control" placeholder="Email Admin" required>
      </div>
      <div class="mb-4 input-group">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <input type="password" name="password_admin" class="form-control" placeholder="Password" required>
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
  </div>

</body>
</html>
