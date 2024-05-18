<?php
include_once("../templates/header.php");
include_once("../templates/footer.php");

$transaction_id = $_GET['transaction_id'];

$db = new PDO('sqlite:../database/database.db');

$stmt = $db->prepare("SELECT * FROM Transaction_ WHERE transaction_id = :transaction_id");
$stmt->bindParam(':transaction_id', $transaction_id);
$stmt->execute();
$transaction = $stmt->fetch(PDO::FETCH_ASSOC);

print_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Form</title>
    <link rel="stylesheet" href="print.css">
    <link rel="stylesheet" href="shippingform.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your print-friendly CSS here */
    </style>
</head>
<body>
    <img id="printlogo" src="../docs/TechTudo_logo.png" alt="Logo">
    <h1>Shipping Form</h1>
    <div id="transactionDetails">
    <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($transaction['transaction_id']); ?></p>
    <p><strong>Ad ID:</strong> <?php echo htmlspecialchars($transaction['ad_id']); ?></p>
    <p><strong>Seller Username:</strong> <?php echo htmlspecialchars($transaction['seller_username']); ?></p>
    <p><strong>Buyer Username:</strong> <?php echo htmlspecialchars($transaction['buyer_username']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($transaction['address']); ?></p>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($transaction['transaction_date']); ?></p>
    </div>

<?php print_footer(); ?>
</body>
</html>