<?php
include_once("../database/model.class.php");
header('Content-Type: application/json');


$brandid = $_GET['brandId'];

$models = getModelsByBrand($brandid);

$modelNames = array();
foreach ($models as $model) {
    $modelNames[] = $model['name'];
}

var_dump($modelNames);

echo json_encode($modelNames);
?>