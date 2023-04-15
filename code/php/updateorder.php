<?php
// Check if the order_id is set in POST data
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Redirect to an update form page, passing the order_id as a GET parameter
    header("Location: updateorderform.php?order_id=$order_id");
    exit();
} else {
    // If the order_id is not set, redirect to the orders page
    header("Location: admin.php");
    exit();
}
?>
