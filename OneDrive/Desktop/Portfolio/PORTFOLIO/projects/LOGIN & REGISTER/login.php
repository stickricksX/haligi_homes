<?php
session_start();
include("db.php"); // Connect to DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $password = trim($_POST["password"]);

    // Prepare SQL
    $sql = "SELECT * FROM users WHERE fullname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check password (plain text)
        if ($password === $user['password']) {
            // Start session and store user info
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            // Redirect to dashboard
            header("Location: ddash.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Full name not found.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
