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
  // session_start();
  require_once 'shoppingcart.php';
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
?>
        <div class="topnav">
            <a class="active" href="Knowwell.php" id="home">Home</a>
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
        echo "<a href='login.php' class='right'>Login</a>";
    }
    ?>
              
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <?php
    require_once '../code/php/shoppingcart.php';

    $cart = ShoppingCart::getSessionInstance();
$items = $cart->getItems();
$totalItems = $cart->getTotalItems();
$totalCost = $cart->getTotalCost();

foreach ($items as $itemName => $itemDetails) {
    echo '<p>';
    echo 'Item: ' . $itemName . '<br>';
    echo 'Quantity: ' . $itemDetails['quantity'] . '<br>';
    echo 'Price: $' . $itemDetails['price'] . '<br>';
    echo 'Cost: $' . ($itemDetails['quantity'] * $itemDetails['price']);
    echo '</p>';
}

    ?>
</body>
</html>