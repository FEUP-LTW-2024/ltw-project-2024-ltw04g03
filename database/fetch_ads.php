<?php
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT * FROM AD");
    $stmt->execute();

    $ads = $stmt->fetchAll();
    //$ads array now contains every fetched ad
