<?php
ini_set('session.cookie_httponly', 1);
session_start();

// Reset session variables
$_SESSION['loggedin'] = false;
$_SESSION['username'] = null;

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: ../pagesHTML/Mainpage.php");
exit();
?>
