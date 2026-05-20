<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $user_id = intval($_POST['user_id']);
    $check_in = mysqli_real_escape_string($conn_buka, $_POST['check_in']);
    $check_out = mysqli_real_escape_string($conn_buka, $_POST['check_out']);
    $total_price = intval($_POST['total_price']);

    $query_add = "INSERT INTO reservations (user_id, check_in, check_out, total_price) VALUES ($user_id, '$check_in', '$check_out', $total_price)";
    
    if (mysqli_query($conn_buka, $query_add)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($conn_buka) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Reservasi - Grand Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 min-h-screen text-slate-100 flex items-center justify-center p-4">

    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden">
        <div class="p-6 bg-slate-950/80 border-b border-slate-800 flex justify-between items-center">
            <h3 class="text-base font-black text-white uppercase tracking-wider italic">Tambah Reservasi Baru</h3>
            <a href="index.php" class="text-slate-400 hover:text-white text-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
        </div>
        <form action="" method="POST" class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">User ID</label>
                <input type="number" name="user_id" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500 transition">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Check In</label>
                    <input type="date" name="check_in" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Check Out</label>
                    <input type="date" name="check_out" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Total Harga (Rp)</label>
                <input type="number" name="total_price" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-emerald-400 font-bold focus:outline-none focus:border-indigo-500 transition">
            </div>

            <div class="pt-2">
                <button type="submit" name="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3.5 rounded-xl font-bold hover:from-blue-600 hover:to-indigo-700 transition duration-300 text-sm shadow-lg shadow-indigo-950/50">
                    Simpan Reservasi
                </button>
            </div>
        </form>
    </div>

</body>
</html>
<?php mysqli_close($conn_buka); ?>