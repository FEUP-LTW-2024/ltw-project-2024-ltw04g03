<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST['csrf_token'])){

    if (!isset($_POST['form_id']) || !isset($_SESSION['csrf_token'][$_POST['form_id']])) {
      $_SESSION['message'] = 'Form ID is missing or invalid. Please try again.';
      header('Location: ../pagesHTML/RegisterPage.php');
      exit();
    }

    //check CSRF token
    if (hash_equals($_SESSION['csrf_token'][$_POST['form_id']], $_POST['csrf_token'])) {
      $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
      $password = $_POST["password"];
      $db = new PDO('sqlite:../database/database.db');

      if(!$db){
          header('Location: ../pagesHTML/LoginPage.php');
          $_SESSION['message'] = 'PROBLEMA NA BASE DE DADOS';
      }
      else{
          $query = "SELECT * FROM User WHERE username = :username";
          $stmt = $db->prepare($query);
          $stmt->bindParam(':username', $username);
          $stmt->execute();
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          if($user && password_verify($password, $user['password'])){
              $_SESSION['username'] = $username;
              $_SESSION['loggedin'] = true;
              $_SESSION['message'] = 'LOGIN SUCCESSFUL';
              header('Location: ../pagesHTML/Mainpage.php');

              exit();
          } 
          else{
              header('Location: ../pagesHTML/LoginPage.php');
              $_SESSION['message'] = 'INVALID LOGIN CREDENTIALS';
              exit();
          }
      }
      unset($_SESSION['csrf_token'][$_POST['form_id']]);
    } else {
        $_SESSION['message'] = 'Ups... something went wrong. Please try again.';
        header('Location: ../pagesHTML/LoginPage.php');
        exit();
    }
  }
?>
