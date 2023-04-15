<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "main.php";
if (isset($_POST['order_id']) && isset($_POST['shipping_address']) && isset($_POST['payment_method']) && isset($_POST['total_cost']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];
    $total_cost = $_POST['total_cost'];
    $status = $_POST['status'];

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

    // Update the order details in the database
    $sql = "UPDATE orders SET shipping_address=?, payment_method=?, total_cost=?, status=? WHERE order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $shipping_address, $payment_method, $total_cost, $status, $order_id);
    $result = $stmt->execute();

    if ($result) {
        echo "Order updated successfully.";
    } else {
        echo "Error updating order: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid data.";
}

header("Refresh: 2; URL=admin.php");
?>