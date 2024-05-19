<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: LoginPage.php");
    exit();
}

function update_user_info($name, $email, $password) {
    // Connect to the database
    $pdo = new PDO('sqlite:../database/database.db');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $sql = "UPDATE User SET name = :name, email = :email";
    if ($password !== null) {
        // Hash the password before storing it
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password = :password";
    }
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        // Check if the uploaded file is an image
        if (exif_imagetype($_FILES['profile_image']['tmp_name'])) {
            // Move the uploaded file to the profile_images directory
            $profile_image = '../docs/profile_images/' . basename($_FILES['profile_image']['name']);
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
            
            // Append profile_image to the SQL query
            $sql .= ", profile_image = :profile_image";
        }
    }




    $sql .= " WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':profile_image', $_POST['profile_image']);
    if ($password !== null) {
        $stmt->bindParam(':password', $password);
    }
    if (isset($profile_image)) {
        $stmt->bindParam(':profile_image', $profile_image);
    }


    // Execute the SQL statement
    $stmt->execute();

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['form_id']) || !isset($_SESSION['csrf_token'][$_POST['form_id']])) {
        $_SESSION['message'] = 'Form ID is missing or invalid. Please try again.';
        header('Location: ../pagesHTML/ProfilePage.php');
        exit();
    }

    if (hash_equals($_SESSION['csrf_token'][$_POST['form_id']], $_POST['csrf_token'])) {

        // Get form data
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];

        update_user_info($name, $email, $password);

        // Unset the CSRF token for this form ID
        unset($_SESSION['csrf_token'][$_POST['form_id']]);
    } else {
        $_SESSION['message'] = 'Ups... something went wrong. Please try again.';
        header('Location: ../pagesHTML/ProfilePage.php');
        exit();
    }
}

header("Location: ../pagesHTML/ProfilePage.php?username=" . urlencode($_SESSION['username']));
exit();
?>