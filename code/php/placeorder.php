<?php
 ini_set('display_errors', 1);
 error_reporting(E_ALL);
session_start();
include "main.php";
require_once 'ShoppingCart.php';
if (isset($_SESSION['user_id'])) {
    $cart = ShoppingCart::getSessionInstance();
    $items = $cart->getItems();
    $totalItems = $cart->getTotalItems();
    $totalCost = $cart->getTotalCost();
    $payment=$_POST['payment_method'];
    $shipment=$_POST['shippingAddress'];
    $userid=$_SESSION['user_id'];
    $sql='INSERT INTO orders (user_id,status,total_cost,shipping_address,payment_method) VALUES(?,?,?,?,?)';
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $userid, $status, $totalCost, $shipment, $payment);
    $status = 'processing';
    if (mysqli_stmt_execute($stmt)) {
        $orderId = mysqli_stmt_insert_id($stmt);
        $cart->reset();
        $_SESSION['shoppingcart'] = serialize($cart);
        header("Location: payment.php?id=$orderId");
        exit();
    } else {
        $error = mysqli_stmt_error($stmt);
        echo "Error: $error";
    }

}
?>