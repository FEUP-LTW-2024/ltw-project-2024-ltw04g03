<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['form_id']) || !isset($_SESSION['csrf_token'][$_POST['form_id']])) {
        $_SESSION['message'] = 'Form ID is missing or invalid. Please try again.';
        header('Location: ../pagesHTML/NewAd.php');
        exit();
    }

    if (hash_equals($_SESSION['csrf_token'][$_POST['form_id']], $_POST['csrf_token'])) {
        $db = new PDO('sqlite:../database/database.db');
        
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

        include_once('../database/fetch_device_id.php'); //should automatically get device_id   

        //include_once('../database/update_user_role');
        ?><script>console.log('and here!')</script><?php
        echo "<script>console.log('Device ID: " . $device_id . "');</script>"; 

        $seller = $_SESSION['username'];
        $brand = $_POST['brand'];
        $model = $_POST['model']; 
        $condition = $_POST['condition'];
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);


        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file_info = getimagesize($_FILES['image']['tmp_name']);
            if(!$file_info) {
                echo "Invalid file type.";
                exit();
            }

            if($_FILES['image']['size'] > 6000000) {
                echo "File is too large.";
                exit();
            }
            
            $upload_dir = "../uploads/";
            $upload_file = $upload_dir . basename($_FILES['image']['name']);

            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
                $image_path = $upload_file;
            } else {
                echo "Error uploading file.";
                header('Location: ../pagesHTML/NewAd.php');
                exit();
            }
        } else {
            $image_path = null;
            
        }

        ?><script>console.log('i reached here!')</script><?php
        if ($stmt->execute()) {
            echo "Ad created successfully.";
            unset($_SESSION['csrf_token']);
            header('Location: ../pagesHTML/Mainpage.php');
        } else {
            echo "Error creating ad.";
            header('Location: ../pagesHTML/NewAd.php');
        }
        unset($_SESSION['csrf_token'][$_POST['form_id']]);
    } else {
        $_SESSION['message'] = 'Invalid CSRF token';
        header('Location: ../pagesHTML/NewAd.php');
        exit();
    }
}
?>