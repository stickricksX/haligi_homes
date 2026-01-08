<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../USER - LOGIN & REGISTER/user-login.php");
    exit();
}

require_once '../db.php'; // DB connection

$username = $_SESSION['username'];

// Fetch user info from both tables
$sql = "SELECT a.id AS user_id, a.username, a.role, 
               p.fullname, p.email, p.phone, p.address 
        FROM accounts a 
        JOIN user_profiles p ON a.id = p.user_id 
        WHERE a.username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    echo "User information not found.";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Account - Haligi Homes</title>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Other CSS Styles Link-->
  <link rel="stylesheet" href="../style.css" />
  <style>
    .container { 
      max-width: 600px; 
      margin: 40px auto; 
      padding: 20px; 
      border: 1px solid #ddd; 
      border-radius: 10px; 
    }

    h2 { 
      text-align: center; 
      margin-bottom: 20px; 
    }

    .account-info label { 
      font-weight: bold; 
      display: block; 
      margin-top: 10px; 
    }

    .account-info input { 
      width: 100%; 
      padding: 8px; 
      margin-top: 5px; 
      margin-bottom: 15px; 
      border: 1px solid #ccc; 
      border-radius: 5px; 
    }

    .edit-btn { 
      display: block; 
      margin: 0 auto; 
      padding: 10px 20px; 
      background-color: #d4af37; 
      color: white; 
      border: none; 
      border-radius: 5px; 
      cursor: pointer; 
    }

    .edit-btn:hover { 
      background-color: #b38f00; 
    }
  </style>
  <!-- JS for Dropdown -->
  <script defer src="../script.js"></script>
</head>
<body>

  <header>
  <div class="navbar">
    <h1 class="logo">
      <img src="../img/lo.png" alt="Haligi Homes Logo" class="logo-img">
    </h1>

    <nav class="nav-links">
      <a href="../index.html">Home</a>
      <a href="../about/about.html">About</a>
      <a href="../index.html#properties">Listings</a>
      <a href="../contacts/contact_us.html">Contact Us</a>

      <div class="account-dropdown">
        <i class="fas fa-user-circle account-icon" onclick="toggleDropdown()"></i>
        <div class="dropdown-menu" id="accountDropdown">
          <a href="viewaccount.php"><i class="fas fa-user"></i> View Account</a>
          <a href="../USER - LOGIN & REGISTER/user-logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </nav>
  </div>
</header>

  <div class="container">
    <h2>My Account</h2>
    <form action="update_account.php" method="POST">
      <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

      <div class="account-info">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" readonly>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" readonly>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" readonly>
      </div>

      <button type="button" class="edit-btn" onclick="enableEdit()">Edit Account</button>
      <button type="submit" class="edit-btn" style="margin-top: 10px; display: none;" id="saveBtn">Save Changes</button>
    </form>
  </div>

  <script>
    function enableEdit() {
      const inputs = document.querySelectorAll('input:not([type=hidden])');
      inputs.forEach(input => input.removeAttribute('readonly'));
      document.getElementById('saveBtn').style.display = 'block';
    }
  </script>

</body>
</html>
