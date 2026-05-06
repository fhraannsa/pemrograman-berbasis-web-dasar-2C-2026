<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Timeline Belajar Developer</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(135deg, #e3f2fd, #f9f9f9);
      margin: 0;
      padding: 30px;
      color: #333;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      font-size: 28px;
      margin-bottom: 30px;
    }

    .timeline {
      position: relative;
      margin: 20px auto;
      padding: 0;
      list-style: none;
      max-width: 600px;
    }

    .timeline li {
      margin: 30px 0;
      padding-left: 25px;
      border-left: 3px solid #3498db;
      position: relative;
      transition: all 0.3s ease;
    }

    .timeline li::before {
      content: "";
      position: absolute;
      left: -10px;
      top: 0;
      width: 20px;
      height: 20px;
      background: #3498db;
      border-radius: 50%;
      border: 3px solid #fff;
      box-shadow: 0 0 5px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .timeline li:hover {
      background: #f1f9ff;
      border-radius: 6px;
      padding-left: 30px;
    }

    .timeline li:hover::before {
      transform: scale(1.2);
      background: #2980b9;
    }

    .highlight {
      font-weight: bold;
      color: gray;
    }

    .nav {
      margin-top: 40px;
      text-align: center;
    }

    .nav a {
      display: inline-block;
      margin: 0 10px;
      padding: 10px 18px;
      background: #3498db;
      color: white;
      text-decoration: none;
      border-radius: 25px;
      font-weight: bold;
      transition: background 0.3s, transform 0.2s;
    }

    .nav a:hover {
      background: #2980b9;
      transform: translateY(-3px);
    }
  </style>
</head>
<body>

<h2>Timeline Belajar Developer</h2>

<?php

$riwayat = [
  ["tahun" => 2025, "kegiatan" => "Tahun masuk kuliah"],
  ["tahun" => 2026, "kegiatan" => "Mulai belajar HTML & CSS"],
  ["tahun" => 2026, "kegiatan" => "Proyek pertama: Membuat Website"],
  ["tahun" => 2026, "kegiatan" => "Belajar JavaScript & Tailwind CSS"],
  ["tahun" => 2026, "kegiatan" => "Mengerjakan aplikasi akademik dengan PHP & SQL"],
];

function highlightTahun($tahun, $teks) {
    $highlightYears = [2026];
    if (in_array($tahun, $highlightYears)) {
        return "<span class='highlight'>$tahun - $teks</span>";
    } else {
        return "$tahun - $teks";
    }
}

echo "<ul class='timeline'>";
foreach ($riwayat as $item) {
    echo "<li>".highlightTahun($item['tahun'], $item['kegiatan'])."</li>";
}
echo "</ul>";
?>

<div class="nav">
  <a href="index.php">Profil</a>
  <a href="blog.php">Blog Developer</a>
</div>

</body>
</html>
