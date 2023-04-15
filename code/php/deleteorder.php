<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the order_id is set in POST data
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

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

    // Delete the order from the database
    $sql = "DELETE FROM orders WHERE order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Order deleted successfully.";
    } else {
        echo "Error deleting order.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No order_id provided.";
}
header("Refresh: 2; URL=admin.php");
?>
