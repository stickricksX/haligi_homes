<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-dashboard.php");
    exit();
}
$loginError = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ADMIN LOGIN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- GOOGLE FONTS LINK -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- BOXICONS CDN -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      background: url('./bg-image.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: #fff;
      backdrop-filter: blur(10px);
      padding: 30px 25px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .login-container h2 {
      text-align: center;
      color: #000;
      margin-bottom: 25px;
    }

    .input-group {
      font-family: 'Montserrat', sans-serif;
      display: flex;
      align-items: center;
      background: rgba(255, 255, 255, 0.3);
      border: 1px solid #333;
      border-radius: 6px;
      margin: 15px 0;
      padding: 10px;
    }

    .input-group.active {
      border: 1px solid gold !important;
    }

    .input-group i {
      color: #333;
      font-size: 20px;
      margin-right: 10px;
      min-width: 24px;
    }

    .input-group input {
      background: transparent;
      border: none;
      outline: none;
      width: 100%;
      font-size: 16px;
      color: #000;
    }

    .input-group input::placeholder {
      color: #333;
    }

    .password-toggle {
      cursor: pointer;
    }

    .login-btn {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: gold;
      border: none;
      color: #1a1a1a;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-btn:hover {
      background: #e6c200;
    }

    .error-message {
      color: #ff6666;
      text-align: center;
      margin-top: 10px;
    }

    @media (max-width: 500px) {
      .login-container {
        padding: 20px 15px;
      }

      .input-group input {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Panel Login</h2>
    <form action="admin-process-login.php" method="POST">
      <div class="input-group">
        <i class='bx bx-user'></i>
        <input type="text" name="username" placeholder="Username" required>
      </div>
      <div class="input-group">
        <i class='bx bx-lock-alt'></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class='bx bx-hide password-toggle' id="togglePassword"></i>
      </div>
      <button type="submit" class="login-btn">Login</button>
    </form>
  </div>

  <script>
    const inputs = document.querySelectorAll('.input-group input');

    inputs.forEach(input => {
    input.addEventListener('input', function () {
      const group = this.closest('.input-group');
      if (this.value.trim() !== '') {
        group.classList.add('active');
      } else {
        group.classList.remove('active');
      }
    });
  });

    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    toggle.addEventListener("click", () => {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      toggle.classList.toggle("bx-show");
      toggle.classList.toggle("bx-hide");
    });
  </script>
</body>
</html>
