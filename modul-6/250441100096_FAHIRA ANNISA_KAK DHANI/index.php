<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #000; }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <title>Grand Hotel - Luxury & Comfort</title>
</head>
<body class="text-white">

    <nav class="fixed w-full z-50 px-8 py-6 flex justify-between items-center bg-black/80 backdrop-blur-md md:bg-gradient-to-b md:from-black/50 md:to-transparent md:backdrop-blur-none">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-2xl italic shadow-lg shadow-indigo-500/20">G</div>
            <span class="text-white font-black tracking-tighter text-xl">GRAND HOTEL</span>
        </div>
        <div class="hidden md:flex gap-8 text-white/80 text-sm font-bold uppercase tracking-widest">
            <a href="#fasilitas" class="hover:text-indigo-400 transition">Fasilitas</a>
            <a href="#kamar" class="hover:text-indigo-400 transition">Kamar</a>
            <a href="#kontak" class="hover:text-indigo-400 transition">Kontak</a>
        </div>
    </nav>

    <header class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2070" alt="Hotel View" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black"></div>
        </div>

        <div class="relative z-10 container mx-auto px-8 md:px-16 text-left">
            <div class="max-w-3xl">
                <h1 class="text-6xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter mb-8 italic">
                    CIPUTRA <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">WORLD.</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-xl font-light leading-relaxed border-l-4 border-indigo-600 pl-6">
                    Rasakan sensasi menginap di jantung kota dengan fasilitas bintang lima dan pelayanan setulus hati.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="login.php" class="group px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black transition-all hover:scale-105 shadow-2xl shadow-indigo-500/40 flex items-center justify-center gap-3">
                        BOOKING SEKARANG
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                    <a href="register.php" class="px-10 py-5 bg-white/5 backdrop-blur-md text-white border border-white/20 rounded-2xl font-black hover:bg-white hover:text-black transition-all text-center">
                        DAFTAR AKUN
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section id="fasilitas" class="py-24 px-8 bg-black">
        <div class="container mx-auto">
            <div class="mb-16">
                <h2 class="text-4xl font-black tracking-tighter italic">FASILITAS</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-2"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
               
                <div class="group relative h-80 overflow-hidden rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Pool">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex items-end p-8">
                        <div>
                            <h3 class="text-2xl font-bold italic">Infinity Pool</h3>
                            <p class="text-gray-400 text-sm">Pemandangan kota dari ketinggian.</p>
                        </div>
                    </div>
                </div>
                
                <div class="group relative h-80 overflow-hidden rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Restaurant">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex items-end p-8">
                        <div>
                            <h3 class="text-2xl font-bold italic">Sky Lounge & Bar</h3>
                            <p class="text-gray-400 text-sm">Kuliner kelas dunia setiap malam.</p>
                        </div>
                    </div>
                </div>
                
                <div class="group relative h-80 overflow-hidden rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gym">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex items-end p-8">
                        <div>
                            <h3 class="text-2xl font-bold italic">Fitness Center</h3>
                            <p class="text-gray-400 text-sm">Peralatan modern standar atlet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <section id="kamar" class="py-24 px-8 bg-[#0a0a0a]">
        <div class="container mx-auto">
            <div class="mb-16 text-right flex flex-col items-end">
                <h2 class="text-4xl font-black tracking-tighter italic uppercase">Premier Rooms</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-2"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="glass-card rounded-[2rem] overflow-hidden group">
                    <div class="h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?q=80&w=800" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Kamar Standard">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold italic">Standard</h3>
                            <span class="text-indigo-400 font-bold">Rp 500.000/night</span>
                        </div>
                        <p class="text-gray-400 mb-6 font-light">Kamar minimalis dan nyaman, pilihan terbaik untuk perjalanan bisnis Anda.</p>
                        <a href="login.php" class="block text-center py-4 bg-white text-black font-black rounded-xl hover:bg-indigo-600 hover:text-white transition">PESAN SEKARANG</a>
                    </div>
                </div>

                <div class="glass-card rounded-[2rem] overflow-hidden group">
                    <div class="h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=800" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Kamar Deluxe">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold italic">Deluxe Suite</h3>
                            <span class="text-indigo-400 font-bold">Rp 1.500.000/night</span>
                        </div>
                        <p class="text-gray-400 mb-6 font-light">Kamar luas dengan king-size bed dan city view yang memukau.</p>
                        <a href="login.php" class="block text-center py-4 bg-white text-black font-black rounded-xl hover:bg-indigo-600 hover:text-white transition">PESAN SEKARANG</a>
                    </div>
                </div>
                
                <div class="glass-card rounded-[2rem] overflow-hidden group md:col-span-2 lg:col-span-1">
                    <div class="h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="Kamar Presidential">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold italic">Presidential Suite</h3>
                            <span class="text-indigo-400 font-bold">Rp 3.200.000/night</span>
                        </div>
                        <p class="text-gray-400 mb-6 font-light">Kemewahan tertinggi dengan ruang tamu pribadi dan jacuzzi eksklusif.</p>
                        <a href="login.php" class="block text-center py-4 bg-white text-black font-black rounded-xl hover:bg-indigo-600 hover:text-white transition">PESAN SEKARANG</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="py-24 px-8 bg-black border-t border-white/10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-16">
        <div>
            <h2 class="text-5xl font-black italic mb-6">GET IN TOUCH.</h2>
            <p class="text-gray-400 mb-8 max-w-md">Ada pertanyaan? Tim kami siap melayani Anda 24/7 untuk memastikan pengalaman menginap Anda sempurna.</p>
            <div class="space-y-4">
                <div class="flex items-center gap-4 text-indigo-400">
                    <span class="font-bold uppercase tracking-widest text-xs">Address:</span>
                    <span class="text-white text-sm">Jl. Mawar No. 101, Surabaya</span>
                </div>
                <div class="flex items-center gap-4 text-indigo-400">
                    <span class="font-bold uppercase tracking-widest text-xs">WhatsApp:</span>
                    <span class="text-white text-sm">+62 812 4626 3069</span>
                </div>
            </div>
        </div>

        <form id="contactForm" class="space-y-4">
            <input type="text" placeholder="Nama Lengkap" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-xl focus:border-indigo-600 outline-none transition" required>
            <input type="email" placeholder="Email" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-xl focus:border-indigo-600 outline-none transition" required>
            <textarea placeholder="Pesan Anda" rows="4" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-xl focus:border-indigo-600 outline-none transition" required></textarea>
            <button type="submit" class="w-full py-4 bg-indigo-600 font-black rounded-xl hover:shadow-lg shadow-indigo-500/20 transition-all cursor-pointer">KIRIM PESAN</button>
            
            <div id="successMessage" class="hidden p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl text-center font-bold">
                Pesan Anda berhasil terkirim!
            </div>
            </form>
        </div>
    
        <div class="container mx-auto mt-24 pt-8 border-t border-white/5 text-center text-gray-600 text-sm">
            &copy; 2026 Grand Hotel Ciputra World. All Rights Reserved.
        </div>

        <script>
            const form = document.getElementById('contactForm');
            const successMsg = document.getElementById('successMessage');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
          
                successMsg.classList.remove('hidden');
        
                form.reset();
            
                setTimeout(() => {
                successMsg.classList.add('hidden');
                }, 5000);
            });
        </script>
    </footer>

</body>
</html>