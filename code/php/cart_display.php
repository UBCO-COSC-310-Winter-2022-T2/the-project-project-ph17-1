
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/kw_main.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>

    <header>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once 'ShoppingCart.php';

    include "main.php";
    $admin=false;
    function getUserImage($connection, $user_id) {
        $sql = "SELECT userimage FROM users WHERE user_id=?";
      $stmt = mysqli_prepare($connection, $sql);
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      
      return $row['userimage'];
      
    }
    
    // The duplicate function declaration has been removed.

    

?>
<h1>
</h1>
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
        <div class="topnav">
            <a class="active" href="Knowwell.php" id="home">Home</a>
            <div class="search-container">
              <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/topsearch.png"></button>
                
              </form>
            </div>
                <a href="cart_display.php" class="right">Cart</a>
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
<div class="content">

<?php

    require_once 'ShoppingCart.php';

    $cart = ShoppingCart::getSessionInstance();
    $items = $cart->getItems();
    $totalItems = $cart->getTotalItems();
    $totalCost = $cart->getTotalCost();

    foreach ($items as $itemid => $itemDetails) {
        if($error != null)
        {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }
        else
        {
            $sql = "SELECT * FROM items WHERE item_id = ".$itemid.";";
            $results = mysqli_query($connection, $sql);
            $sql1="SELECT * FROM users";
            $results1 = mysqli_query($connection, $sql1);
            

            while ($row = mysqli_fetch_assoc($results))
            {
              echo ' <div class="questre">';
              echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3><a href='detail.php?id=".$row['item_id']."' class='detail'>".$row['item_name']."</a></h3>";
                echo "</div>";
                echo '<div class="qcon">';
                while ($row1=mysqli_fetch_assoc($results1)){
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
              mysqli_data_seek($results1, 0); 
                echo '<div class="qcon-text">';
                echo 'Quantity: ' . $itemDetails['quantity'] . '<br>';
                echo 'Cost: $' . ($itemDetails['quantity'] * $itemDetails['price']);?>


                <form action="add_cart.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $itemid; ?>">
                <input type="submit" value="Add 1">
              </form>
              <form action="remove_cart.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $itemid; ?>">
                <input type="submit" value="remove 1">
              </form>
              


<?php
                echo '</div>';
                if($row['item_image']!=null){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['item_image'] ).'"id="item"/>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
        $_SESSION['admin']=$admin;
        mysqli_free_result($results);

    }
    
    }
$_SESSION['shoppingcart'] = serialize($cart);

    ?>
    </div>

    <div class = "check-out-location">
    <form action="checkout.php" method="POST" onsubmit="return checkCartEmpty();">
    <input type='submit' value="Checkout" class='checkout'>
</form>
</div>
<script>
  function checkCartEmpty() {
    var totalItems = <?php echo $totalItems; ?>;
    if (totalItems === 0) {
      alert("Your cart is empty. Please add items to your cart before checking out.");
      return false;
    }
    return true;
  }
</script>

</body>


</html>
