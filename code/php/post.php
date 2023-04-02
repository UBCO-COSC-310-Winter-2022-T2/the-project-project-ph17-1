<?php
class ItemPost {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addItem($name, $description, $price, $seller_id) {
        $sql = "INSERT INTO items (name, description, price, seller_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $price, $seller_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getItemById($id) {
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
}

?>
