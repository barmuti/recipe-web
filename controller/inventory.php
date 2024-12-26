<?php
include '../database/inventory.php';

$inventory = new Inventory();
$action = $_GET['action'] ?? null;

if ($action == "store") {
    session_start();
    if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['id'])) {
        die("Silakan login untuk mengunggah resep.");
    }

    $user_id = $_SESSION['id'];
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $imageName = basename($_FILES['image']['name']);
            $imagePath = '../uploads/' . $imageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $image = $imageName;
            } else {
                die('Error: Gagal mengupload gambar.');
            }
        } else {
            die('Error: File yang diunggah bukan gambar.');
        }
    }

    $inventory->store(
        $user_id,
        $image,
        $_POST['name'],
        $_POST['bahan'],
        $_POST['cara']
    );
    header("location:../crud.php");
    exit;
}

if ($action == "delete") {
    $inventory->delete($_GET['id']);
    header("location:../crud.php");
    exit;
}

if ($action == "update") {
    $image = $_POST['old_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $imageName = basename($_FILES['image']['name']);
            $imagePath = '../uploads/' . $imageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $image = $imageName;
            }
        }
    }

    $inventory->update(
        $_GET['id'],
        $image,
        $_POST['name'],
        $_POST['bahan'],
        $_POST['cara']
    );
    header("location:../crud.php");
    exit;
}
?>