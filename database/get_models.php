<?php
include_once("../database/model.class.php");

$brandid = $_GET['brandId'];

$models = getModelsByBrand($brandid);

$modelNames = array();
foreach ($models as $model) {
    $modelNames[] = $model['name'];
}

var_dump($modelNames);

echo json_encode($modelNames);
?>