<?php
    ob_start();
    require('langyclass.php');
    $username = $_GET['username'];
    $password = $_GET['password'];
    $password = md5($password);
    $title = "Oops! There was a problem.";

    $sql = "SELECT Username,Password,ParentalControlsPIN FROM account";
    $result = mysqli_query($connect,$sql) or die(mysqli_error());

    if($username == "" || $_GET['password'] == "") {
    	$message = "One or more fields were left blank.<br />Please make sure everything is filled in.";
    }
    elseif(mysqli_num_rows($result)>0) { // testing the number of row is bigger than 0 then return the number of rows
    	while($eachrow = mysqli_fetch_assoc($result)) { // Fetch functionality is fetching the result row as an array. So it fetching the rows in finalresult
        if($eachrow['Username'] == $username && $eachrow['Password'] == $password) {

          $currentUser  = new Account($username,$password);
          $currentUser->setParentalControlsPin($eachrow['ParentalControlsPIN']);
          $_SESSION['encodeCurrentUser'] = serialize($currentUser);
          header('Location: ../home.html');
          die();
        }
      }
      $message = "The username or password you entered was invalid.<br />Please try again.";
    }
    else {
      $message = "Table is empty";
    }
    $output = ob_get_contents();
    ob_flush();

?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Log In</title>
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
        <a class='back' href='../index.html'>Go Back</a>
        </center>
     </div>

   </body>
 </html>
