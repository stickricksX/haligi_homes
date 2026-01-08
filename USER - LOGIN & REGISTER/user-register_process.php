<?php
session_start();
require_once '../db.php'; // your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for all expected inputs first
    if (!isset($_POST['username'], $_POST['password'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'])) {
        echo "All fields are required. <a href='user-register.php'>Go back</a>.";
        exit;
    }

    // Sanitize inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = 'user'; // default role

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // ... (continue with your DB logic)
}

    // Check if required fields are not empty
    if (empty($username) || empty($password) || empty($fullname) || empty($email) || empty($phone) || empty($address)) {
        echo "All fields are required. <a href='./USER - LOGIN & REGISTER/user-register.php'>Go back</a>.";
        exit;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already taken. <a href='./USER - LOGIN & REGISTER/user-register.php'>Try again</a>.";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into accounts table
    $stmt = $conn->prepare("INSERT INTO accounts (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $role);
    $stmt->execute();

    $user_id = $stmt->insert_id; // <-- This gets the new account ID

        // Insert user details into user_profiles
        $stmt2 = $conn->prepare("INSERT INTO user_profiles (user_id, fullname, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issss", $user_id, $fullname, $email, $phone, $address);

        if ($stmt2->execute()) {
            $stmt2->close();
            // Optional: Set session if you want to log in user directly
            // $_SESSION['user_id'] = $user_id;
            header("Location: user-login.php"); // Go to login page
            exit;
        } else {
            echo "Failed to save profile info: " . $stmt2->error;
        }
    $conn->close();
?>
