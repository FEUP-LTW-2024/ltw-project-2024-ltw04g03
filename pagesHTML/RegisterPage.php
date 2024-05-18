<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
?>
    <?php
    //everytime we want a message to appear the following code should be inserted
        print_header();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Generate a new form ID
        $form_id = bin2hex(random_bytes(32));

        // Generate a new CSRF token for this form
        $_SESSION['csrf_token'][$form_id] = bin2hex(random_bytes(32));

        if (isset($_SESSION['message']))
        {
            echo "<div class='erro'>" . $_SESSION['message'] . "</div>";
        }
        unset($_SESSION['message']);
        ?>

<link rel='stylesheet' href = 'CreateAccount.css'>
<link rel="stylesheet" href="style.css">

<form action="../database/create_account.php" method="post">
    <h2>Create Account</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="username">Username:</label>
    <p id="note">Note: Once set you cannot change it.</p>
    <input type="text" id="username" name="username" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'][$form_id]; ?>">
    <input type="submit" value="Create Account">
</form>

<div class="login-link">
    Already have an account? <a href="LoginPage.php">Login</a>
</div>

<?php print_footer(); ?>
</body>
</html>
