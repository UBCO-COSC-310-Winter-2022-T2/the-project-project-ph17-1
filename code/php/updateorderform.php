<?php
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

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

    // Fetch order details from the database
    $sql = "SELECT shipping_address, payment_method, total_cost, status FROM orders WHERE order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
} else {
    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
</head>
<body>
    <h1>Update Order</h1>
    <form action="processupdateorder.php" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <label for="shipping_address">Shipping Address:</label>
        <input type="text" name="shipping_address" id="shipping_address" value="<?php echo htmlspecialchars($order['shipping_address']); ?>"><br><br>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method">
            <option value="credit_card" <?php echo ($order['payment_method'] === 'credit_card') ? 'selected' : ''; ?>>Credit Card</option>
            <option value="paypal" <?php echo ($order['payment_method'] === 'paypal') ? 'selected' : ''; ?>>PayPal</option>
            <option value="giftcard" <?php echo ($order['payment_method'] === 'giftcard') ? 'selected' : ''; ?>>Gift Card</option>
        </select><br><br>
        <label for="total_cost">Total Cost:</label>
        <input type="number" name="total_cost" id="total_cost" step="0.01" value="<?php echo $order['total_cost']; ?>"><br><br>
        <select name="status" id="status">
            <option value="processing" <?php echo ($order['status'] === 'processing') ? 'selected' : ''; ?>>processing</option>
            <option value="pending" <?php echo ($order['status'] === 'pending') ? 'selected' : ''; ?>>pending</option>
            <option value="shipped" <?php echo ($order['status'] === 'shipped') ? 'selected' : ''; ?>>shipped</option>
            <option value="delivered" <?php echo ($order['status'] === 'delivered') ? 'selected' : ''; ?>>delivered</option>
            </select><br><br>
        <input type="submit" value="Update Order">
    </form>
</body>
</html>
