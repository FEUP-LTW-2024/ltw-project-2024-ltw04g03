<?php
ini_set('session.cookie_httponly', 1);
session_start();
include_once("../templates/header.php");
include_once("../templates/footer.php");


// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: LoginPage.php");
    exit();
}

// Connect to the database
$db = new PDO('sqlite:../database/database.db');

// Fetch the user information
$username1 = $_GET['username'];
$stmt = $db->prepare("SELECT * FROM User WHERE username = :username");
$stmt->bindParam(':username', $username1);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

print_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="MainPage.css">
</head>
<body>
<main>
    <div class="background">
        <div class="page-inner-content">
            <h1 class="section-title">Profile</h1>
            <div class="profile-info">
                <?php if ($user) : ?>
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                <?php else : ?>
                    <p>User not found.</p>
                <?php endif; ?>
            </div>
            <?php if($_SESSION['username'] == $user['username']){ ?>
            <div class="button-container">
                <form action="../database/logout.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            </div>
            <?php } ?>

            <script>
                console.log("Username received: <?php echo htmlspecialchars($username1); ?>");
            </script>

            <?php
            include_once("../database/fetch_user_role.php"); ?>
            <script>
                console.log("Your role: <?php echo htmlspecialchars($_SESSION['user_role']); ?>");
            </script>
            <?php
            
             if($_SESSION['user_role'] == 'admin'){ ?>
                <div class="button-container">
                    <form action="../database/elevate_user.php" method="post">
                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username1); ?>">  
                        <button type="submit">Elevate user to Admin</button>
                    </form>
                </div>
            <?php } ?>

            
    <div class="background">
        <div class="page-inner-content">
            <h1 class="section-title">User's ads</h1>
            <div class="underline"></div>
            <div class="Products-row">
                <?php
                //unset($_SESSION['cart']); //not needed unless the reset isnt working
                include_once("../database/fetch_ads.php");
                // Loop through the fetched devices and display them
                foreach ($ads as $ad) {
                    if($ad['seller_username'] == $username1){
                    echo '<div class="Products">';
                    echo '<form id="productForm' . $ad['id'] . '" action="ProductPage.php" method="get">';
                    echo '<input type="hidden" name="id" value="' . $ad['id'] . '">';
                    echo '<input type="hidden" name="username" value="' . $ad['seller_username'] . '">';
                    echo '<a href="#" onclick="document.getElementById(\'productForm' . $ad['id'] . '\').submit();" class="Product-link">';
                    echo '<div>';
                    echo '<p>ID: ' . $ad['id'] . '</p>';
                    echo '<p>Brand: ' . $ad['brand'] . '</p>';
                    echo '<p>Model: ' . $ad['model'] . '</p>';
                    echo '<p>Description: ' . htmlspecialchars($ad['description']) . '</p>';
                    echo '<p class="Condition">Condition: ' . $ad['condition'] . '</p>';
                    echo '<p class="Price">Price: ' . htmlspecialchars($ad['price']) . '$' . '</p>';
                    echo '<p>Seller: ' . htmlspecialchars($ad['seller_username']) . '<p>'; 
                    echo '</div>';
                    echo '</a>';
                    echo '</form>';
                    echo '</div>';}
                }
                ?>
            </div>
        </div>
    </div>

   
        </div>
    </div>
</main>

<?php print_footer(); ?>
</body>
</html>
