<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_id"])) {
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $status=$_POST["status"];
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
        // Update item details in the database
$sql = "UPDATE items SET item_name=?, price=?, quantity=?, description=?,status=? WHERE item_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdissi", $item_name, $price, $quantity, $description,$status, $item_id);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error updating item: " . $stmt->error;
}

$stmt->close();
$conn->close();
} else {
    header("Location: admin.php");
    exit();
    }
    ?>
