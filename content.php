<?php

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'resepmakanan');
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

$user_id = $_SESSION['id'];

// Ambil semua resep
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);

// Ambil semua resep yang sudah di-Like oleh user
$sql_likes = "SELECT recipe_id FROM likes WHERE user_id = ?";
$stmt_likes = $conn->prepare($sql_likes);
$stmt_likes->bind_param("i", $user_id);
$stmt_likes->execute();
$liked_recipes = $stmt_likes->get_result()->fetch_all(MYSQLI_ASSOC);
$liked_recipes = array_column($liked_recipes, 'recipe_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <img src="image/main.jpg" alt="bg makanan">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .card {
            width: 250px; /* Tentukan lebar card agar kotak */
            height: 250px; /* Tentukan tinggi card agar kotak */
            margin: 10px auto; /* Berikan jarak di sekeliling card */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-img-top {
            height: 140px; /* Tentukan tinggi gambar agar sesuai dengan ukuran card */
            object-fit: cover; /* Gambar tetap proporsional */
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
        }

        .card-text {
            font-size: 14px;
            color: #555;
        }

        .like-btn {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="row text-center mt-4 mb-4 align-items-stretch gap-3">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md">
                <div class="card h-100">
                    <img src="<?= $row['image'] ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="<?= $row['title'] ?>">
                    

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><?= $row['title'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                        </div>
                        <button class="btn btn-primary mt-2" onclick="window.location.href='resep.php?id=<?= $row['id'] ?>'">
                        Lihat Resep
                         </button>
                        <button
                            class="btn like-btn mt-2 <?= in_array($row['id'], $liked_recipes) ? 'btn-danger' : 'btn-light' ?>"
                            data-recipe-id="<?= $row['id'] ?>">
                            <?= in_array($row['id'], $liked_recipes) ? '❤️ Unlike' : '🤍 Like' ?>
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".like-btn").on("click", function () {
            const button = $(this);
            const recipeId = button.data("recipe-id");
            const action = button.text().includes("Like") ? "like" : "unlike";

            $.ajax({
                url: "like2.php",
                method: "POST",
                data: { recipe_id: recipeId, action: action },
                success: function (response) {
                    if (response.success) {
                        if (action === "like") {
                            button.removeClass("btn-light").addClass("btn-danger").text("❤️ Unlike");
                        } else {
                            button.removeClass("btn-danger").addClass("btn-light").text("🤍 Like");
                        }
                    } else {
                        alert(response.message || "Terjadi kesalahan.");
                    }
                },
                error: function () {
                    alert("Terjadi kesalahan. Coba lagi.");
                }
            });
        });
    });
</script>
</body>
</html>
