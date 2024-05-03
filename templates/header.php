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
            <img src="logo.png" alt="Logo do site">
            <h1>Nome do site</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Adicionar Item</a></li>
                <li><a href="#">Conta</a></li>
            </ul>
        </nav>
    </header>

<?php
}
?>