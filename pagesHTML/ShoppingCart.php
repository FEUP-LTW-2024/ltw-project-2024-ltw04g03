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
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shoppingcart.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="shopping-cart">
    <h1>Shopping Cart</h1>


    <div class="selected-items">
        <h2>Selected Items</h2>

        <ul>

            <li>Item Name - Price</li>
        </ul>
    </div>


    <div class="total-price-items">
        <h2>Price of Items</h2>
        <p>$0</p> 
    </div>


    <div class="shipping-price">
        <h2>Shipping Costs</h2>
        <p>$0</p> <!-- Mudar consuante a distância ao remetente  -->
    </div>

    <div class="item-price+shipping-price">
        <h2>Total Cost</h2>
        <p>$0</p> <!--Soma dos dois em cima-->
    </div>


    <div class="checkout-form">
        <h2>Payment Information</h2>
        <form>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="debit-card">Debit card Number:</label>
            <input type="text" id="debit-card" name="debit-card" maxlength="16" required>

            <label for="CVV/CVC">CVV/CVC:</label>
            <input type="text" id="CVV/CVC" name="CVV/CVC" maxlength = "3" required>


            <button type="submit">Finalize Purchase</button>
        </form>
    </div>

<?php print_footer(); ?>
</body>
</html>