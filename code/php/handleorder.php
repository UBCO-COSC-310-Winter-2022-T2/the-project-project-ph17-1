<?php
class OrderHandler
{
    private $orders = [];

    public function addOrder($orderId, $status)
    {
        $this->orders[$orderId] = $status;
    }

    public function getOrderStatus($orderId)
    {
        if (array_key_exists($orderId, $this->orders)) {
            return $this->orders[$orderId];
        } else {
            return null;
        }
    }

    public function deleteOrder($orderId)
    {
        unset($this->orders[$orderId]);
    }

    public function updateStatus($orderId, $newStatus)
    {
        if (array_key_exists($orderId, $this->orders)) {
            $this->orders[$orderId] = $newStatus;
            return true;
        } else {
            return false;
        }
    }
}
?>
