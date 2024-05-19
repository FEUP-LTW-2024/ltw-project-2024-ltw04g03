<?php
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT * FROM devices");
    $stmt->execute();

    $devices = $stmt->fetchAll();
    //$devices array now contains every fetched device
?>