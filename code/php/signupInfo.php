<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
include "main.php";

if ($error != null) {
    $output = "<p>Unable to connect to database!</p >";
    exit($output);
} else {
    if (isset($_POST['submit'])) {
        $userName = $connection->real_escape_string($_POST['name']);
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);
        $password2 = $connection->real_escape_string($_POST['password2']);
        $role="customer";

        
        $userImage = file_get_contents($_FILES['image']['tmp_name']);


        $stmt = $connection->prepare("INSERT INTO users (username, email, password, userimage,role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssbs", $userName, $email, $password, $userImage, $role);
    $stmt->send_long_data(3, $userImage);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }




}

?>