<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Orders</h1>
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

        // Fetch orders from the database
        $sql = "SELECT order_id, shipping_address, payment_method, total_cost, status FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Shipping Address</th><th>Payment Method</th><th>Total Cost</th><th>Status</th></tr>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["order_id"] . "</td><td>" . $row["shipping_address"] . "</td><td>" . $row["payment_method"] . "</td><td>$" . $row["total_cost"] . "</td><td>".$row['status']."</td>";
                echo "<td>";
                echo "<form action='deleteorder.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "<form action='updateorder.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No orders found.";
        }?>
<h1>Items</h1>
        <?php


        $sql = "SELECT item_id, item_name, price, quantity,status, description FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Item ID</th><th>Item Name</th><th>Price</th><th>Quantity</th><th>Status</th><th>Description</th><th>Actions</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["item_id"] . "</td><td>" . $row["item_name"] . "</td><td>$" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>".$row["status"]."</td><td>" . $row["description"] . "</td>";
            echo "<td>";
            echo "<form action='deleteitem.php' method='post' style='display:inline;'>";
            echo "<input type='hidden' name='item_id' value='" . $row["item_id"] . "'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";
            echo "<form action='updateitem.php' method='post' style='display:inline;'>";
            echo "<input type='hidden' name='item_id' value='" . $row["item_id"] . "'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No items found.";
    }
        echo ' <form action="logout.php" method="POST">
        <button type="submit" class="my-button">Log Out</button>
    </form>';
    
        $conn->close();
    ?>
</body>
</html>
