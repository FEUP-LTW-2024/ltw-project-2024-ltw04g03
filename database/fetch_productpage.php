<?php 
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details from the database
    $product_id = $_GET['id']; // Get the product ID from the URL
    $stmt = $pdo->prepare("SELECT * FROM AD WHERE id = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();

    $product = $stmt->fetch();

    // Fetch device details from the devices table
    $device_id = $_GET['id']; // Get the device ID from the URL
    $stmt = $pdo->prepare("SELECT * FROM devices WHERE id = :id");
    $stmt->bindParam(':id', $device_id);
    $stmt->execute();

    $device = $stmt->fetch();

    // Merge product and device details into one array
    $product = array_merge($product, $device);

?> 