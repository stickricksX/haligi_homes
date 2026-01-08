<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "flower_shop"; // Use your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
