<?php
include_once("../database/model.class.php");

// Get the brand ID from the query string
$brandId = $_GET['brandId'];

// Fetch models by brand ID
$models = getModelsByBrand($brandId);

// Output model names
foreach ($models as $model) {
    echo $model['name'] . PHP_EOL; // Output each model name on a new line
}
?>
