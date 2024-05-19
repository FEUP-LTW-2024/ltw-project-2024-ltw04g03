<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['loggedin'] = false;
$_SESSION['username'] = null;

session_destroy();

header("Location: ../pagesHTML/Mainpage.php");
exit();
?>
