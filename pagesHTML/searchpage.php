
<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="searchpage.css"> <!-- futuro arquivo em css -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            <a href="shoppingcart.html">Shopping Cart</a>
        </div>
        <div class="filter-bar">
            <form>
                <label for="brand">Brand:</label>
                <select id="brand">
                    <option value="all">All brands</option>
                </select>
                <label for="model">Year:</label>
                <select id="model">
                    <option value="all">All years</option>
                </select>
                <label for="megapixels">Storage:</label>
                <select id="megapixels">
                    <option value="all">All</option>
                </select>
                <label for="price">Memory:</label>
                <select id="price">
                    <option value="all">All</option>
                </select>
                <label for="display">Display:</label>
                <select id="display">
                    <option value="all">All displays</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>
        <div class="account">
            <a href="login.html">Login/Register</a> <!-- Login/Register button -->
            <a href="notifications.html">Notifications</a> <!-- Notifications button -->
        </div>
    </header>

    <div class="search">
        <label>[Applied Filter]</label>
        <label>Filter by:</label>
        <form>
            <label for="price">Price:</label>
            <select id="price">
                <option value="price">All</option>
            </select>
            <label for="condition">Condition:</label>
            <select id="condition">
                <option value="price">All</option>
            <select>
        </form>
    </div>

    <?php print_footer(); ?>

</body>
</html>