<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Read a Book</title>
    <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../styles/readBook.css" rel="stylesheet" type="text/css">
  </head>
  <body>

    <div id = "top">
      <div id = "title">Title</div>
      <div id = "subtitle">Author</div>
    </div>

    <div id = "nav">
      <a href="ownedBooks.php"><img src="../static/nav/back.png" width="32" height="32" alt="Back" /></a>
      <a href="../home.html"><img src="../static/nav/home.png" width="32" height="32" alt="Home" /></a>
    </div>

    <div id = "main">
    </div>

    <?php
      $book = $_GET["book"];
      echo "<script src=\"./readBook.js?book=" . $book . "\"></script>";
     ?>

  </body>
</html>
