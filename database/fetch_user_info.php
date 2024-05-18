<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    die('User not logged in');
}

function fetch_user_info($username) {
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT name, username, email FROM User WHERE username = :username");

    // Bind the parameters
    $stmt->bindParam(':username', $username);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch the user's information
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    // Escape any special characters in the output
    foreach ($user_info as $key => $value) {
        $user_info[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    return $user_info;
}
?>