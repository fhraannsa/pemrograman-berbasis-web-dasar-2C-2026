<?php
session_start();
echo "Debug: Session user_id = " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "KOSONG");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

if ($role === 'admin') {
    header("Location: admin_dashboard.php");
    exit();
} else {
    header("Location: dashboard_user.php");
    exit();
}
?>