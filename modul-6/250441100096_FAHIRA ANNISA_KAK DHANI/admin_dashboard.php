<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'] ?? 'Admin';
$error_kamar = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_kamar'])) {
    if ($_POST['action_kamar'] == 'create_kamar') {
        $stmt = $pdo->prepare("INSERT INTO rooms (room_number, room_type, price, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['room_number'], $_POST['room_type'], intval($_POST['price']), $_POST['status']]);
        header("Location: admin_dashboard.php?tab=kamar");
        exit();
    } elseif ($_POST['action_kamar'] == 'update_kamar') {
        $stmt = $pdo->prepare("UPDATE rooms SET room_number = ?, room_type = ?, price = ?, status = ? WHERE id = ?");
        $stmt->execute([$_POST['room_number'], $_POST['room_type'], intval($_POST['price']), $_POST['status'], intval($_POST['id_kamar'])]);
        header("Location: admin_dashboard.php?tab=kamar");
        exit();
    }
}

if (isset($_GET['action_kamar']) && $_GET['action_kamar'] == 'delete' && isset($_GET['id_kamar'])) {
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->execute([intval($_GET['id_kamar'])]);
    header("Location: admin_dashboard.php?tab=kamar");
    exit();
}

$revenue = 0;
$data = [];
$rooms = [];

try {
    $stmtRes = $pdo->query("SELECT * FROM reservations ORDER BY id DESC");
    $data = $stmtRes->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) { $revenue += ($row['total_price'] ?? 0); }

    $stmtKamar = $pdo->query("SELECT * FROM rooms ORDER BY room_number ASC");
    $rooms = $stmtKamar->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { 
    $error_kamar = "Database Error: " . $e->getMessage();
}

$tab_aktif = $_GET['tab'] ?? 'reservasi';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Grand Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 min-h-screen text-slate-100 font-['Plus_Jakarta_Sans',sans-serif] overflow-x-hidden relative">

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <nav class="bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 px-6 py-5 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-black bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent tracking-wider italic">
                <i class="fas fa-chart-line mr-2 text-blue-400"></i> ADMIN DASHBOARD
            </h1>
            <div class="flex items-center gap-4">
                <span class="text-slate-400 text-sm hidden sm:inline">Welcome, <b class="text-white"><?= htmlspecialchars($username) ?></b></span>
                <button type="button" onclick="window.location.href='logout.php';" class="cursor-pointer bg-slate-800 text-slate-300 border border-slate-700 px-4 py-2 rounded-xl font-semibold hover:bg-slate-700 hover:text-white transition duration-300 text-sm shadow-lg">
                    <i class="fas fa-arrow-left mr-1"></i> Login Page
                </button>
                <button type="button" onclick="window.location.href='logout.php';" class="cursor-pointer bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-2 rounded-xl font-semibold hover:bg-red-500 hover:text-white transition duration-300 text-sm shadow-lg shadow-red-950/20">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10 max-w-6xl">
        <?php if(!empty($error_kamar)): ?>
            <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 p-4 rounded-xl mb-6 text-sm">
                <i class="fas fa-exclamation-triangle mr-2"></i> <?= htmlspecialchars($error_kamar) ?>
            </div>
        <?php endif; ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-slate-900/40 backdrop-blur-xl p-6 md:p-8 rounded-[2rem] shadow-xl border border-slate-800/80 relative overflow-hidden group hover:border-emerald-500/30 transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Total Pendapatan</p>
                        <h3 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent mt-2 tracking-tight">
                            Rp <?= number_format($revenue, 0, ',', '.') ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900/40 backdrop-blur-xl p-6 md:p-8 rounded-[2rem] shadow-xl border border-slate-800/80 relative overflow-hidden group hover:border-blue-500/30 transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-blue-500"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Total Reservasi</p>
                        <h3 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent mt-2 tracking-tight">
                            <?= count($data) ?> Items
                        </h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-400 border border-blue-500/20">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <a href="admin_dashboard.php?tab=reservasi" class="px-6 py-3 rounded-xl font-bold text-sm transition <?= $tab_aktif === 'reservasi' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900/40 border border-slate-800 text-slate-400 hover:text-white' ?>">
                <i class="fas fa-list mr-2"></i> Manajemen Data Reservasi
            </a>
            <a href="admin_dashboard.php?tab=kamar" class="px-6 py-3 rounded-xl font-bold text-sm transition <?= $tab_aktif === 'kamar' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900/40 border border-slate-800 text-slate-400 hover:text-white' ?>">
                <i class="fas fa-door-open mr-2"></i> Manajemen Data Kamar
            </a>
        </div>

        <?php if($tab_aktif === 'reservasi'): ?>
        <div class="bg-slate-900/40 backdrop-blur-xl rounded-[2rem] shadow-xl border border-slate-800/80 overflow-hidden">
            <div class="p-6 md:p-8 bg-slate-900/80 border-b border-slate-800 flex justify-between items-center">
                <h2 class="text-lg font-black text-white uppercase tracking-wider italic">Daftar Transaksi Reservasi</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/80 border-b border-slate-800">
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">ID</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Periode Stay</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Harga</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        <?php if(empty($data)): ?>
                            <tr><td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada data reservasi.</td></tr>
                        <?php else: ?>
                            <?php foreach ($data as $row): ?>
                            <tr class="hover:bg-slate-850/40 transition duration-300">
                                <td class="px-6 py-5 font-black text-white tracking-tight">#<?= htmlspecialchars($row['id']) ?></td>
                                <td class="px-6 py-5">
                                    <div class="text-white font-bold text-sm"><?= htmlspecialchars($row['customer_name'] ?? 'Guest') ?></div>
                                    <span class="bg-slate-950 px-2 py-0.5 rounded-lg border border-slate-800 text-[10px] text-slate-400">ID User: <?= htmlspecialchars($row['user_id'] ?? '-') ?></span>
                                </td>
                                <td class="px-6 py-5 text-xs text-slate-300 space-y-1">
                                    <div>In: <b class="text-white"><?= !empty($row['check_in']) ? date('d M Y', strtotime($row['check_in'])) : '-' ?></b></div>
                                    <div>Out: <b class="text-white"><?= !empty($row['check_out']) ? date('d M Y', strtotime($row['check_out'])) : '-' ?></b></div>
                                </td>
                                <td class="px-6 py-5 font-bold text-emerald-400">Rp <?= number_format(($row['total_price'] ?? 0), 0, ',', '.') ?></td>
                                <td class="px-6 py-5 text-center"><span class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-1.5 rounded-xl text-xs font-black uppercase"><?= htmlspecialchars($row['status'] ?? 'Success') ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($tab_aktif === 'kamar'): ?>
        <div class="bg-slate-900/40 backdrop-blur-xl rounded-[2rem] shadow-xl border border-slate-800/80 overflow-hidden">
            <div class="p-6 md:p-8 bg-slate-900/80 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h2 class="text-lg font-black text-white uppercase tracking-wider italic">Inventaris Kamar Grand Hotel</h2>
                <button onclick="openKamarModal('add')" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-5 py-2.5 rounded-xl font-bold hover:from-emerald-600 hover:to-teal-700 transition duration-300 text-sm flex items-center gap-2 shadow-lg">
                    <i class="fas fa-plus"></i> Tambah Kamar Baru
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/80 border-b border-slate-800">
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Kamar</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tipe Kamar</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga / Malam</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        <?php if(empty($rooms)): ?>
                            <tr><td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada data kamar di database.</td></tr>
                        <?php else: ?>
                            <?php foreach ($rooms as $room): ?>
                            <tr class="hover:bg-slate-850/40 transition duration-300">
                                <td class="px-6 py-5 font-black text-white tracking-tight">Room <?= htmlspecialchars($room['room_number']) ?></td>
                                <td class="px-6 py-5"><span class="bg-slate-950 px-3 py-1.5 rounded-lg border border-slate-800 text-xs text-slate-300"><?= htmlspecialchars($room['room_type']) ?></span></td>
                                <td class="px-6 py-5 font-bold text-emerald-400">Rp <?= number_format($room['price'], 0, ',', '.') ?></td>
                                <td class="px-6 py-5 text-center">
                                    <span class="<?= strtolower($room['status']) == 'available' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border-amber-500/20' ?> border px-4 py-1.5 rounded-xl text-xs font-black uppercase">
                                        <?= htmlspecialchars($room['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center flex items-center justify-center gap-2">
                                    <button onclick="openKamarEditModal(<?= htmlspecialchars(json_encode($room)) ?>)" class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-2 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition duration-200">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button onclick="confirmKamarDelete(<?= $room['id'] ?>)" class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-2 rounded-xl text-xs font-bold hover:bg-rose-600 hover:text-white transition duration-200">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div id="kamarModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden">
            <div class="p-6 bg-slate-950 border-b border-slate-800 flex justify-between items-center">
                <h3 id="modalKamarTitle" class="text-base font-black text-white uppercase tracking-wider italic">Tambah Kamar</h3>
                <button onclick="closeKamarModal()" class="text-slate-400 hover:text-white"><i class="fas fa-times text-lg"></i></button>
            </div>
            <form action="" method="POST" class="p-6 space-y-4">
    <input type="hidden" name="action_kamar" id="formKamarAction" value="create_kamar">
    <input type="hidden" name="id_kamar" id="formKamarId" value="">
    
    <div>
        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Nomor Kamar</label>
        <input type="text" name="room_number" id="formRoomNumber" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white">
    </div>
    
    <div>
        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tipe Kamar</label>
        <select name="room_type" id="formRoomType" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white">
            <option value="Standard">Standard</option>
            <option value="Deluxe Suite">Deluxe Suite</option>
            <option value="Presidential Suite">Presidential Suite</option>
        </select>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Harga</label>
        <select name="price" id="formPrice" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white">
            <option value="500000">Rp 500.000</option>
            <option value="1500000">Rp 1.500.000</option>
            <option value="3200000">Rp 3.200.000</option>
        </select>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Status Ketersediaan</label>
        <select name="status" id="formStatus" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white">
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select>
    </div>

    <div class="pt-2">
        <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white py-3.5 rounded-xl font-bold">Simpan Data Kamar</button>
    </div>
</form>
        </div>
    </div>

    <script>
        const kModal = document.getElementById('kamarModal');
        function openKamarModal(type) {
            kModal.classList.remove('hidden');
            kModal.classList.add('flex');
            if(type === 'add') {
                document.getElementById('modalKamarTitle').innerText = "Tambah Kamar Baru";
                document.getElementById('formKamarAction').value = "create_kamar";
            }
        }
        function openKamarEditModal(room) {
            openKamarModal('edit');
            document.getElementById('modalKamarTitle').innerText = "Edit Data Kamar";
            document.getElementById('formKamarAction').value = "update_kamar";
            document.getElementById('formKamarId').value = room.id;
            document.getElementById('formRoomNumber').value = room.room_number;
            document.getElementById('formRoomType').value = room.room_type;
            document.getElementById('formPrice').value = room.price;
            document.getElementById('formStatus').value = room.status;
        }
        function closeKamarModal() {
            kModal.classList.remove('flex');
            kModal.classList.add('hidden');
        }
        function confirmKamarDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus kamar ini secara permanen?")) {
                window.location.href = "admin_dashboard.php?tab=kamar&action_kamar=delete&id_kamar=" + id;
            }
        }
    </script>
</body>
</html>