<?php 
    include_once("../templates/header.php");
    include_once("../templates/footer.php");
    print_header();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['username'])){
        Header('Location:../pagesHTML/LoginPage.php');
    }
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
   <?php/* if(!$_SERVER["REQUEST_METHOD"] == "POST"){
        $_POST['id'] = $_GET['id'];
   } */?>

    <div class="product-details">
        <?php
        include_once("../database/fetch_productpage.php");

        echo '<div class="ad-container">';
        echo '<img src="' . htmlspecialchars($product['image_path']) . '" alt="' . $product['brand'] . ' ' . $product['model'] . '" style="max-height:800px;">';
        echo '<h1>' . $product['brand'] . ' ' . $product['model'] . '</h1>';
        echo '<p><span class="attribute">Description:</span> ' . htmlspecialchars($product['description']) . '</p>';
        echo '<p><span class="attribute">Condition:</span> ' . $product['condition'] . '</p>';
        echo '<p><span class="attribute">Price:</span> ' . htmlspecialchars($product['price']) . '$' . '</p>';
        echo '<p><span class="attribute">Location:</span> ' . htmlspecialchars($product['location']) . '</p>';
        echo '<p><span class="attribute">Seller:</span> 
        <a id="seller-link" href="ProfilePage.php?username=' . $product['seller_username'] . '">' . htmlspecialchars($product['seller_username']) . '</a></p>';

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

        if (isset($_SESSION['username'])) {
            $in_cart = 'false';
            if(!isset($_SESSION['cart']) OR empty($_SESSION['cart'])){
                $in_cart = 'false';
            }
            else{
                foreach($_SESSION['cart'] as $cart){
                    if($cart['ad_id'] == $product['ad_id']){
                        $in_cart = 'true';
                    }
                }
            }
            ?>
            
            
                <div class="button-container1">
            <form action="<?php echo ($in_cart == 'true') ? '../database/remove_from_cart.php' : '../database/shopping_cart.php'; ?>" method="post">
                <input type="hidden" name="product" value="<?php echo $product['brand'] . ' ' . $product['model']; ?>">
                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                <input type="hidden" name="ad_id" value="<?php echo $product['ad_id']; ?>">
                <input type="hidden" name="seller_username" value="<?php echo $product['seller_username']; ?>">
                <button type="submit" id="add-to-cart-button"><?php echo ($in_cart == 'true') ? 'Remove from Shopping Cart' : 'Add to Shopping Cart'; ?></button>
            </form>
        </div>
            <?php
        }
        if($_SESSION['username'] == $product['seller_username']){
            ?>
            <div class="button-container2">
            <form action="../pagesHTML/EditAd.php" method="post">
                    <input type="hidden" name="ad_id" value="<?php echo $product['ad_id']; ?>"> 
                    <button type="submit" id="delete-ad-button">Edit ad</button> 
                </form>
            </div>
            <?php  } 
        
        if($_SESSION['username'] == $product['seller_username'] OR $_SESSION['user_role'] == 'admin' ){
        ?>
        <div class="button-container2">

            <form action="../database/delete_ad.php" method="post">
                <input type="hidden" name="ad_id" value="<?php echo $product['ad_id']; ?>"> 
                <button type="submit" id="delete-ad-button">Delete ad</button> 
            </form>
        </div>
        <?php  } ?>

    </div>

<?php print_footer(); ?>
</body>
</html>