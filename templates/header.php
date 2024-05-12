<?php
    declare(strict_types = 1);
    session_start();
function print_header() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techtudo</title>
    <link rel="stylesheet" href="../pagesHTML/style.css">
</head>
<header>
        <div class="logo">
            <a href="Mainpage.php">
                <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            </a>
            <a href="ShoppingCart.php">Shopping Cart</a>
        </div>
        <div class="filter-bar">
            <form action="searchpage.php" method="GET">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="all">All brands</option>
                    <option value = "Samsung">Samsung</option>
                    <option value = "Xiaomi">Xiaomi</option>
                    <option value = "Apple">Apple</option>
                    <option value="Google">Google</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Nokia">Nokia</option>
                    <option value="Microsoft">Microsoft</option>
                    <option value="Oppo">Oppo</option>
                </select>
                <label for="released_at">Year:</label>
                <select id="released_at" name="released_at">
                    <option value="all">All years</option>
                </select>
                <label for="megapixels">Storage:</label>
                <select id="megapixels" name="megapixels">
                    <option value="all">All</option>
                    <option value="512">512GB</option>
                    <option value="256">256GB</option>
                    <option value="128">128GB</option>
                    <option value="64">64GB</option>
                    <option value="32">32GB</option>
                    <option value="8">8GB</option>
                </select>
                <label for="price">Memory RAM:</label>
                <select id="price" name="price">
                    <option value="all">All</option>
                    <option value="16">16GB</option>
                    <option value="12">12GB</option>
                    <option value="8">8GB</option>
                    <option value="6">6GB</option>
                    <option value="4">4GB</option>
                    <option value="3">3GB</option>
                    <option value="2">2GB</option>
                    <option value="1">1GB</option>
                </select>
                <label for="display">Display:</label>
                <select id="display" name="display">
                    <option value="all">All displays</option>
                    <option value="4+">4-5 inches</option>
                    <option value="5+">5-6 inches</option>
                    <option value="6+">6-7 inches</option>
                    <option value="7+">7-8 inches</option>
                    <option value="8+">8+ inches</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>
        <div class="account">
            <?php if($_SESSION['loggedin']){ ?>
                <a href="NewAd.php">New ad</a>
            <?php } ?>
            <a href="LoginPage.php">Login/Register</a>
            <a href="notifications.html">Notifications</a> <!-- Notifications button -->
        </div>
</header>
<?php
}
?>