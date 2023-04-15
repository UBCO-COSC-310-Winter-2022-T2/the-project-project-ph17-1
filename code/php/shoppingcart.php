<?php
require_once 'autoload.php';
class ShoppingCart
{
    private $items = [];

    public static function getSessionInstance()
{
    if (!isset($_SESSION['shoppingcart'])) {
        $_SESSION['shoppingcart'] = new ShoppingCart();
    }
    return $_SESSION['shoppingcart'];
}


    public function addItem($item, $quantity, $price)
    {
        if (array_key_exists($item, $this->items)) {
            $this->items[$item]['quantity'] += $quantity;
        } else {
            $this->items[$item] = [
                'quantity' => $quantity,
                'price' => $price,
            ];
        }
    }

    public function removeItem($item, $quantity=1)
    {
        if (array_key_exists($item, $this->items)) {
            $this->items[$item]['quantity'] -= $quantity;
            if ($this->items[$item]['quantity'] <= 0) {
                unset($this->items[$item]);
            }
        }
    }

    public function getTotalItems()
    {
        $totalItems = 0;
        foreach ($this->items as $item) {
            $totalItems += $item['quantity'];
        }
        return $totalItems;
    }

    public function getTotalCost()
    {
        $totalCost = 0;
        foreach ($this->items as $item) {
            $totalCost += $item['quantity'] * $item['price'];
        }
        return $totalCost;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function __sleep()
    {
        return array_keys(get_object_vars($this));
    }

    public function __wakeup()
    {
        // You can perform any additional logic here if needed
    }
}
?>
