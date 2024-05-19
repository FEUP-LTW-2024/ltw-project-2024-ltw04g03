<?php 
    $pdo = new PDO('sqlite:../database/database.db');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $product_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT ad.*, ad.id AS ad_id, devices.id AS device_id, devices.released_at, devices.body, devices.os, devices.storage, devices.display_size, devices.display_resolution, devices.camera_pixels, devices.video_pixels, devices.ram, devices.chipset, devices.battery_size, devices.battery_type, devices.specifications
                          FROM ad 
                          JOIN devices ON ad.device_id = devices.id 
                          WHERE ad.id = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();

    $product = $stmt->fetch();
?> 