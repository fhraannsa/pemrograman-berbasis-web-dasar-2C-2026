<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Interaktif Developer Pemula</title>
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
      margin-bottom: 20px;
      font-size: 28px;
      letter-spacing: 1px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    th {
      background: #3498db;
      color: #fff;
      padding: 12px;
      text-transform: uppercase;
      font-size: 14px;
      letter-spacing: 0.5px;
    }

    td {
      text-align: center;
      padding: 12px;
      border-bottom: 1px solid #eee;
    }

    tr:hover {
      background: #f1f9ff;
    }

    form {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 650px;
      margin: auto;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      color: #2c3e50;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: border 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
      border-color: #3498db;
      outline: none;
      box-shadow: 0 0 5px rgba(52,152,219,0.3);
    }

    input[type="checkbox"],
    input[type="radio"] {
      margin-right: 8px;
      accent-color: #3498db;
    }

    input[type="submit"] {
      background: #3498db;
      color: #fff;
      border: none;
      padding: 12px 24px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background 0.3s, transform 0.2s;
    }

    input[type="submit"]:hover {
      background: #2980b9;
      transform: scale(1.05);
    }

    nav {
      text-align: center;
      margin-top: 30px;
    }

    nav a {
      text-decoration: none;
      color: #3498db;
      margin: 0 20px;
      font-weight: bold;
      font-size: 16px;
      transition: color 0.3s, border-bottom 0.3s;
      padding-bottom: 4px;
    }

    nav a:hover {
      color: #2980b9;
      border-bottom: 2px solid #2980b9;
    }

    p {
      margin-top: 12px;
      font-size: 15px;
    }

    p[style*="color:red"] {
      background: #ffe5e5;
      padding: 10px;
      border-radius: 6px;
    }

    p[style*="color:blue"] {
      background: #e5f3ff;
      padding: 10px;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<h2>Profil Interaktif Developer Pemula</h2>
<div>
<table border="1">
  <tr>
    <td>Nama</td>
    <td>Fahira Annisa</td>
  </tr>
  <tr>
    <td>ID Developer</td>
    <td>25-096</td>
  </tr>
  <tr>
    <td>Kota/Tgl Lahir</td>
    <td>Sampang, 12-08-2007</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>fahirann6@gmail.com</td>
  </tr>
  <tr>
    <td>No. WhatsApp</td>
    <td>0812-4626-3069</td>
  </tr>
</table>
</div>

<hr>
<form method="POST" action="" class= "p-4 mb-6">
  <label>Framework/Tools yang dikuasai:</label><br>
  <input type="text" name="framework"><br><br>

  <label>Cerita singkat pengalaman:</label><br>
  <textarea name="pengalaman" rows="4" cols="50"></textarea><br><br>

  <label>Tools Penunjang:</label><br>
  <input type="checkbox" name="tools[]" value="VS Code"> VS Code
  <input type="checkbox" name="tools[]" value="GitHub"> GitHub
  <input type="checkbox" name="tools[]" value="Figma"> Figma
  <input type="checkbox" name="tools[]" value="Postman"> Postman<br><br>

  <label>Minat Bidang:</label><br>
  <input type="radio" name="minat" value="Frontend"> Frontend
  <input type="radio" name="minat" value="Backend"> Backend
  <input type="radio" name="minat" value="Fullstack"> Fullstack<br><br>

  <label>Tingkat Skill Coding:</label><br>
   <select name="skill">
      <option value="">Pilih</option>
      <option value="Dasar">Dasar</option>
      <option value="Cukup">Cukup</option>
      <option value="Profesional">Profesional</option>
  </select>
  <br><br>
  <input type="submit" name="submit" value="Kirim">
</form>
</section>

<hr>

<?php

function tampilkanData($frameworks, $pengalaman, $tools, $minat, $skill) {
    echo "<h2>Hasil Input</h2>";
    echo "<table class='data-table'>
            <tr>
              <th>Framework/Tools</th>
              <th>Tools Penunjang</th>
              <th>Minat Bidang</th>
              <th>Tingkat Skill</th>
            </tr>
            <tr>
              <td>".implode("/ ", $frameworks)."</td>
              <td>".implode("/ ", $tools)."</td>
              <td>$minat</td>
              <td>$skill</td>
            </tr>
          </table>";
    echo "<p><b>Pengalaman:</b> $pengalaman</p>";
}


if (isset($_POST['submit'])) {
    $frameworkInput = trim($_POST['framework']);
    $pengalaman = trim($_POST['pengalaman']);
    $tools = isset($_POST['tools']) ? $_POST['tools'] : [];
    $minat = isset($_POST['minat']) ? $_POST['minat'] : "";
    $skill = $_POST['skill'];

    if ($frameworkInput == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
        echo "<p style='color:red;'>Semua input wajib diisi!</p>";
    } else {
        
        $frameworks = explode(",", $frameworkInput);

        tampilkanData($frameworks, $pengalaman, $tools, $minat, $skill);

         if (count($frameworks) > 2) {
            echo "<p style='color:blue;'> Skill Anda cukup luas di bidang development!</p>";
        }
    }
}
?>
<nav>
  <a href="timeline.php">Timeline</a>
  <a href="blog.php">Blog Developer</a>
</nav>

</body>
</html>