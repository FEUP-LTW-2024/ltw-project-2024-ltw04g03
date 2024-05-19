<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    die('User not logged in');
}

function fetch_user_info($username) {
    $pdo = new PDO('sqlite:../database/database.db');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT name, username, email, profile_image FROM User WHERE username = :username");

    $stmt->bindParam(':username', $username);

    $stmt->execute();

    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach ($user_info as $key => $value) {
        $user_info[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    return $user_info;
}
?>