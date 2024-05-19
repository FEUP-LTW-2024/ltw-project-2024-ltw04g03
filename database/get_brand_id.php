<?php
$db = new PDO('sqlite:../database/database.db');

$brandName = $_GET['brandName'];
//echo $brandName;

$stmt = $db->prepare("SELECT id FROM brands WHERE name = :brandName");
$stmt->bindParam(':brandName', $brandName);
$stmt->execute();
$result = $stmt->fetchColumn();

echo $result;
?>
