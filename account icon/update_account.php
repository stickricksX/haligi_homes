<?php
session_start();
require_once '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $stmt = $conn->prepare("UPDATE user_profiles SET fullname = ?, email = ?, phone = ?, address = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $fullname, $email, $phone, $address, $user_id);

    if ($stmt->execute()) {
        header("Location: viewaccount.php");
        exit();
    } else {
        echo "Error updating account.";
    }

    $stmt->close();
    $conn->close();
}
?>
