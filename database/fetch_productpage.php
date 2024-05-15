<?php 
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details from the database
    $product_id = $_GET['id']; // Get the product ID from the URL
    $stmt = $pdo->prepare("SELECT ad.*, devices.released_at, devices.body, devices.os, devices.storage, devices.display_size, devices.display_resolution, devices.camera_pixels, devices.video_pixels, devices.ram, devices.chipset, devices.battery_size, devices.battery_type, devices.specifications
                          FROM ad 
                          JOIN devices ON ad.device_id = devices.id 
                          WHERE ad.id = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();

    $product = $stmt->fetch();

?> 