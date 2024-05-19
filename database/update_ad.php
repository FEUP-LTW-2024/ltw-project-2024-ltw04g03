<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ad_id'])) {
    $ad_id = $_POST['ad_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $image_path = $_POST['current_image_path'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = '../docs/uploads/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update the ad in the database
    $db = new SQLite3('../database/database.db');
    $stmt = $db->prepare('UPDATE AD SET brand = :brand, model = :model, description = :description, location = :location, condition = :condition, price = :price, image_path = :image_path WHERE id = :ad_id');

    $stmt->bindParam(':ad_id', $ad_id, SQLITE3_INTEGER);
    $stmt->bindParam(':brand', $brand, SQLITE3_TEXT);
    $stmt->bindParam(':model', $model, SQLITE3_TEXT);
    $stmt->bindParam(':description', $description, SQLITE3_TEXT);
    $stmt->bindParam(':location', $location, SQLITE3_TEXT);
    $stmt->bindParam(':condition', $condition, SQLITE3_TEXT);
    $stmt->bindParam(':price', $price, SQLITE3_FLOAT);
    $stmt->bindParam(':image_path', $image_path, SQLITE3_TEXT);

    if ($stmt->execute()) {
        header("Location: ../pagesHTML/Mainpage.php");
        exit;
    } else {
        echo "Error: Could not update ad.<br>";
        echo "SQLite Error: " . $db->lastErrorMsg() . "<br>";
    }
}
?>
