<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "310";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['item_id'])) {
        $item_id = $_POST['item_id'];

        // Delete item from the database
        $sql = "DELETE FROM items WHERE item_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $item_id);

        if ($stmt->execute()) {
            header("Location: admin.php"); // Redirect back to the items page
            exit();
        } else {
            die("Error deleting item: " . $stmt->error);
        }

        $stmt->close();
    }
}

$conn->close();
?>
