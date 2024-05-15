<?php 
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details from the database
    if (!isset($_POST['username'])) {
        die('Username not set');
    }
    $seller_username = $_POST['username']; // Get the product ID from the URL
    $stmt = $pdo->prepare("SELECT ad.*, user.id AS user_id, User.role AS User_role
                          FROM ad 
                          JOIN User ON ad.seller = User.username 
                          WHERE ad.seller = :username");
    $stmt->bindParam(':username', $seller_username);
    $stmt->execute();

    $seller = $stmt->fetch();

?> 