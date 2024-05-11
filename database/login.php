<?php
  session_start();

  if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $db = new PDO('sqlite:../database/database.db');

    if(!$db){
      header('Location: ../pagesHTML/LoginPage.php');
      $_SESSION['message'] = 'PROBLEMA NA BASE DE DADOS';
    }
    else{
      $query = "SELECT * FROM User WHERE username = :username AND password = :password";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $password);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
      $_SESSION['username'] = $username;
      $_SESSION['loggedin'] = true;
      $_SESSION['message'] = 'LOGIN SUCESSFUL';
      header('Location: ../pagesHTML/Mainpage.php');
      exit();
    } 
    else{
      header('Location: ../pagesHTML/LoginPage.php');
      $_SESSION['message'] = 'DADOS DE LOGIN INVÁLIDOS';
      
      exit();
    }
    }
  }
?>
