<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: ../pagesHTML/LoginPage.php");
    exit();
}

?> <script>console.log('The id passed is: ' $_POST['ad_id'])
console.log('and in the cart: '$_SESSION['cart']['ad_id'])  </script> 
<?php
if (!isset($_POST['ad_id'])) {
    echo "No ad ID provided.";
    exit();
}


$ad_id = $_POST['ad_id'];
$seller_username = $_POST['seller_username'];
echo "Received seller_username: " . $seller_username;
$buyer_username = $_SESSION['username'];
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

try {
    $db = new PDO('sqlite:../database/database.db');

    $db->beginTransaction();
    $stmt = $db->prepare("INSERT INTO Transaction_ (ad_id, seller_username, buyer_username, address, transaction_date) VALUES (:ad_id, :seller_username, :buyer_username, :address, :transaction_date)");
    $stmt->execute(['ad_id' => $ad_id, 'seller_username' => $seller_username, 'buyer_username' => $buyer_username, 'address' => $address, 'transaction_date' => date('Y-m-d H:i:s')]);

    $stmt = $db->prepare("DELETE FROM AD WHERE id = :id");
    $stmt->bindParam(':id', $ad_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Ad deleted successfully.";
    } else {
        echo "Error deleting ad.";
    }

    $db->commit();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: ../pagesHTML/Mainpage.php");
?>
