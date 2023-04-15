<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/kw_main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/post.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>
    <header>
        <div class="topnav">
            <a href="Knowwell.php" id="home">Home</a>
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="../images/topsearch.png"></button>
                </form>
            </div>
            <?php session_start();
            include "main.php";
            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }
            function getUserImage($connection, $user_id)
            {
                $sql = "SELECT userimage FROM users WHERE user_id=?";
                $stmt = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                return $row['userimage'];
            }
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
            <a href="#" class="right">Ask Question</a>
        </div>
    </header>
</head>

<body>
    <form action="image.php" method="post" enctype="multipart/form-data">
        <div id="main">
            <div class="EnterText">
                <legend>Enter product name</legend>

                <input type="text" id="title" placeholder="Enter Text Here" name="title">
            </div>
            <div class="EnterText">
                <legend>Price</legend>
                <input type="text" id="price" placeholder="Enter Price Here" name="price">
            </div>
            <div class="EnterText">
                <legend>Quantity</legend>
                <input type="text" id="quantity" placeholder="Enter Quantity Here" name="quantity">
            </div>
            <div class="EnterText">
                <legend>Enter description</legend>
                <input type="text" id="description" placeholder="Enter Text Here" name="description">
            </div>

            <div class="EnterText">
                <div id="choose">
                    <legend>Choose product image</legend>
                    <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/jpg">
                </div>
            </div>

            <div id="button">
                <button type="submit" value="Upload Image" name="submit" id="post">Post</button>
            </div>

        </div>
    </form>

</body>

</html>