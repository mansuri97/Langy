<?php
  require('langyclass.php');

  $username = mysqli_real_escape_string($connect, $_POST["username"]);
  $parentName = mysqli_real_escape_string($connect, $_POST["parentName"]);
  $childName = mysqli_real_escape_string($connect, $_POST["childName"]);
  $password = mysqli_real_escape_string($connect, $_POST["password"]);
  $password2 = mysqli_real_escape_string($connect, $_POST["password2"]);
  $pin = mysqli_real_escape_string($connect, $_POST["pin"]);
  $pin2 = mysqli_real_escape_string($connect, $_POST["pin2"]);


  $sql = "SELECT Username,Password FROM Account WHERE Username ='$username'";
  $result = mysqli_query($connect,$sql) or die(mysqli_error());
  $title = "Oops! There was a problem.";

  if ($username == "" || $parentName == "" || $childName == "" || $password == "" || $password2 == "" || $pin=="" || $pin2=="") {
    $message = "One or more fields were left blank.<br />Please make sure everything is filled in.";
  }
  elseif ($password != $password2) {
    $message = "The passwords you entered did not match.<br />Please try entering them again.";
  }
  elseif ($pin != $pin2) {
    $message = "The pins you entered did not match.<br />Please try entering them again.";
  }
  elseif (mysqli_num_rows($result) > 0) { // testing the number of row is bigger than 0 then return the number of rows
    $message = "The username you entered already exists.<br />Please try entering something else.";
  }
  else {
    $password = md5($password);
    $sqlAccount = "INSERT INTO Account(Username, Password, ParentalControlsPIN) VALUES('$username','$password', '$pin')";
    $sqlParent = "INSERT INTO Parent(AccountUsername, FirstName) VALUES('$username','$parentName')";
    $sqlChild = "INSERT INTO Child(AccountUsername, FirstName) VALUES('$username','$childName')";
    $sqlBook = "INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('$username','2');";

    if (mysqli_query($connect,$sqlAccount) && mysqli_query($connect,$sqlParent) && mysqli_query($connect,$sqlChild) && mysqli_query($connect,$sqlBook)) {
      $title = "You've registered!";
      $message = "We're glad to have you with us.<br />Go back and log in to begin your reading adventure!";
    }
    else {
      $message = "Database error:<br />" . mysqli_error($connect) . "<br />Sorry about that.";
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
    <link href="../styles/home.css" rel="stylesheet" type="text/css">
  </head>
  <body>

    <div id = "main">
      <center>
      <?php
        echo "<h1>" . $title . "</h1>";
        echo $message . "<br /><br />";
      ?>
      <a class='back' href="../index.html">Go Back</a>
      </center>
    </div>

  </body>
</html>
