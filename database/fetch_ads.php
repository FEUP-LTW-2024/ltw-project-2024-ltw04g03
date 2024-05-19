<?php
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT * FROM AD");
    $stmt->execute();

    $ads = $stmt->fetchAll();
    //$ads array now contains every fetched ad
?>