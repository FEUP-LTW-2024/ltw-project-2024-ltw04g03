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
    <link rel="stylesheet" href="shoppingcart.css"> <!-- futuro arquivo em css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Shopping Cart</h1>


    <div class="selected-items">
        <h2>Itens Selecionados</h2>

        <ul>

            <li>Nome do Item - Preço</li>
        </ul>
    </div>


    <div class="total-price-items">
        <h2>Preço dos items</h2>
        <p>$0</p> 
    </div>


    <div class="shipping-price">
        <h2>Preço do Transporte</h2>
        <p>$0</p> <!-- Mudar consuante a distância ao remetente  -->
    </div>

    <div class="item-price+shipping-price">
        <h2>Preço Total</h2>
        <p>$0</p> <!--Soma dos dois em cima-->
    </div>


    <div class="checkout-form">
        <h2>Informações de Pagamento</h2>
        <form>
            <label for="address">Morada:</label>
            <input type="text" id="address" name="address" required>

            <label for="debit-card"> Número do Cartão de Débito:</label>
            <input type="text" id="debit-card" name="debit-card" maxlength="16" required>

            <label for="CVV/CVC">CVV/CVC</label>
            <input type="text" id="CVV/CVC" name="CVV/CVC" maxlength = "3" required>


            <button type="submit">Finalizar Compra</button>
        </form>
    </div>

<?php print_footer(); ?>
</body>
</html>
