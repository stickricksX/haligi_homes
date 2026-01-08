<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);
    $service = trim($_POST["service"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Basic password match check
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='register.html';</script>";
        exit();
    }

    // Check for existing full name
    $check = $conn->prepare("SELECT id FROM users WHERE fullname = ?");
    $check->bind_param("s", $fullname);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('User already exists.'); window.location.href='register.html';</script>";
        $check->close();
        exit();
    }

    $check->close();

    // Insert new user (plain text password for demo)
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, address, service, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $email, $phone, $address, $service, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Registration failed. Try again.'); window.location.href='register.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
