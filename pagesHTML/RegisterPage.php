<?php
    include_once("../templates/header.php")
?>
    <?php
    //everytime we want a message to appear the following code should be inserted
        print_header();
        if (isset($_SESSION['message']))
        {
            echo "<div class='erro'>" . $_SESSION['message'] . "</div>";
        }
        unset($_SESSION['message']);
        ?>
<form action="../database/create_account.php" method="post">
    <h2>Create Account</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Create Account">
</form>

Already have an account? <a href="LoginPage.php">Login</a>

</body>
</html>
