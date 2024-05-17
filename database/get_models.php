<?php
// Include your database connection code here
$db = new PDO('sqlite:../database/database.db');

// Check if the brand ID parameter is provided
if(isset($_GET['brandId'])) {
    $brandId = $_GET['brandId'];
    //echo $brandId;

    // Prepare a statement to fetch models by brand ID
    $stmt = $db->prepare("SELECT name FROM models WHERE brand_id = :brandId");
    $stmt->bindParam(':brandId', $brandId);
    $stmt->execute();

    // Fetch model names
    $modelNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Output model names as JSON
    header('Content-Type: application/json');
    echo json_encode($modelNames);
} else {
    // Brand ID parameter not provided, return an error response
    http_response_code(400);
    echo json_encode(array("error" => "Brand ID parameter is missing"));
}
?>
