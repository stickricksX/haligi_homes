<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "haligi_homes"; // database

$conn = new mysqli("localhost", "root", "", "haligi_homes");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
