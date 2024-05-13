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

<main>
    <div class="background">
        <div class="page-inner-content">
            <h1 class="section-title">Filtered Ads</h1>
            <div class="underline"></div>
            <div class="Products-row">
                <?php
                // Check if the brand is set in the URL parameters
                if(isset($_GET['brand'])) {
                    // Include database connection
                    $db = new PDO('sqlite:../database/database.db');
                    
                    // Fetch ads based on brand
                    $brand = $_GET['brand'];
                    $stmt = $db->prepare("SELECT * FROM ad WHERE brand = :brand");
                    $stmt->bindParam(':brand', $brand);
                    $stmt->execute();
                    $ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Display the fetched ads
                    foreach ($ads as $ad) {
                        echo '<div class="Products">';
                        echo '<p>ID: ' . $ad['id'] . '</p>';
                        echo '<p>Brand: ' . $ad['brand'] . '</p>';
                        echo '<p>Model: ' . $ad['model'] . '</p>';
                        echo '<p>Description: ' . $ad['description'] . '</p>';
                        echo '<p>Condition: ' . $ad['condition'] . '</p>';
                        echo '<p>Price: ' . $ad['price'] . '$' . '</p>';
                        echo '<p>Seller: ' . $ad['seller_username'] . '<p>'; 
                        echo '</div>';
                    }
                } else {
                    echo '<p>No brand selected.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php print_footer(); ?>
</body>
</html>
