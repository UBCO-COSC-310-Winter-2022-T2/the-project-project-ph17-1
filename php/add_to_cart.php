<?php
require_once 'autoload.php';
session_start();
require_once 'ShoppingCart.php';

$item_id = $_POST['item_id'];
$price = $_POST['price'];

$shoppingCart = ShoppingCart::getSessionInstance();
$shoppingCart->addItem($item_id, 1, $price);

header('Location: ShoppingCart.php');
exit();
?>
