<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    
    $customer_name = $_SESSION['username'] ?? null;
    
    if (!$customer_name) {
        $stmt_user = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt_user->execute([$user_id]);
        $user_data = $stmt_user->fetch();
        $customer_name = $user_data['username'] ?? 'User';
    }

    $room_type = $_POST['room_type'];
    $room_number = $_POST['room_number'];
    $check_in = $_POST['check_in'];
    $duration = intval($_POST['duration']);

    $prices = ['Standard' => 500000, 'Deluxe' => 1000000, 'Suite' => 2000000];
    $total_price = ($prices[$room_type] ?? 500000) * $duration;
    
    $check_out = date('Y-m-d', strtotime($check_in . " + $duration days"));

    $stmt = $pdo->prepare("INSERT INTO reservations 
        (customer_name, user_id, room_type, room_number, check_in, check_out, duration, total_price, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        
    $stmt->execute([$customer_name, $user_id, $room_type, $room_number, $check_in, $check_out, $duration, $total_price]);

    $_SESSION['message'] = "Reservasi berhasil dibuat!";
    header("Location: dashboard_user.php");
    exit();
}
?>