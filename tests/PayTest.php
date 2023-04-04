<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../code/php/pay.php');

class PaymentTest extends TestCase
{
    private $payment;

    protected function setUp(): void
    {
        $this->payment = new Payment();
    }

    public function testAddPayment()
    {
        $amount = 100;
        $currency = 'USD';
        $result = $this->payment->addPayment($amount, $currency);
        $this->assertTrue($result);

        // Assuming that the payment ID is 1, as this is the first payment being added.
        $paymentId = 1;
        $payment = $this->payment->getPaymentById($paymentId);

        $this->assertEquals($paymentId, $payment['id']);
        $this->assertEquals($amount, $payment['amount']);
        $this->assertEquals($currency, $payment['currency']);
    }
}
?>
<?php
// File: code/php/pay.php

class Payment
{
    private $payments;

    public function __construct()
    {
        $this->payments = [];
    }

    public function addPayment($amount, $currency)
    {
        $paymentId = count($this->payments) + 1;

        $this->payments[$paymentId] = [
            'id' => $paymentId,
            'amount' => $amount,
            'currency' => $currency,
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






