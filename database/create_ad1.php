<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../database/database.php');

// Include the script to fetch the device ID
include_once('../database/fetch_device_id.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    
    // Set the model to 'Redmi 9'
    $model = 'Redmi 9';

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = '../uploads/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Error uploading image.";
            exit;
        }
    }

    // Fetch seller username from session
    if (!isset($_SESSION['username'])) {
        echo "User not logged in.";
        exit;
    }
    $seller_username = $_SESSION['username'];

    // Fetch device_id from fetch_device_id.php
    $device_id = null;  // Initialize $device_id variable to avoid potential issues
    include('../database/fetch_device_id.php');

    if (!$device_id) {
        echo "Device ID could not be retrieved.";
        exit;
    }

    // Create a new SQLite3 instance and open the database
    $db = new SQLite3('../database/database.db');

    // Prepare the SQL statement
    $stmt = $db->prepare('INSERT INTO AD (device_id, seller_username, brand, model, condition, location, price, image_path, description) VALUES (:device_id, :seller_username, :brand, :model, :condition, :location, :price, :image_path, :description)');

    // Bind parameters
    $stmt->bindValue(':device_id', $device_id, SQLITE3_INTEGER);
    $stmt->bindValue(':seller_username', $seller_username, SQLITE3_TEXT);
    $stmt->bindValue(':brand', $brand, SQLITE3_TEXT);
    $stmt->bindValue(':model', $model, SQLITE3_TEXT);
    $stmt->bindValue(':condition', $condition, SQLITE3_TEXT);
    $stmt->bindValue(':location', $location, SQLITE3_TEXT);
    $stmt->bindValue(':price', $price, SQLITE3_FLOAT);
    $stmt->bindValue(':image_path', $image_path, SQLITE3_TEXT);
    $stmt->bindValue(':description', $description, SQLITE3_TEXT);

    // Retry logic for database locked error
    $max_retries = 5;
    $retry_count = 0;
    $retry_delay = 100; // Milliseconds

    while ($retry_count < $max_retries) {
        try {
            if ($stmt->execute()) {
                // Redirect to main page on success
                header("Location: ../pagesHTML/Mainpage.php");
                exit;
            } else {
                throw new Exception($db->lastErrorMsg());
            }
        } catch (Exception $e) {
            if ($db->lastErrorCode() == 5) { // SQLITE_BUSY error code
                $retry_count++;
                usleep($retry_delay * 1000); // Convert to microseconds
            } else {
                // Display detailed error information
                echo "Error: Could not create ad.<br>";
                echo "SQLite Error: " . $e->getMessage() . "<br>";
                echo "Device ID: " . htmlspecialchars($device_id) . "<br>";
                echo "Seller Username: " . htmlspecialchars($seller_username) . "<br>";
                echo "Brand: " . htmlspecialchars($brand) . "<br>";
                echo "Model: " . htmlspecialchars($model) . "<br>";
                echo "Condition: " . htmlspecialchars($condition) . "<br>";
                echo "Location: " . htmlspecialchars($location) . "<br>";
                echo "Price: " . htmlspecialchars($price) . "<br>";
                echo "Image Path: " . htmlspecialchars($image_path) . "<br>";
                echo "Description: " . htmlspecialchars($description) . "<br>";
                exit;
            }
        }
    }

    // If we exhausted retries
    echo "Error: Could not create ad after $max_retries retries due to database lock.<br>";
    echo "Device ID: " . htmlspecialchars($device_id) . "<br>";
    echo "Seller Username: " . htmlspecialchars($seller_username) . "<br>";
    echo "Brand: " . htmlspecialchars($brand) . "<br>";
    echo "Model: " . htmlspecialchars($model) . "<br>";
    echo "Condition: " . htmlspecialchars($condition) . "<br>";
    echo "Location: " . htmlspecialchars($location) . "<br>";
    echo "Price: " . htmlspecialchars($price) . "<br>";
    echo "Image Path: " . htmlspecialchars($image_path) . "<br>";
    echo "Description: " . htmlspecialchars($description) . "<br>";
}
?>
