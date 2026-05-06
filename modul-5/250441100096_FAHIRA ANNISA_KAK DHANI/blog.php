<?php
$articles = [
    "Belajar HTML Pertama Kali " => [
        "date" => "2026-03-30",
        "content" => "Pengalaman pertama belajar HTML cukup menantang. Awalnya bingung dengan tag-tag dasar, tapi setelah mencoba membuat halaman sederhana, mulai terasa seru. Dari sini saya belajar bahwa setiap baris kode punya peran penting dalam membentuk tampilan web.",
        "image" => "gambar_html.png",
        "link" => "https://developer.mozilla.org/en-US/docs/Web/HTML"
    ],
    "Error Pertama  " => [
        "date" => "2024-02-10",
        "content" => "Error pertama saat coding membuat frustasi, tapi akhirnya jadi pelajaran berharga untuk debugging.",
        "image" => "gambar_error.png",
        "link" => "https://stackoverflow.com/"
    ],
    "Membuat Website Sederhana  " => [
        "date" => "2026-04-07",
        "content" => "Menyelesaikan website sederhana memberi rasa puas dan motivasi untuk belajar lebih dalam. Walaupun tampilannya masih sederhana,
         proses membuat struktur, menambahkan CSS, dan menguji hasilnya sangat menyenangkan. Website pertama ini menjadi titik awal untuk terus berkembang dan mencoba teknologi baru.",
        "image" => "gambar_website.png",
        "link" => "https://www.w3schools.com/"
    ]
];


$quotes = [
    "Coding itu seni, bukan sekadar logika.",
    "Setiap error adalah guru terbaik.",
    "Belajar konsisten lebih penting daripada belajar cepat.",
    "Jangan takut gagal, takutlah kalau tidak mencoba."
];

$selected = $_GET['article'] ?? null;


$randomQuote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog Reflektif Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #f9f9f9);
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .nav {
            text-align: center;
            margin-bottom: 30px;
        }

        .nav a {
            display: inline-block;
            margin: 0 10px;
            padding: 8px 14px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        .nav a:hover {
            background: #2980b9;
            transform: translateY(-3px);
        }

        .article {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .article:hover {
            transform: scale(1.02);
        }

        .article h2 {
            color: #3498db;
            margin-bottom: 10px;
        }

        .article small {
            color: #777;
            display: block;
            margin-bottom: 15px;
        }

        .article img {
            max-width: 100%;
            border-radius: 8px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .article a {
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
        }

        .article a:hover {
            text-decoration: underline;
        }

        .quote {
            font-style: italic;
            color: #2c3e50;
            background: #eaf6ff;
            padding: 15px;
            border-left: 5px solid #3498db;
            margin: 30px auto;
            max-width: 600px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Blog Reflektif Developer</h1>

<div class="nav">
    <?php foreach ($articles as $title => $data): ?>
        <a href="?article=<?= urlencode($title) ?>"><?= $title ?></a>
    <?php endforeach; ?>
</div>

<?php if ($selected && isset($articles[$selected])): ?>
    <div class="article">
        <h2><?= $selected ?></h2>
        <small>Tanggal Posting: <?= $articles[$selected]['date'] ?></small>
        <p><?= $articles[$selected]['content'] ?></p>
        <img src="<?= $articles[$selected]['image'] ?>" alt="<?= $selected ?>">
        <p><a href="<?= $articles[$selected]['link'] ?>" target="_blank">Referensi Tambahan</a></p>
    </div>
<?php endif; ?>


<div class="quote">
    <strong>Kutipan Hari Ini:</strong> "<?= $randomQuote ?>"
</div>

<div class= nav>
    <a href="timeline.php">Timeline</a> |
    <a href="index.php">Profil</a>
</div>

</body>
</html>


