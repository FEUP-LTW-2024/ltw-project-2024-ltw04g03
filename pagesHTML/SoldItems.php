<?php
include_once("../templates/header.php");
include_once("../templates/footer.php");

// Connect to the database
$db = new PDO('sqlite:../database/database.db');

// Fetch the user information
$username1 = $_POST['username'];
?>
<?php
$stmt = $db->prepare("SELECT * FROM Transaction_ WHERE seller_username = :username");
$stmt->bindParam(':username', $username1);
$stmt->execute();
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sold Items</title>
    <link rel="stylesheet" href="SoldItems.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body class="profile-page">
<main>
    <div class="background">
        <div class="page-inner-content">
            <h1 class="section-title">Sold Items</h1>
            <div class="underline"></div>
            <div class="Products-row">
                <?php
                foreach ($transactions as $transaction) {
                    echo '<div class="Products">';
                    echo '<p>Transaction ID: ' . htmlspecialchars($transaction['transaction_id']) . '</p>';
                    echo '<p>Ad ID: ' . htmlspecialchars($transaction['ad_id']) . '</p>';
                    echo '<p>Seller: ' . htmlspecialchars($transaction['seller_username']) . '</p>';
                    echo '<p>Buyer: ' . htmlspecialchars($transaction['buyer_username']) . '</p>';
                    echo '<p>Address: ' . htmlspecialchars($transaction['address']) . '</p>';
                    echo '<p>Date: ' . htmlspecialchars($transaction['transaction_date']) . '</p>';
                    echo '<form action="shipping_form.php" method="get">';
                    echo '<input type="hidden" name="transaction_id" value="' . $transaction['transaction_id'] . '">';
                    echo '<button type="submit">Print Shipping Form</button>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php print_footer(); ?>
</body>
</html>