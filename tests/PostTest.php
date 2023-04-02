<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../code/php/post.php');

class ItemPostTest extends TestCase
{
    private $itemPost;

    protected function setUp(): void
    {
        // Replace these with your actual MySQL database credentials
        $host = 'localhost';
        $username = 'username';
        $password = 'password';
        $dbname = 'dbname';

        $this->itemPost = new ItemPost($host, $username, $password, $dbname);
    }

    public function testAddItem()
    {
        $name = 'Sample Item';
        $description = 'Sample item description';
        $price = 99.99;
        $seller_id = 1;

        $result = $this->itemPost->addItem($name, $description, $price, $seller_id);
        $this->assertTrue($result);

        // Assuming that the item ID is 1, as this is the first item being added.
        $itemId = 1;
        $item = $this->itemPost->getItemById($itemId);

        $this->assertEquals($itemId, $item['id']);
        $this->assertEquals($name, $item['name']);
        $this->assertEquals($description, $item['description']);
        $this->assertEquals($price, $item['price']);
        $this->assertEquals($seller_id, $item['seller_id']);
    }
}

