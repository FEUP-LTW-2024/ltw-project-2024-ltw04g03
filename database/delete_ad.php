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

try {
    $db = new PDO('sqlite:../database/database.db');

    $stmt = $db->prepare("DELETE FROM AD WHERE id = :id");
    $stmt->bindParam(':id', $ad_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Ad deleted successfully.";
    } else {
        echo "Error deleting ad.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: ../pagesHTML/Mainpage.php");
?>
