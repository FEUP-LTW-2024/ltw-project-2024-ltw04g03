<?php
include_once("../database/model.class.php");

$brandId = $_GET['brandId'];

$models = getModelsByBrand($brandId);

foreach ($models as $model) {
    echo $model['name'] . PHP_EOL;
}
?>
