<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (!isset($_SESSION['username'])) {
    die('User not logged in');
}

$pdo = new PDO('sqlite:../database/database.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT role FROM user WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found');
}

$_SESSION['user_role'] = $user['role'];
?>
