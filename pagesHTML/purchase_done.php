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
    <title>Purchase Done</title>
    <link rel="stylesheet" href="purchase_done.css">
    <link rel="stylesheet" href="style.css">
</head>
<body id="purchase-content">
    <img id="success-image" src="../docs/purchasedone.png" alt="Success Image">
    <h1 id="purchase-success-title">Your purchase was successfully done.</h1>
    <p id="purchase-success-message">Your product is on your way.</p>
</body>

<?php print_footer(); ?>
</html>