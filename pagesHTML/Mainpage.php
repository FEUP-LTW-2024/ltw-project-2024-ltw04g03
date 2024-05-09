
<?php include_once ("../templates/footer.php"); ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TechTudo </title>
    <link rel="stylesheet" href="MainPage.css"> 
</head>
<body>
    <header>
        <div class="logo">
            <img src="../docs/TechTudo_logo.png" alt="Logo do site">
            <a href="ShoppingCart.php">Shopping Cart</a>
        </div>
        <div class="filter-bar">
            <form>
                <label for="brand">Brand:</label>
                <select id="brand">
                    <option value="all">All brands</option>
                    <option value = "Samsung">Samsung</option>
                    <option value = "Xiaomi">Xiaomi</option>
                    <option value = "Apple">Apple</option>
                    <option value="Google">Google</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Nokia">Nokia</option>
                    <option value="Microsoft">Microsoft</option>
                    <option value="Oppo">Oppo</option>
                </select>
                <label for="model">Year:</label>
                <select id="model">
                    <option value="all">All years</option>
                </select>
                <label for="megapixels">Storage:</label>
                <select id="megapixels">
                    <option value="all">All</option>
                    <option value="512">512GB</option>
                    <option value="256">256GB</option>
                    <option value="128">128GB</option>
                    <option value="64">64GB</option>
                    <option value="32">32GB</option>
                    <option value="8">8GB</option>
                </select>
                <label for="price">Memory RAM:</label>
                <select id="price">
                    <option value="all">All</option>
                    <option value="16">16GB</option>
                    <option value="12">12GB</option>
                    <option value="8">8GB</option>
                    <option value="6">6GB</option>
                    <option value="4">4GB</option>
                    <option value="3">3GB</option>
                    <option value="2">2GB</option>
                    <option value="1">1GB</option>
                </select>
                <label for="display">Display:</label>
                <select id="display">
                    <option value="all">All displays</option>
                    <option value="4+">4-5 inches</option>
                    <option value="5+">5-6 inches</option>
                    <option value="6+">6-7 inches</option>
                    <option value="7+">7-8 inches</option>
                    <option value="8+">8+ inches</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>
        <div class="account">
            <a href="LoginPage.php">Login/Register</a>
            <a href="notifications.html">Notifications</a> <!-- Notifications button -->
        </div>
    </header>

<!-- Para ser revisto -->
    <main>
        <div class="background">
            <div class="page-inner-content">
                <h1 class="section-title">Hot Deals</h1>
                <div class="underline"></div>
                <div class="Products-row">
                    <?php
                    // Gera links para os produtos de 1 a 6
                    for ($i = 1; $i <= 6; $i++) {
                        echo '<a href="pagina_produto_' . $i . '.php" class="Product-link">';
                        echo '<div class="Products">';
                        echo '<p class="SellersName">Vendedor ' . $i . '</p>'; //Nome do vendedor
                        echo '<img src="Produto_' . $i . '" alt="" />'; //Nome do produto
                        echo '<p class="Price">EURO</p> <span>EURO</span>'; //Preço do Produto
                        echo '<p class="Estado">Condição do Produto</p>'; //Condição do Produto
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
