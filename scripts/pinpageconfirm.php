<?php
  require('login.php');
  $encodedCurrentUser = $_SESSION['encodeCurrentUser'];
  $currentUser = unserialize($encodedCurrentUser);
  $user = $_POST['username'];
  $pin = $_POST['pinentry'];
  $name = $currentUser->getUsername();

  if($name == $user && $currentUser->getPIN() == $pin)
  {
      echo "Login Successful";
      header('Location: ./payment.php');
  }
  else {
    header('Location: ../error.html');
  }
?>
