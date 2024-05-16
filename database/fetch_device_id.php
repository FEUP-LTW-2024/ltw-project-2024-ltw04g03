<?php
// Include your database connection code here
$db3 = new PDO('sqlite:../database/database.db');

// Prepare the SQL statement to fetch the device ID
$stmt3 = $db3->prepare("SELECT id FROM models WHERE name = :modelName");

// Set the model name
$model = "Redmi 9"; // You can replace this with the actual model name

// Bind the model name parameter
$stmt3->bindParam(':modelName', $model);

// Execute the query
$stmt3->execute();

// Fetch the device ID
$device_id = $stmt3->fetchColumn();

// Output the device ID
//echo $device_id;
?>
