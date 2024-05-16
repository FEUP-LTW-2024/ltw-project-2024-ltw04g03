<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo "User is not logged in.";
    exit();
}

// Check if user's role is already 'seller'
if ($_SESSION['role'] === 'seller') {
    echo "User's role is already 'seller'.";
    exit();
}

// Update user's role to 'seller'
$db2 = new PDO('sqlite:../database/database.db');
$stmt2 = $db2->prepare("UPDATE User SET role = 'seller' WHERE username = :username");
$stmt2->bindParam(':username', $_SESSION['username']);

if ($stmt2->execute()) {
    echo "User role updated to 'seller'.";
} else {
    echo "Error updating user role.";
}
?>
