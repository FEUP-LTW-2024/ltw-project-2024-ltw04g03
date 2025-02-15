<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../templates/header.php");
include_once("../templates/footer.php");

function calculate_total_item_cost($cart) {
    $total_cost = 0;
    foreach ($cart as $item) {
        $total_cost += floatval($item['price']);
    }
    return $total_cost;
}

function calculate_shipping_cost($cart) {
    $shipping_cost = 0;
    foreach ($cart as $item) {
        $shipping_cost += 7;
    }
    return $shipping_cost;
}

function calculate_total_costs($cart) {
    $total_cost = calculate_total_item_cost($cart);
    $shipping_cost = calculate_shipping_cost($cart);
    return $total_cost + $shipping_cost;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $price = $_POST['price'];
    $shipping_cost = 0;
    $ad_id = $_POST['ad_id'];
    $seller_username = $_POST['seller_username'];

    $_SESSION['cart'][] = [
        'product' => $product,
        'price' => $price,
        'shipping_cost' => $shipping_cost,
        'ad_id' => $ad_id,
        'seller_username' => $seller_username
    ];

    print_r($_SESSION['cart']);
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total_item_cost = calculate_total_item_cost($_SESSION['cart']);
    $shipping_cost = calculate_shipping_cost($_SESSION['cart']);
    $total_costs = calculate_total_costs($_SESSION['cart']);
} else {
    $total_item_cost = 0;
    $shipping_cost = 0;
    $total_costs = 0;
    echo "No items added to cart";
}


header("Location: ../pagesHTML/ProductPage.php?id=$ad_id");

