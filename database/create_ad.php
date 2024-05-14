<?php
// Check if the form is submitted
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    

    $seller = $_SESSION['username']; 
    $brand = $_POST['brand'];
    $model = $_POST['model']; 
    $condition = $_POST['condition'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];
  

    // Check if file is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
        header('Location: ../pagesHTML/Mainpage.php');
    } else {
        echo "Error creating ad.";
        header('Location: ../pagesHTML/NewAd.php');
    }
}
?>