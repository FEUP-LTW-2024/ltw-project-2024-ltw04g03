<?php
function fetchDeviceId($model) {
    $db3 = new PDO('sqlite:../database/database.db');

    $stmt3 = $db3->prepare("SELECT id FROM models WHERE name = :modelName");

    $stmt3->bindParam(':modelName', $model);

    $stmt3->execute();

    return $stmt3->fetchColumn();
}
?>
