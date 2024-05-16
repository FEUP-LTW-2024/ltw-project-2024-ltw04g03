<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

    $db = new PDO('sqlite:../database/database.db');

    // Get form data
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); //hash the password
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $role = 'user';


    if($db){
    $query= "SELECT * FROM User WHERE username = :user";
    $result = $db->query($query);
    $result->bindParam(':user', $username);
    $result->execute();
    $username2 = $result->fetchAll(PDO::FETCH_ASSOC);

    if($username2){
        header('Location: ../pagesHTML/RegisterPage.php');
        $_SESSION['message'] = 'USERNAME EXISTENTE';
        $db = NULL;
    }
    else{
    // Prepare SQL statement to insert into the User table
    $stmt = $db->prepare("INSERT INTO User (name, username, password, email, role) VALUES (?, ?, ?, ?, ?)");

    $stmt->execute([$name, $username, $hashed_password, $email, $role]);

    unset($_SESSION['csrf_token']);

    header("Location: ../pagesHTML/LoginPage.php");
    }
}
    else{
        header('Location: ../pagesHTML/RegisterPage.php');
        $_SESSION['message'] = 'PROBLEMA NA BASE DE DADOS
        ';
    }
} else {
    $_SESSION['message'] = 'Ups... something went wrong. Please try again.';
    header('Location: ../pagesHTML/RegisterPage.php');
    exit();
}
?>

