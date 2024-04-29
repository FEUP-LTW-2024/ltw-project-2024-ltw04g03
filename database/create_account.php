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
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Hash the password according to the slides
    $hashed_password = md5($password);

    // Prepare SQL statement to insert into the User table
    $stmt = $db->prepare("INSERT INTO User (name, username, password, email) VALUES (?, ?, ?, ?)");

    // Bind parameters and execute the statement
    //$stmt->bindParam($name, $username, $hashed_password, $email);
    $stmt->execute([$name, $username, $hashed_password, $email]);



    // Redirect to login page
    header("Location: ../pagesHTML/Login.html");
    exit();
}
?>

