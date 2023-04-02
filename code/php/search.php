class Search
{
    private $products = [
        ['id' => 1, 'name' => 'Laptop'],
        ['id' => 2, 'name' => 'Tablet'],
        ['id' => 3, 'name' => 'Smartphone']
    ];

    public function searchByName($searchTerm)
    {
        $results = [];

        foreach ($this->products as $product) {
            if (strpos($product['name'], $searchTerm) !== false) {
                $results[] = $product;
            }
        }

        return $results;
    }
}
