<?php
// Run this once to add an admin to the database
$host = "localhost";
$dbname = "haligi_homes";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $adminUsername = "admin";
    $adminPassword = password_hash("haligihomes", PASSWORD_DEFAULT); // Secure hash

    $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $adminUsername);
    $stmt->bindParam(':password', $adminPassword);
    $stmt->execute();

    echo "Admin user added successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
