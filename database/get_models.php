<?php
$db = new PDO('sqlite:../database/database.db');

if(isset($_GET['brandId'])) {
    $brandId = $_GET['brandId'];
    //echo $brandId;

    $stmt = $db->prepare("SELECT name FROM models WHERE brand_id = :brandId");
    $stmt->bindParam(':brandId', $brandId);
    $stmt->execute();

    $modelNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

    header('Content-Type: application/json');
    echo json_encode($modelNames);
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Brand ID parameter is missing"));
}
?>
