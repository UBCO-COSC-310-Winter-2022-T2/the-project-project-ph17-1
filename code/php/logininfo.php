<?php
// File: code/php/login.php

class Login
{
    private $users;

    public function __construct()
    {
        // Example user data, you should replace this with a proper data source (e.g. a database)
        $this->users = [
            'testuser' => [
                'password' => 'testpassword',
            ],
        ];
    }

    public function validateCredentials($username, $password)
    {
        if (array_key_exists($username, $this->users)) {
            return $this->users[$username]['password'] === $password;
        }

        return false;
    }
}
?>
<?php
session_start();
include "main.php";
$logged = FALSE;

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            echo "Form submitted and email/password received.<br>"; // Debug line
            $email = $_POST["email"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM users";
            $results = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($results)) {
                if ($email == $row['email'] && $password == $row['password']) {
                    $logged = TRUE;
                    $_SESSION['user_id'] = $row['userid'];
                    header("Location: Knowwell.php");
                    exit();
                }
            }
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        } 
    }
}
?>
