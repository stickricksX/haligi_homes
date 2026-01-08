<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Correct table: accounts (not user_profiles)
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Store necessary session variables
            $_SESSION['user_id'] = $row['id']; // Link to user_profiles via this ID
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header('Location: ../ADMIN - LOGIN/admin-login.php');
                exit();
            } else {
                header('Location: ../index.html'); // or wherever your home page is
                exit();
            }
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='user-login.php';</script>";
        }
    } else {
        echo "<script>alert('Username not found.'); window.location.href='user-login.php';</script>";
    }
}
?>
