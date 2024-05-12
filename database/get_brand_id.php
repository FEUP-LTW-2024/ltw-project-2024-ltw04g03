<?php
// Connect to your database
$db = new PDO('sqlite:../database/database.db');

// Get the brand name from the query string
$brandName = $_GET['brandName'];
echo $brandName;

// Prepare a statement to fetch the brand ID
$stmt = $db->prepare("SELECT id FROM brands WHERE name = :brandName");
$stmt->bindParam(':brandName', $brandName);
$stmt->execute();
$result = $stmt->fetchColumn();

// Return the brand ID
echo $result;
?>
