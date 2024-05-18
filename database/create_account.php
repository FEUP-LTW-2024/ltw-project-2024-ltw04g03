<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['form_id']) || !isset($_SESSION['csrf_token'][$_POST['form_id']])) {
        $_SESSION['message'] = 'Form ID is missing or invalid. Please try again.';
        header('Location: ../pagesHTML/RegisterPage.php');
        exit();
    }

    if (hash_equals($_SESSION['csrf_token'][$_POST['form_id']], $_POST['csrf_token'])) {

        $db = new PDO('sqlite:../database/database.db');

        // Get form data
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); //hash the password
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        //attribute the role of admin to ricardo
        if($username == 'ricardo'){ 
            $role = 'admin';
        }else{
            $role = 'user';
        }

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

                header("Location: ../pagesHTML/LoginPage.php");
            }
        }
        else{
            header('Location: ../pagesHTML/RegisterPage.php');
            $_SESSION['message'] = 'PROBLEMA NA BASE DE DADOS';
        }

        // Unset the CSRF token for this form ID
        unset($_SESSION['csrf_token'][$_POST['form_id']]);
    } else {
        $_SESSION['message'] = 'Ups... something went wrong. Please try again.';
        header('Location: ../pagesHTML/RegisterPage.php');
        exit();
    }
}
?>