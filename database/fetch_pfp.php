<?php
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT profile_image FROM User WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username'] );
    $stmt->execute();

    $profile_image = $stmt->fetchColumn();
    //echo $profile_image;
?>