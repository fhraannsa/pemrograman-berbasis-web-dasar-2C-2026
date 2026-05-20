<?php
session_start();
include 'config.php';

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; // <--- PASTI KAN BARIS INI ADA
        $_SESSION['role'] = $user['role'];

        if ($_SESSION['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit();
    } else {
        $error_msg = "Username atau password salah!";
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
    <title>Welcome Back - Grand Hotel</title>
</head>
<body class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 min-h-screen flex items-center justify-center p-0 md:p-6 overflow-x-hidden relative font-['Plus_Jakarta_Sans',sans-serif]">

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-6xl bg-slate-900/60 backdrop-blur-xl md:rounded-[3rem] shadow-2xl border border-slate-800 overflow-hidden flex flex-col md:flex-row-reverse min-h-[90vh]">
        
        <div class="relative w-full md:w-1/2 min-h-[300px] md:min-h-full overflow-hidden flex items-center p-12">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070" alt="Luxury Hotel" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-tl from-slate-950 via-slate-950/70 to-transparent"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 bg-gradient-to-tr from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl italic shadow-xl shadow-indigo-500/30 transform -rotate-3">
                        G
                    </div>
                    <span class="text-white font-black tracking-tighter text-2xl leading-none">GRAND HOTEL</span>
                </div>
                <h1 class="text-5xl font-black text-white leading-tight tracking-tighter italic">
                    WELCOME <br> <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">BACK.</span>
                </h1>
                <p class="text-slate-300 mt-6 text-lg font-light max-w-sm leading-relaxed">
                    Masuk kembali untuk mengelola reservasi Anda dan nikmati layanan prioritas kami.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-20 flex flex-col justify-center relative">
            
            <a href="index.php" class="absolute top-6 left-8 md:top-10 md:left-20 flex items-center gap-2 text-slate-400 hover:text-blue-400 text-sm font-bold uppercase tracking-wider transition-colors group">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i> 
                Kembali ke Beranda
            </a>

            <div class="max-w-md mx-auto w-full mt-10 md:mt-0">
                <div class="mb-10">
                    <h2 class="text-4xl font-black text-white tracking-tighter uppercase italic">Sign In</h2>
                    <p class="text-slate-400 mt-2 font-medium">Akses dashboard eksklusif Anda</p>
                </div>

                <?php if(!empty($error_msg)): ?>
                    <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 p-4 rounded-xl mb-8 text-sm flex items-center gap-3 backdrop-blur-sm animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span><?= $error_msg ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div class="group">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1 block mb-2 group-focus-within:text-blue-400 transition-colors">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </span>
                            <input type="text" name="username" required class="w-full bg-slate-950/40 border-2 border-slate-800/80 p-4 pl-12 rounded-2xl focus:bg-slate-950/80 focus:border-blue-500 text-white outline-none transition-all font-semibold placeholder:text-slate-600" placeholder="Masukkan username">
                        </div>
                    </div>
                    
                    <div class="group">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1 block group-focus-within:text-blue-400 transition-colors">Password</label>
                            <a href="#" class="text-[10px] font-bold text-blue-400 hover:text-blue-300 uppercase tracking-tighter">Lupa Password?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 118 0v4" /></svg>
                            </span>
                            <input type="password" name="password" required class="w-full bg-slate-950/40 border-2 border-slate-800/80 p-4 pl-12 rounded-2xl focus:bg-slate-950/80 focus:border-blue-500 text-white outline-none transition-all font-semibold placeholder:text-slate-600" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white py-5 rounded-2xl font-black shadow-lg shadow-indigo-950/50 transition duration-300 transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-sm">
                            Masuk Sekarang
                        </button>
                    </div>
                </form> 

                <div class="space-y-4">
                    <div class="flex items-center my-4 justify-between">
                        <div class="w-full h-[1px] bg-slate-800"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-4 shrink-0">Atau</span>
                        <div class="w-full h-[1px] bg-slate-800"></div>
                    </div>

                    <a href="register.php" class="relative z-10 block w-full text-center bg-slate-950/60 border-2 border-slate-800 hover:border-slate-700 hover:bg-slate-950/90 text-slate-300 py-5 rounded-2xl font-bold transition duration-300 transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-sm cursor-pointer">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>