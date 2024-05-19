<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ad_id'])) {

    if (!isset($_POST['form_id']) || !isset($_SESSION['csrf_token'][$_POST['form_id']])) {
        $_SESSION['message'] = 'Form ID is missing or invalid. Please try again.';
        header('Location: ../pagesHTML/UpdateAd.php');
        exit();
    }

    if (hash_equals($_SESSION['csrf_token'][$_POST['form_id']], $_POST['csrf_token'])) {

        $ad_id = filter_input(INPUT_POST, 'ad_id', FILTER_SANITIZE_NUMBER_INT);
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
        $condition = filter_input(INPUT_POST, 'condition', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $image_path = filter_input(INPUT_POST, 'current_image_path', FILTER_SANITIZE_STRING);

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $file_info = getimagesize($_FILES['image']['tmp_name']);
            if(!$file_info) {
                echo "Invalid file type.";
                exit();
            }
            if($_FILES['image']['size'] > 6000000) {
                echo "File is too large.";
                exit();
            }
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
        unset($_SESSION['csrf_token'][$_POST['form_id']]);
    } else {
        $_SESSION['message'] = 'CSRF token validation failed. Please try again.';
        header('Location: ../pagesHTML/EditAd.php');
        exit();
    }
}
?>
