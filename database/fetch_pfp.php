<?php
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT profile_image FROM User WHERE username = :username");
    $stmt->bindParam(':username', $username );
    $stmt->execute();

    $profile_image = $stmt->fetchColumn();
    if (!$profile_image) {
        $profile_image = '../docs/profile_images/default_pfp.jpg'; // default image
    }
    //echo $profile_image;
?>