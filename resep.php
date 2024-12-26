<?php
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'resepmakanan');
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Periksa apakah ID tersedia
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM recipes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resep = $result->fetch_assoc();
    } else {
        echo "Resep tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Latar belakang biru muda yang lembut */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #fdf5e6; /* Latar belakang putih */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
            margin-top: 40px;
        }
        h1 {
            font-size: 2.2em;
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }
        img {
            border-radius: 12px;
            max-width: 100%;
            height: auto;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            font-size: 1.5em;
            color: #2c3e50;
            margin-top: 30px;
            font-weight: 600;
        }
        p {
            font-size: 1.1em;
            color: #7f8c8d;
            line-height: 1.6;
        }
        .btn-secondary {
            background-color: #27ae60;
            color: white;
            font-size: 1.1em;
            padding: 12px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-secondary:hover {
            background-color: #2ecc71;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 1.2em;
            color: #95a5a6;
        }
        footer a {
            color: #2980b9;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($resep['title']) ?></h1>
        <img src="<?= htmlspecialchars($resep['image']) ?>" alt="<?= htmlspecialchars($resep['title']) ?>" class="img-fluid d-block mx-auto mb-4">

        
        <div class="section-description">
            <h2 class="section-title">Deskripsi</h2>
            <p><?= nl2br(htmlspecialchars($resep['description'])) ?></p>
        </div>

        <div class="section-ingredients">
            <h2 class="section-title">Bahan-Bahan</h2>
            <p><?= nl2br(htmlspecialchars($resep['ingredients'])) ?></p>
        </div>

        <div class="section-steps">
            <h2 class="section-title">Cara Memasak</h2>
            <p><?= nl2br(htmlspecialchars($resep['steps'])) ?></p>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Resep</a>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Tim Masak. Semua hak dilindungi.</p>
    </footer>
</body>
</html>
