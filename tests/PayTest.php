<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../code/php/pay.php');

class PayTest extends TestCase
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
        $result = $this->payment->addPayment($amount);
        $this->assertTrue($result);

        // Assuming that the payment ID is 1, as this is the first payment being added.
        $paymentId = 1;
        $payment = $this->payment->getPaymentById($paymentId);

        $this->assertEquals($paymentId, $payment['id']);
        $this->assertEquals($amount, $payment['amount']);
    }
}
?>






