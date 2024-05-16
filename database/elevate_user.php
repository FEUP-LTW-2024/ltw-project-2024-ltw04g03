<?php
session_start();

try {
    // Include your database connection code here
    $db2 = new PDO('sqlite:../database/database.db');
    $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the username is set
        if (isset($_POST['username'])) {
            $username = $_POST['username'];

            // Update user's role to 'admin'
            $stmt2 = $db2->prepare("UPDATE User SET role = 'admin' WHERE username = :username");
            $stmt2->bindValue(':username', $username);

            if ($stmt2->execute()) {
                echo "User role updated to 'admin'. estás logado como: " . $_SESSION['username'] . " e quem foi elevado foi: " . $_POST['username'];
                Header('Location:../pagesHTML/ProfilePage.php?username=' . urlencode($username));
            } else {
                echo "Error updating user role.";
                print_r($stmt2->errorInfo()); // Debugging information
            }
        } else {
            echo "Username not provided.";
        }
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
