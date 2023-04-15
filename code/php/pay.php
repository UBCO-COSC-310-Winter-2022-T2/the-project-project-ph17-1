<?php

class Payment
{
    private $payments;

    public function __construct()
    {
        $this->payments = [];
    }

    public function addPayment($amount)
    {
        $paymentId = count($this->payments) + 1;

        $this->payments[$paymentId] = [
            'id' => $paymentId,
            'amount' => $amount,
        ];

        return true;
    }

    public function getPaymentById($paymentId)
    {
        if (array_key_exists($paymentId, $this->payments)) {
            return $this->payments[$paymentId];
        }

        return null;
    }
}
?>





