<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    $db = new PDO('sqlite:../database/database.db');

    // Prepare and bind parameters
    $stmt = $db->prepare("INSERT INTO AD (seller_username, brand, model, condition, location, price, image_path, description) VALUES (:seller_username, :brand, :model, :condition, :location, :price, :image_path, :description)");
    $stmt->bindParam(':seller_username', $seller);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':condition', $condition);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':description', $description);

    // Set parameters from form data
    $seller = $_SESSION['username']; //não está a registar o username não sei pq
    $brand = $_POST['brand'];
    $model = 'default'; //to be changed later
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
