<?php
include_once("../database/model.class.php");

$brand = $_GET['brand'];
$models = getModelsByBrand($brand);

$modelNames = array();
foreach ($models as $model) {
    $modelNames[] = $model['model'];
}

echo json_encode($modelNames);
?>