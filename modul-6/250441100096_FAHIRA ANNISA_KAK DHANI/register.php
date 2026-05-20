<?php
session_start();
include 'config.php';

$error_msg = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user'; 

    $stmt_check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt_check->execute([$user]);
    
    if ($stmt_check->rowCount() > 0) {
        $error_msg = "Username sudah digunakan, silakan pilih yang lain.";
    } else {
    
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->execute([$user, $pass, $role]);
            
            header("Location: login.php?status=success");
            exit();
        } catch (PDOException $e) {
            $error_msg = "Terjadi kesalahan sistem.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Join Grand Hotel - Exclusive Access</title>
</head>
<body class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 min-h-screen flex items-center justify-center p-0 md:p-6 overflow-x-hidden relative font-['Plus_Jakarta_Sans',sans-serif]">

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-6xl bg-slate-900/60 backdrop-blur-xl md:rounded-[3rem] shadow-2xl border border-slate-800 overflow-hidden flex flex-col md:flex-row min-h-[90vh]">
        
        <div class="relative w-full md:w-1/2 min-h-[300px] md:min-h-full overflow-hidden flex items-center p-12">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000" alt="Hotel Interior" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-slate-950/70 to-transparent"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 bg-gradient-to-tr from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl italic shadow-xl shadow-indigo-500/30 transform -rotate-3">
                        G
                    </div>
                    <span class="text-white font-black tracking-tighter text-2xl leading-none">GRAND HOTEL</span>
                </div>
                <h1 class="text-5xl font-black text-white leading-tight tracking-tighter italic">
                    START YOUR <br> <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">JOURNEY</span> WITH US.
                </h1>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center relative">
            <a href="index.php" class="absolute top-6 left-8 md:top-10 md:left-16 flex items-center gap-2 text-slate-400 hover:text-blue-400 text-sm font-bold uppercase tracking-wider transition-colors group">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i> Kembali ke Beranda
            </a>

            <div class="max-w-md mx-auto w-full mt-10 md:mt-0">
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic">Create Account</h2>
                </div>

                <?php if ($error_msg): ?>
                    <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-lg"></i>
                        <span><?= $error_msg ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div class="group">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] block mb-2">Username</label>
                        <input type="text" name="username" required class="w-full bg-slate-950/40 border-2 border-slate-800/80 p-4 rounded-2xl text-white outline-none">
                    </div>
                    
                    <div class="group">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] block mb-2">Password</label>
                        <input type="password" name="password" required class="w-full bg-slate-950/40 border-2 border-slate-800/80 p-4 rounded-2xl text-white outline-none">
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] block mb-2">Account Role</label>
                        <select name="role" class="w-full bg-slate-950/40 border-2 border-slate-800/80 p-4 rounded-2xl text-slate-300 outline-none bg-slate-900">
                            <option value="user">Tamu (Customer)</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-5 rounded-2xl font-black uppercase tracking-widest text-sm">
                        Register Account
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-slate-500 text-sm">Sudah punya akun? <a href="login.php" class="text-blue-400 underline">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>