<?php
function fetchDeviceId($model) {
    // Include your database connection code here
    $db3 = new PDO('sqlite:../database/database.db');

    // Prepare the SQL statement to fetch the device ID
    $stmt3 = $db3->prepare("SELECT id FROM models WHERE name = :modelName");

    // Bind the model name parameter
    $stmt3->bindParam(':modelName', $model);

    // Execute the query
    $stmt3->execute();

    // Fetch the device ID
    return $stmt3->fetchColumn();
}
?>
