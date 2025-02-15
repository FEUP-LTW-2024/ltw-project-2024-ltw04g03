<?php 
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
    
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTudo</title>
    <link rel="stylesheet" href="MainPage.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="main-page">
<main>
    <div class="background">
        <div class="page-inner-content">
            <h1 class="section-title">Hot Deals</h1>
            <div class="underline"></div>
            <div class="Products-row">
                <?php
                include_once("../database/fetch_ads.php");
                // Loop through the fetched devices and display them
                foreach ($ads as $ad) {
                    echo '<div class="Products">';
                    echo '<form id="productForm' . $ad['id'] . '" action="ProductPage.php" method="get">';
                    echo '<input type="hidden" name="id" value="' . $ad['id'] . '">';
                    echo '<input type="hidden" name="username" value="' . $ad['seller_username'] . '">';
                    echo '<a href="#" onclick="document.getElementById(\'productForm' . $ad['id'] . '\').submit();" class="Product-link">';
                    echo '<img src="' . htmlspecialchars($ad['image_path']) . '" alt="Product Image">';
                    echo '<div class="Product-details">';
                    echo '<p class="Model">Model: ' . htmlspecialchars($ad['model']) . '</p>';
                    echo '<p class="Condition">Condition: ' . htmlspecialchars($ad['condition']) . '</p>';
                    echo '<p class="Price">Price: ' . htmlspecialchars($ad['price']) . '$' . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</main>


<?php print_footer(); ?>
</body>
</html>
