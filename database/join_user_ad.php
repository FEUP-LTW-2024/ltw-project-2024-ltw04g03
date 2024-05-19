<?php 
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_POST['username'])) {
        die('Username not set');
    }
    $seller_username = $_POST['username'];
    $stmt = $pdo->prepare("SELECT ad.*, user.id AS user_id, User.role AS User_role
                          FROM ad 
                          JOIN User ON ad.seller = User.username 
                          WHERE ad.seller = :username");
    $stmt->bindParam(':username', $seller_username);
    $stmt->execute();

    $seller = $stmt->fetch();
?> 