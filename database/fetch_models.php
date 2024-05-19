<?php
    $db = new PDO('sqlite:../database/database.db');

    //$brand = $_POST['brand'];

    $stmt = $db->prepare("SELECT model FROM devices WHERE brand = :brand");
    //$stmt->bindParam(':brand', $brand);
    $stmt->execute();

    $models = $stmt->fetchAll();
    //$models array now contains every fetched device
?>
