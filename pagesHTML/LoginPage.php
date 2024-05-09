<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
    
    if (isset($_SESSION['message']))
    {
        echo "<div class='erro'>" . $_SESSION['message'] . "</div>";
    }
    unset($_SESSION['message']);
    ?>

<link rel="stylesheet" href="Login.css">


<form action="../database/login.php" method="post">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="" required>

    <input type="submit" value="Login">
</form>

<!-- to facilitate styling this will need to be changed (probably idk) -->
Don't have an account yet? <a href="RegisterPage.php">Create one!</a>

    <?php print_footer(); ?>
</body>
</html>
