<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>
    <header>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
  session_start();
  include "main.php";

  function getUserImage($connection, $user_id) {
      $sql = "SELECT userimage FROM users WHERE user_id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['userimage'];
}
?>
        <div class="topnav">
            <a href="Knowwell.php" id="home">Home</a>
            <div class="search-container">
              <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/topsearch.png"></button>
                
              </form>
            </div>
            <?php
    if (isset($_SESSION['user_id'])) {
        $user_image = getUserImage($connection, $_SESSION['user_id']);
        echo '<a href="Account.php" id="account">';
        echo '<img src="data:image/png;base64,' . base64_encode($user_image) . '" class="right user" />';
        echo '</a>';
    } else {
      echo "<script>
      alert('Please login first');
      window.location.href = 'login.php';
    </script>";
exit();
    }
    ?>
              <a href="cart_display.php" class="right">Cart</a>
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
<div class="content">
    <div class='questre'>
        <?php

        //question
        $questionId = $_GET['id'];
        $sql = "SELECT * FROM items WHERE item_id=?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $questionId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);



        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3>".$row['item_name']."</h3>";
                echo "</div>";
                echo '<div class="qcon">';
?>            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <input type="submit" value="Add to Cart">
              </form>"
              <?php
                //user
                $sql1 = "SELECT * FROM users WHERE user_id=?";
                $stmt1 = mysqli_prepare($connection, $sql1);
                mysqli_stmt_bind_param($stmt1, "i", $row['user_id']);
                mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);

                while ($row1=mysqli_fetch_assoc($result1)){
                  if($row1['user_id']==$row['user_id']){
                    echo '<div class="userinfo">';
                    echo '<figure>';
                      echo '<img src="data:image/png;base64,'.base64_encode( $row1['userimage'] ).'" class="user"/>';
                      echo '<figcaption> '.$row1['username'].'</figcaption>';
                    echo '</figure>';
                    echo '</div>';
                    break;
                  }
              }
              mysqli_data_seek($result1, 0); 
                echo '<div class="qcon-text">';
                echo "<p>".$row['description']."</p>";
                echo "<p>Price: ".$row['price']."</p>";
                echo '</div>';
                if($row['item_image']!=null){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['item_image'] ).'"/>';
                }
                echo '</div>';
                echo '</div>';

        }

      echo '</div>';
        ?>
       
      </div>
    </div>
    </div>
</body>
</html>