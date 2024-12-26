<?php
// Pastikan file yang menghubungkan ke model atau database sudah dimuat
require_once('database/Inventory.php');

// Cek jika ID diterima dari URL
$id = $_GET['id'] ?? null;
if ($id) {
    $data = new Inventory();
    $item = $data->show($id);  // Ambil data berdasarkan ID
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Menangani error jika data tidak ada
if (!$item) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-primary {
            background-color: #FF5722; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #E64A19; 
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit resep</h2>
            <form action="controller/inventory.php?action=update&id=<?= $item['id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?= $item['image']; ?>">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Masukkan Foto Baru (Opsional)</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Resep</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $item['name']; ?>" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Bahan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bahan" required><?= $item['bahan']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Cara</label>
                    <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="cara" required><?= $item['cara']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Update</button>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
