<?php

use PHPUnit\Framework\TestCase;
require_once 'shoppingcart.php';

class ShoppingCartTest extends TestCase
{
    private $shoppingCart;

    protected function setUp(): void
    {
        $this->shoppingCart = new ShoppingCart();
    }

    public function testAddItem()
    {
        $this->shoppingCart->addItem('item1', 2, 10);
        $totalCost = $this->shoppingCart->getTotalCost();
        $this->assertEquals(20, $totalCost);
    }

    public function testRemoveItem()
    {
        $this->shoppingCart->addItem('item1', 2, 10);
        $this->shoppingCart->addItem('item2', 1, 15);
        $this->shoppingCart->removeItem('item1');
        $totalCost = $this->shoppingCart->getTotalCost();
        $this->assertEquals(15, $totalCost);
    }

    public function testGetTotalCost()
    {
        $this->shoppingCart->addItem('item1', 2, 10);
        $this->shoppingCart->addItem('item2', 1, 15);
        $totalCost = $this->shoppingCart->getTotalCost();
        $this->assertEquals(35, $totalCost);
    }
}
