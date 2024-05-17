<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: ../pagesHTML/LoginPage.php");
    exit();
}

// Connect to the database
$db = new PDO('sqlite:../database/database.db');

// Loop through each item in the cart
foreach($_SESSION['cart'] as $cart){
    // Check if ad id is provided
    if (!isset($cart['ad_id'])) {
        echo "No ad ID provided.";
        //exit();
    }

    // Get the ad id from the request
    $ad_id = $cart['ad_id'];

    try {
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
}
//unset($_SESSION['cart']);
?>
