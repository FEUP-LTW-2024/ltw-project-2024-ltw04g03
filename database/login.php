<?php
  ini_set('session.cookie_httponly', 1);
  session_start();

  // Generate CSRF token
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }

  if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST['csrf_token'])){
    // Check CSRF token
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
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
              unset($_SESSION['csrf_token']);
              header('Location: ../pagesHTML/Mainpage.php');
              exit();
          } 
          else{
              header('Location: ../pagesHTML/LoginPage.php');
              $_SESSION['message'] = 'DADOS DE LOGIN INVÁLIDOS';
              exit();
          }
      }
    } else {
        header('Location: ../pagesHTML/LoginPage.php');
        $_SESSION['message'] = 'INVALID CSRF TOKEN';
        exit();
    }
  }
?>
