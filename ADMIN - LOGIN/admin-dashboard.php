<?php
session_start();

// Block access if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: #f4f4f4;
      padding: 50px;
      text-align: center;
    }
    .logout-btn {
      margin-top: 20px;
      padding: 10px 20px;
      background: gold;
      border: none;
      color: #1a1a1a;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Welcome to the Admin Dashboard, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h1>
  <form action="admin-logout.php" method="POST">
    <button type="submit" class="logout-btn">Logout</button>
  </form>
</body>
</html>
