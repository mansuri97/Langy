<?php
  require('langyclass.php');
  $encodedCurrentUser = $_SESSION['encodeCurrentUser'];
  $currentUser = unserialize($encodedCurrentUser);
  $name = $currentUser->getUsername();
  $sql = "SELECT BookID FROM account_book WHERE AccountUsername = '$name'";
  $result = mysqli_query($connect,$sql) or die(mysqli_error());
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Owned Books</title>
    <link href="../styles/bookShop.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>

    <div id = "top">
      <div id = "title">Owned Books</div>
      <div id = "subtitle">Choose a book to read</div>
    </div>

    <div id = "nav">
      <a href="../home.html"><img src="../static/nav/home.png" width="32" height="32" alt="Home" /></a>
    </div>

    <div id = "main">
      <form action="bookOwnedDescription.php" method="POST">
        <?php
          if(mysqli_num_rows($result) > 0) { // testing the number of row is bigger than 0 then return the number of rows
            while($eachrow = mysqli_fetch_assoc($result)) { // Fetch functionality is fetching the result row as an array. So it fetching the rows in finalresult
              $eachbook = $eachrow['BookID'];
              //echo "<a href='./readBook.php?book=$eachbook'> <img src = '../static/covers/$eachbook.jpg' class='cover'/></a>";
              echo "<button type='submit' name='$eachbook'><img src = '../static/covers/$eachbook.jpg' class='cover'/></button>";
            }
          } else {
            echo "<center>";
            echo "<h1>Oops! There's no books here.</h1>";
            echo "There are no books associated with your account.<br /><br />";
            echo "<a class='back' href='../home.html'>Go Back</a>";
            echo "</center>";
          }
        ?>
      </form>
    </div>

  </body>
</html>
