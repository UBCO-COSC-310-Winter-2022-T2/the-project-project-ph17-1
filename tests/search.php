<?php

use PHPUnit\Framework\TestCase;
require_once 'search.php';

class SearchTest extends TestCase
{
    private $search;

    protected function setUp(): void
    {
        $this->search = new Search();
    }

    public function testSearchByName()
    {
        $searchTerm = 'Laptop';
        $results = $this->search->searchByName($searchTerm);
        $this->assertCount(1, $results);
        $this->assertEquals(1, $results[0]['id']);
    }

    public function testSearchWithNoResults()
    {
        $searchTerm = 'Nonexistent Product';
        $results = $this->search->searchByName($searchTerm);
        $this->assertCount(0, $results);
    }
}
