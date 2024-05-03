<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    //require_once "db_connection.php";

    $db = new PDO('sqlite:../database/database.db');

    // Get form data
    $name = $_POST["name"];
    $username = $_POST["username"];
    $hashed_password = md5($_POST["password"]); //hash the password
    $email = $_POST["email"];


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
    $stmt = $db->prepare("INSERT INTO User (name, username, password, email) VALUES (?, ?, ?, ?)");


    // Bind parameters and execute the statement
    //$stmt->bindParam($name, $username, $hashed_password, $email);
    $stmt->execute([$name, $username, $hashed_password, $email]);
    header("Location: ../pagesHTML/Login.html");
    }
}
    else{
        header('Location: ../pagesHTML/RegisterPage.php');
        $_SESSION['message'] = 'PROBLEMA NA BASE DE DADOS
        ';
    }



    
}
?>

