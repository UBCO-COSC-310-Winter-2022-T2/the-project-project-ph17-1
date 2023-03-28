<?php

use PHPUnit\Framework\TestCase;
require_once 'handleorder.php';

class OrderHandlerTest extends TestCase
{
    private $orderHandler;

    protected function setUp(): void
    {
        $this->orderHandler = new OrderHandler();
    }

    public function testAddAndDeleteOrder()
    {
        $orderId = 1;
        $status = 'Pending';
        $this->orderHandler->addOrder($orderId, $status);

        $orderStatus = $this->orderHandler->getOrderStatus($orderId);
        $this->assertEquals($status, $orderStatus);

        $this->orderHandler->deleteOrder($orderId);
        $orderStatus = $this->orderHandler->getOrderStatus($orderId);
        $this->assertNull($orderStatus);
    }

    public function testUpdateStatus()
    {
        $orderId = 2;
        $status = 'Pending';
        $newStatus = 'Shipped';
        $this->orderHandler->addOrder($orderId, $status);

        $updateResult = $this->orderHandler->updateStatus($orderId, $newStatus);
        $this->assertTrue($updateResult);

        $orderStatus = $this->orderHandler->getOrderStatus($orderId);
        $this->assertEquals($newStatus, $orderStatus);
    }

    public function testUpdateStatusForNonexistentOrder()
    {
        $orderId = 3;
        $newStatus = 'Shipped';

        $updateResult = $this->orderHandler->updateStatus($orderId, $newStatus);
        $this->assertFalse($updateResult);
    }
}
