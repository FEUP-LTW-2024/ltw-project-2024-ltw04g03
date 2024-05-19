<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_id = $_POST['ad_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['ad_id'] == $ad_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
}

header("Location: ../pagesHTML/ProductPage.php?id=$ad_id");
?>