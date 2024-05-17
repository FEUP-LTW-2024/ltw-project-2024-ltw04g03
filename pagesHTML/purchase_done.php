<?php
    include_once("../templates/header.php");
    include_once("../templates/footer.php");

    print_header();
    session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Done</title>
    <link rel="stylesheet" href="purchase_done.css">
    <link rel="stylesheet" href="style.css">
</head>
<body id="purchase-content">
    <script>console.log('I get here!')</script>
    <?php
        //delete all the ads bought and reset the session cart 
        //include_once('../database/delete_ad.php');
        foreach ($_SESSION['cart'] as $cart) {
            echo "<script>
                var adId = '{$cart['ad_id']}';
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../database/delete_ad.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Ad deleted successfully');
                        // Optionally, handle the response here
                    }
                };
                xhr.send('ad_id=' + adId);
            </script>";
}
        
        unset($_SESSION['cart']);
    ?>
<script>console.log('and here!')</script>
    
    <img id="success-image" src="../docs/purchasedone.png" alt="Success Image">
    <h1 id="purchase-success-title">Your purchase was successfully done.</h1>
    <p id="purchase-success-message">Your product is on your way.</p>

</body>

<?php print_footer(); ?>
</html>