<?php 
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    session_start();
    print_header();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTudo - <?php echo $product['brand'] . ' ' . $product['model']; ?></title>
    <link rel="stylesheet" href="ProductPage.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="product-page">
    <div class="product-details">
        <?php
        include_once("../database/fetch_productpage.php");

        echo '<div class="ad-container">';
        echo '<img src="' . htmlspecialchars($product['image_path']) . '" alt="' . $product['brand'] . ' ' . $product['model'] . '">';
        echo '<h1>' . $product['brand'] . ' ' . $product['model'] . '</h1>';
        echo '<p><span class="attribute">Description:</span> ' . $product['description'] . '</p>';
        echo '<p><span class="attribute">Condition:</span> ' . $product['condition'] . '</p>';
        echo '<p><span class="attribute">Price:</span> ' . $product['price'] . '</p>';
        echo '<p><span class="attribute">Seller:</span> ' . $product['seller_username'] . '</p>';
        echo '</div>';
        echo '<div class="attributes-container">';
        echo '<h2 class="specifications">Specifications</h2>';
        echo '<p><span class="attribute">Released at:</span> ' . $product['released_at'] . '</p>';
        echo '<p><span class="attribute">Body:</span> ' . $product['body'] . '</p>';
        echo '<p><span class="attribute">OS:</span> ' . $product['os'] . '</p>';
        echo '<p><span class="attribute">Storage:</span> ' . $product['storage'] . '</p>';
        echo '<p><span class="attribute">Display Size:</span> ' . $product['display_size'] . '</p>';
        echo '<p><span class="attribute">Display Resolution:</span> ' . $product['display_resolution'] . '</p>';
        echo '<p><span class="attribute">Camera Pixels:</span> ' . $product['camera_pixels'] . '</p>';
        echo '<p><span class="attribute">Video Pixels:</span> ' . $product['video_pixels'] . '</p>';
        echo '<p><span class="attribute">RAM:</span> ' . $product['ram'] . '</p>';
        echo '<p><span class="attribute">Chipset:</span> ' . $product['chipset'] . '</p>';
        echo '<p><span class="attribute">Battery Size:</span> ' . $product['battery_size'] . '</p>';
        echo '<p><span class="attribute">Battery Type:</span> ' . $product['battery_type'] . '</p>';
        echo '<p><span class="attribute">Specifications:</span> ' . $product['specifications'] . '</p>';
        echo '</div>';
        
        if($_SESSION['username'] == $product['seller_username'] ){//OR $User['role'] == 'admin'
        ?>
        <div class="button-container">
            <form action="../database/delete_ad.php" method="post">
                <input type="hidden" name="ad_id" value="<?php echo $product['ad_id']; ?>"> 
                <button type="submit">Delete ad</button> <!-- still not sending the id but ill do that when the permissions are fixed-->
            </form>
        </div>
        <?php  } ?>
    </div>

<?php print_footer(); ?>
</body>
</html>