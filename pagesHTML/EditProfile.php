<?php
include_once("../templates/header.php");
include_once("../templates/footer.php");

print_header();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: LoginPage.php");
    exit();
}

$form_id = bin2hex(random_bytes(32));
$_SESSION['csrf_token'][$form_id] = bin2hex(random_bytes(32));

include_once("../database/fetch_user_info.php");
$user_info = fetch_user_info($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editprofile.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 id="editProfileTitle">Edit Profile</h1>

<form id="editProfileForm" action="../database/update_user_info.php" method="post">
    <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'][$form_id]; ?>">

    <label id="usernameLabel">Username:</label>
    <p><?php echo htmlspecialchars($user_info['username']); ?></p>

    <label for="editProfileName">Name:</label>
    <input type="text" id="editProfileName" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>">

    <label for="editProfileEmail">Email:</label>
    <input type="email" id="editProfileEmail" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>">

    <label for="editProfilePassword">Password:</label>
    <input type="password" id="editProfilePassword" name="password">

    <button id="editProfileSubmit" type="submit">Save Changes</button>
</form>
<?php print_footer(); ?>
</body>
</html>