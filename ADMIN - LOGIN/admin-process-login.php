<?php
session_start();

$inputUser = $_POST['username'] ?? '';
$inputPass = $_POST['password'] ?? '';

// Hardcoded admin credentials
$adminUser = 'admin';
$adminPass = 'haligihomes';

if ($inputUser === $adminUser && $inputPass === $adminPass) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $adminUser;
    header("Location: admin-dashboard.php");
    exit();
} else {
    header("Location: admin-login.php?error=1");
    exit();
}
