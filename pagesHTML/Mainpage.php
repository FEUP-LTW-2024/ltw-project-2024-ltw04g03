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
<body>
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
                    //echo '<a href="pagina_produto_' . $device['id'] . '.php" class="Product-link">';
                    echo '<div class="Products">';
                    echo '<p>ID: ' . $ad['id'] . '</p>';
                    echo '<p>Brand: ' . $ad['brand'] . '</p>';
                    echo '<p>Model: ' . $ad['model'] . '</p>';
                    echo '<p>Description: ' . $ad['description'] . '</p>';
                    echo '<p class="Condition">Condition: ' . $ad['condition'] . '</p>';
                    echo '<p class="Price">Price: ' . $ad['price'] . '$' . '</p>';
                    echo '<p>Seller: ' . $ad['seller_username'] . '<p>'; 
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php print_footer(); ?>
</body>
</html>
