<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['action']) && $_GET['action'] == 'checkout' && isset($_GET['id'])) {
    $id_reservation = intval($_GET['id']);
    $stmt_check = $pdo->prepare("SELECT * FROM reservations WHERE id = ? AND user_id = ?");
    $stmt_check->execute([$id_reservation, $user_id]);
    $reservation = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($reservation) {
        $pdo->prepare("UPDATE reservations SET status = 'completed' WHERE id = ? AND user_id = ?")->execute([$id_reservation, $user_id]);
        $pdo->prepare("UPDATE rooms SET status = 'Available' WHERE room_number = ?")->execute([$reservation['room_number']]);
        
        $_SESSION['message'] = "Reservasi #RES-" . $id_reservation . " berhasil di-check out!";
        
        header("Location: dashboard_user.php");
        exit();
    }
}

$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Grand Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 min-h-screen text-slate-100 overflow-x-hidden relative">

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <nav class="bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 px-6 py-5 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <span class="text-2xl font-black bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent tracking-tight italic">GRAND HOTEL</span>
            <div class="flex items-center space-x-6">
                <a href="login.php" class="text-slate-400 hover:text-white transition text-sm font-semibold">Kembali ke Login</a>
                <a href="logout.php" class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-2 rounded-xl font-semibold hover:bg-red-500 hover:text-white transition duration-300 text-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-10 max-w-6xl transition-all duration-700 ease-out">
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-2xl mb-8 text-center font-bold">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-[2.5rem] p-8 md:p-14 mb-10 text-white shadow-2xl shadow-indigo-950/50 relative overflow-hidden">
            <div class="relative z-10">
                <span class="bg-white/10 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-[0.2em] px-3 py-1.5 rounded-lg border border-white/10 mb-4 inline-block">Exclusive Access</span>
                <h2 class="text-3xl md:text-5xl font-black tracking-tight mb-3 italic">Selamat Datang Kembali!</h2>
                <p class="text-indigo-100 mb-0 max-w-md font-light leading-relaxed">Kelola reservasi kamar mewah Anda dengan mudah, cepat, dan real-time.</p>
            </div>
        </div>

        <div class="bg-slate-900/40 backdrop-blur-xl rounded-[2rem] shadow-xl border border-slate-800/80 p-6 md:p-10 mb-10">
            <h3 class="text-xl font-black text-white mb-8 flex items-center uppercase tracking-wider italic">
                <i class="fas fa-plus-circle text-blue-400 mr-3"></i> Buat Reservasi Baru
            </h3>
            <form action="proses_booking.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <select name="room_type" class="w-full bg-slate-950/60 border-2 border-slate-800 p-4 rounded-2xl text-white outline-none font-semibold">
                    <option value="Standard">Standard (Rp 500k)</option>
                    <option value="Deluxe">Deluxe (Rp 1jt)</option>
                    <option value="Suite">Suite (Rp 2jt)</option>
                </select>
                <input type="date" name="check_in" required class="w-full bg-slate-950/60 border-2 border-slate-800 p-4 rounded-2xl text-white outline-none font-semibold">
                <input type="number" name="room_number" min="1" required class="w-full bg-slate-950/60 border-2 border-slate-800 p-4 rounded-2xl text-white outline-none font-semibold" placeholder="No. Kamar">
                <input type="number" name="duration" min="1" value="1" required class="w-full bg-slate-950/60 border-2 border-slate-800 p-4 rounded-2xl text-white outline-none font-semibold" placeholder="Durasi (Malam)">
                <button type="submit" class="md:col-span-4 w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-black py-5 rounded-2xl shadow-lg uppercase tracking-widest text-sm">Konfirmasi Pesanan Sekarang</button>
            </form>
        </div>

        <div class="space-y-6">
            <?php foreach ($data as $row): ?>
            <div class="bg-slate-900/40 border border-slate-800 p-6 md:p-8 rounded-[2rem] flex flex-col lg:flex-row justify-between items-center gap-6">
                <div>
                    <h4 class="text-xl font-black text-white italic">#RES-<?= htmlspecialchars($row['id']) ?></h4>
                    <p class="text-blue-400 font-bold"><?= htmlspecialchars($row['room_type']) ?> - Kamar <?= htmlspecialchars($row['room_number']) ?></p>
                    <div class="text-xs text-slate-400 mt-2 space-y-1">
                        <p>Check-in: <b class="text-white"><?= htmlspecialchars($row['check_in']) ?></b></p>
                        <p>Check-out: <b class="text-white"><?= htmlspecialchars($row['check_out']) ?></b></p>
                        <p>Durasi: <b class="text-white"><?= htmlspecialchars($row['duration']) ?> Malam</b></p>
                    </div>
                </div>
                <div class="text-center lg:text-right">
                    <p class="text-[10px] uppercase tracking-widest text-slate-500 font-black">Total Bayar</p>
                    <p class="text-2xl font-black text-emerald-400 mb-4">Rp <?= number_format($row['total_price'] ?? 0, 0, ',', '.') ?></p>
                    <a href="dashboard_user.php?action=checkout&id=<?= $row['id'] ?>" 
                       onclick="return confirm('Check-out sekarang?')" 
                       class="bg-rose-500/10 text-rose-400 px-6 py-3 rounded-xl font-bold text-sm hover:bg-rose-600 hover:text-white transition">Check-Out</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>