<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    // Include your database connection code here
    $db2 = new PDO('sqlite:../database/database.db');
    $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $username = $_SESSION['username'];

            // Update user's role to 'seller'
            $stmt2 = $db2->prepare("UPDATE User SET role = 'seller' WHERE username = :username");
            $stmt2->bindValue(':username', $username);

            if ($stmt2->execute()) {
                echo "User role updated to 'seller'. estás logado como: " . $_SESSION['username'] . " e quem foi elevado foi: " . $_SESSION['username'];
                //Header('Location:../pagesHTML/ProfilePage.php?username=' . urlencode($username));
            } else {
                echo "Error updating user role.";
                print_r($stmt2->errorInfo()); // Debugging information
            }
         
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
