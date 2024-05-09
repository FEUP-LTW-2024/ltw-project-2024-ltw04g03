<?php
    declare(strict_types = 1);
    session_start();
function print_header() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- futuro arquivo em css -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            <a href="shoppingcart.html">Shopping Cart</a>
        </div>
    </header>

<?php
}
?>