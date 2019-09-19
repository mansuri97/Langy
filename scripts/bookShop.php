<?php
  require('langyclass.php');
  $encodedCurrentUser = $_SESSION['encodeCurrentUser'];
  $currentUser = unserialize($encodedCurrentUser);
  $name = $currentUser->getUsername();
  $sql = "SELECT ID FROM book WHERE ID NOT IN (SELECT BookID FROM account_book WHERE AccountUsername = '$name')";
  $result = mysqli_query($connect,$sql) or die(mysqli_error());
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Book Shop</title>
    <link href="../styles/bookShop.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>

    <div id = "top">
      <div id = "title">Book Shop</div>
      <div id = "subtitle">Purchase a new book for your account</div>
    </div>

    <div id = "nav">
      <a href="../home.html"><img src="../static/nav/home.png" width="32" height="32" alt="Home" /></a>
    </div>

    <div id = "main">
      <form action="bookDescription.php" method="POST">
        <?php
          if(mysqli_num_rows($result) != 0) { // testing the number of row is bigger than 0 then return the number of rows
            while($eachrow = mysqli_fetch_assoc($result)) { // Fetch functionality is fetching the result row as an array. So it fetching the rows in finalresult
              $eachbook = $eachrow['ID'];
              echo "<button type='submit' name='$eachbook'><img src = '../static/covers/$eachbook.jpg' class='cover'/></button>";
            }
          } else {
            echo "<center>";
            echo "<h1>Oops! The shop is empty.</h1>";
            echo "There are no books available to purchase right now.<br /><br />";
            echo "<a class='back' href='../home.html'>Go Back</a>";
            echo "</center>";
          }
        ?>
      </form>
    </div>

  </body>
</html>
