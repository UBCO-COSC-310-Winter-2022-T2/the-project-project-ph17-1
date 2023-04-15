<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
</head>
<body>
    <h1>Update Item</h1>
    <?php
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];

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

            // Fetch item details from the database
            $sql = "SELECT item_name, price, quantity, description FROM items WHERE item_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $item_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $item = $result->fetch_assoc();

            $stmt->close();
            $conn->close();
        } else {
            header("Location: items.php");
            exit();
        }
    ?>
    <form action="processupdateitem.php" method="post">
        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" id="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>"><br><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" value="<?php echo $item['price']; ?>"><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo $item['quantity']; ?>"><br><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" cols="50"><?php echo htmlspecialchars($item['description']); ?></textarea><br><br>
        <select name="status" id="status">
            <option value="active" <?php echo ($item['status'] === 'active') ? 'selected' : ''; ?>>active</option>
            <option value="inactive" <?php echo ($item['status'] === 'inactive') ? 'selected' : ''; ?>>inactive</option>
        </select><br><br>
        <input type="submit" value="Update Item">
    </form>
</body>
</html>
