<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            
            background-color: #ffffff; 
            color: #333;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #333; 
            margin-bottom: 10px;
        }
        h2 {
            text-align: center;
            font-size: 2em;
            color: #ff6347; 
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fdf5e6; 
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #333; 
            text-align: center;
        }
        th {
            background-color: #fdf5e6; 
            color: #333; 
            font-size: 1.2em;
        }
        img {
            width: 120px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
        }
        .action-links a {
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            color: #333; 
            border: 1px solid #333; 
            border-radius: 5px;
            padding: 5px 10px;
            background-color: #ffffff; 
            transition: 0.3s ease-in-out;
            display: inline-block;
        }
        .action-links a:hover {
            background-color: #f0f0f0; 
            color: #333; 
            transform: scale(1.1); /* Animasi zoom */
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #8b4513; 
        }
        footer a {
            color: #333; 
            text-decoration: none;
            font-weight: bold;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?> 
    
<h1> Daftar Resep Menginspirasi </h1>
    <h2> Made with Love </h2> 
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Resep</th>
                <th>Bahan</th> 
                <th>Cara</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('database/inventory.php');
            $inventory = new Inventory();
            $products = $inventory->getAll();
            foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                        <?php else: ?>
                            <img src="placeholder.jpg" alt="No Image">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($product['name']); ?></td>
                    <td><?= nl2br(htmlspecialchars($product['bahan'])); ?></td> 
                    <td><?= nl2br(htmlspecialchars($product['cara'])); ?></td>
                    <td><?= htmlspecialchars($product['created_at']); ?></td>
                    <td><?= htmlspecialchars($product['updated_at']); ?></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?= $product['id']; ?>">Edit ✏️</a>
                        <a href="controller/inventory.php?action=delete&id=<?= $product['id']; ?>" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus 🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <footer>
        Dibuat dengan suka cita❤️ 
    </footer>
</body>
</html>
