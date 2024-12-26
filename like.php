<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'resepmakanan');
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

$user_id = $_SESSION['id'];

// Ambil semua resep yang disukai user
$sql = "SELECT r.* FROM recipes r JOIN likes l ON r.id = l.recipe_id WHERE l.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Favorit Kamu</title> <!-- Judul yang lebih santai -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .container h1 {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            text-align: center;
            font-size: 2.2em;
            color: #ff6347;
            margin-bottom: 40px;
        }
        .card-title {
            font-size: 1.2em;
            font-weight: bold;
        }
        .card-text {
            color: #666;
        }
        .btn {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-4"> <!--  margin atas container -->
    <h1 class="text-center mb-4">Resep Favorit Kamu</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 text-center mb-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= $row['image'] ?>" class="card-img-top img-fluid" alt="<?= $row['title'] ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title"><?= $row['title'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                            <a href="resep.php?id=<?= $row['id'] ?>" class="btn btn-primary">Lihat Resep</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">Belum ada resep favorit yang disukai. Yuk, mulai sukai resep sekarang!</p>
        <?php endif; ?>
    </div>
</div>


</body>

</html>
