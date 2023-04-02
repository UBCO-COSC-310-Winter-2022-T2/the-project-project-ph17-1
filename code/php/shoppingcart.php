<?php

class ShoppingCart
{
    private $items = [];

    public function addItem($item, $quantity = 1)
    {
        if (array_key_exists($item, $this->items)) {
            $this->items[$item] += $quantity;
        } else {
            $this->items[$item] = $quantity;
        }
    }

    public function removeItem($item, $quantity = 1)
    {
        if (array_key_exists($item, $this->items)) {
            $this->items[$item] -= $quantity;
            if ($this->items[$item] <= 0) {
                unset($this->items[$item]);
            }
        }
    }

    public function getTotalItems()
    {
        $totalItems = 0;
        foreach ($this->items as $quantity) {
            $totalItems += $quantity;
        }
        return $totalItems;
    }

    public function getItems()
    {
        return $this->items;
    }
}
