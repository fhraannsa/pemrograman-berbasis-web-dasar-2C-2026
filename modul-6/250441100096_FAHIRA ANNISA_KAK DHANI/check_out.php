<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_users']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id_booking = intval($_GET['id']);
    $stmt = mysqli_prepare($conn, "UPDATE booking SET status = 'Selesai' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_booking);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: dashboard.php?status=checkout_success");
        exit;
    } else {
        die("Gagal memproses check-out: " . mysqli_error($conn));
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>