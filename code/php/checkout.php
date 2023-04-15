<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payment.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>
    <header>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
  session_start();
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
              <a href="cart_display.php" class="right">Cart</a>
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
    <script>
function validateForm() {
  const shippingAddress = document.getElementsByName("shippingAddress")[0];
  const paymentMethods = document.getElementsByName("payment_method");
  let paymentMethodSelected = false;

  for (let i = 0; i < paymentMethods.length; i++) {
    if (paymentMethods[i].checked) {
      paymentMethodSelected = true;
      break;
    }
  }

  if (shippingAddress.value.trim() === "" || !paymentMethodSelected) {
    alert("Please fill in all fields before submitting.");
    return false;
  }

  return true;
}
</script>

</head>
<body>
    <div class='content'>
        <div class='questre'>
    <form action="placeorder.php" method="post" onsubmit="return validateForm();">
    <label>Shipping Address:</label>
        <input type='text' name='shippingAddress' placeholder='Enter Shipping Address'><br><br>

        <label>Payment Method:</label><br><br>
        <label>Credit Card</label>
<input type='radio' name='payment_method' value='credit_card'><br><br>

        
<label>Paypal</label>
<input type='radio' name='payment_method' value='paypal'><br><br>
        
<label>Gift Card</label>
<input type='radio' name='payment_method' value='giftcard'><br><br>

        <input type='submit' value="Pay" class='checkout'>
</form>
</div>
</div>

</body>
</html>