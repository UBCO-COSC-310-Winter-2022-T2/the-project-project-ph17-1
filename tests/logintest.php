<?php

use PHPUnit\Framework\TestCase;
require_once '../code/login.php';

class LoginTest extends TestCase
{
    private $login;

    protected function setUp(): void
    {
        $this->login = new Login();
    }

    public function testValidCredentials()
    {
        $username = 'testuser';
        $password = 'testpassword';
        $result = $this->login->validateCredentials($username, $password);
        $this->assertTrue($result);
    }

    public function testInvalidCredentials()
    {
        $username = 'wronguser';
        $password = 'wrongpassword';
        $result = $this->login->validateCredentials($username, $password);
        $this->assertFalse($result);
    }
}
