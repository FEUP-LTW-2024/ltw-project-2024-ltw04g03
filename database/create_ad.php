<?php
ini_set('session.cookie_httponly', 1);
// Check if the form is submitted
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    // Include your database connection code here
    $db = new PDO('sqlite:../database/database.db');
    

    // Prepare and bind parameters
    $stmt = $db->prepare("INSERT INTO AD (device_id, seller_username, brand, model, condition, location, price, image_path, description) VALUES (:device_id, :seller_username, :brand, :model, :condition, :location, :price, :image_path, :description)");
    $stmt->bindParam(':device_id', $device_id);
    $stmt->bindParam(':seller_username', $seller);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':condition', $condition);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':description', $description);

    // Set parameters from form data

    //Getting the model id
    $db2 = new SQLite3('../database/dabase.db');
    $stmt2 = $db2->prepare("SELECT id FROM model WHERE name = :modelName");
    $model = $_POST['model'];
    $stmt2->bindParam(':modelName', $model);
    $stmt2->execute;
    $device_id = $stmt2->fetchColumn();

    //change the user's role
    $stmt = $db->prepare("UPDATE User SET role = :role WHERE username = :username");
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':username', $seller);

    $role = 'seller';

    if ($stmt->execute()) {
        echo "User role updated to 'seller'.";
    } else {
        echo "Error updating user role.";
    }

    
    $seller = $_SESSION['username']; 
    $brand = $_POST['brand'];
    $model = $_POST['model']; 
    $condition = $_POST['condition'];
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);


    // Check if file is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Check file type
        $file_info = getimagesize($_FILES['image']['tmp_name']);
        if(!$file_info) {
            echo "Invalid file type.";
            exit();
        }

        // Check file size (max 6MB)
        if($_FILES['image']['size'] > 6000000) {
            echo "File is too large.";
            exit();
        }
        // Define upload directory and file name
        $upload_dir = "../uploads/";
        $upload_file = $upload_dir . basename($_FILES['image']['name']);

        // Move uploaded file to the specified directory
        if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            $image_path = $upload_file;
        } else {
            // Handle file upload error
            echo "Error uploading file.";
            header('Location: ../pagesHTML/NewAd.php');
            exit();
        }
    } else {
        // If no file is uploaded, set image_path to NULL or any default image path
        $image_path = null;
        
    }

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Ad created successfully.";
        unset($_SESSION['csrf_token']);
        header('Location: ../pagesHTML/Mainpage.php');
    } else {
        echo "Error creating ad.";
        header('Location: ../pagesHTML/NewAd.php');
    }
} else {
    $_SESSION['message'] = 'Invalid CSRF token';
    header('Location: ../pagesHTML/NewAd.php');
    exit();
}
?>