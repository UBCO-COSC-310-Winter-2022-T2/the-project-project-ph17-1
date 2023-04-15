<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Account.css">
    <title>Knowwell</title>
    <header>
        <div class="topnav">
            <a  href="Knowwell.php" id="home">Home</a>
            <div class="search-container">
                <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/topsearch.png"></button>
              </form>
            </div>
            <?php session_start();
            include "main.php";
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            function getUserImage($connection, $user_id) {
                $sql = "SELECT userimage FROM users WHERE user_id=?";
              $stmt = mysqli_prepare($connection, $sql);
              mysqli_stmt_bind_param($stmt, "i", $user_id);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $row = mysqli_fetch_assoc($result);
              return $row['userimage'];}
              ?>
              <?php
    if (isset($_SESSION['user_id'])) {
        $user_image = getUserImage($connection, $_SESSION['user_id']);
        echo '<a href="Account.php" id="account">';
        echo '<img src="data:image/png;base64,' . base64_encode($user_image) . '" class="right user" />';
        echo '</a>';
    } else {
        echo "<a href='login.php' class='right'>Login</a>";
    }
    ?>
              <a href="cart_display.php" class="right">Cart</a>
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <div id="main">
    <h2>Account Info</h2>
    <?php
    include "main.php";

    if ($error != null) {
        $output = "<p>Unable to connect to database!</p >";
        exit($output);
    } else {
        if (isset($_SESSION['user_id'])) {
            $userid = $_SESSION['user_id'];
            $sql = "SELECT * FROM users WHERE user_id='$userid';";
            $result = $connection->query($sql);
            $sql1 = "SELECT * FROM items WHERE user_id='$userid';";
            $results1 = mysqli_query($connection, $sql1);
            while ($row = $result->fetch_assoc()){
                echo '<div class="leftAcc"><figure>';
                echo '<img src="data:image/png;base64,'.base64_encode( $row['userimage'] ).'" class="user1"/>';
                echo '<figcaption><h3>'.$row['username'].'</h3></figcaption>';
                echo '</figure>';
                echo '<h3>Email: </h3>';
                echo '<p>'.$row['email'].'</p>';
                echo ' <form action="logout.php" method="POST">
                <button type="submit" class="my-button">Log Out</button>
            </form>';
                echo '</div>';
                
                echo '<div class="posts">';
                echo '<h3>Posts: </h3>';
                while ($row1=mysqli_fetch_assoc($results1)){
                    if($row['user_id'] == $row1['user_id']){
                        
                        
                        echo '<div class="question">';
                        echo '<div class="title">';
                        echo "<h3>".$row1['item_name']."</h3>";
                        echo "</div>";
                        echo '<div class="qcon">';
                        echo '<div class="qcon-text">';
                        echo "<p>".$row1['description']."</p>";
                        echo '</div>';
                        if($row1['item_image']!=null){
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row1['item_image'] ).'"/>';
                        }
                        echo '</div>';
                        echo '</div>';
                        
                        
                        
            }
                
                }
                
                echo '</div>';
            }
        }
    }

    // Close the database connection
    $connection->close();
    ?>
    </div>
</body>
</html>
