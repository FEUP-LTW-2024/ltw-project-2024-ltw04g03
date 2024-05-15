<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: ../pagesHTML/LoginPage.php");
    exit();
}

// Check if ad id is provided
if (!isset($_POST['ad_id'])) {
    echo "No ad ID provided.";
    exit();
}

// Get the ad id from the request
$ad_id = $_POST['ad_id'];

try {
    // Connect to the database
    $db = new PDO('sqlite:../database/database.db');

    // Prepare SQL DELETE statement
    $stmt = $db->prepare("DELETE FROM AD WHERE id = :id");
    $stmt->bindParam(':id', $ad_id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Ad deleted successfully.";
    } else {
        echo "Error deleting ad.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: ../pagesHTML/Mainpage.php");
?>
