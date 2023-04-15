<html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'autoload.php';
session_start();
require_once 'ShoppingCart.php';

$item_id = $_POST['item_id'];
$price = $_POST['price'];
echo '<p>'.$item_id.'</p>';
$shoppingCart = ShoppingCart::getSessionInstance();
$shoppingCart->addItem($item_id, 1, $price);
$_SESSION['shoppingcart'] = serialize($shoppingCart);
header('Location: cart_display.php');
exit();
?>
