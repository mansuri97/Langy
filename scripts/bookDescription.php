<?php
  require('langyclass.php');

  if(isset($_POST['1'])){
    $encodedAlice = $_SESSION['encodeAlice'];
    $Books = unserialize($encodedAlice);
  }
  elseif(isset($_POST['2'])){
    $encodeCaterpillar = $_SESSION['encodeCaterpillar'];
    $Books = unserialize($encodeCaterpillar);
  }
  elseif(isset($_POST['3'])){
    $encodeRainbowfish = $_SESSION['encodeRainbowfish'];
    $Books = unserialize($encodeRainbowfish);
  }
  elseif(isset($_POST['4'])){
    $encodeRabbit = $_SESSION['encodeRabbit'];
    $Books = unserialize($encodeRabbit);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $Books->getTitle();?></title>
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
      <table width="70%">
        <tr>
          <td width="30%">
            <img src = "../static/covers/<?php echo $Books->getId()?>.jpg" class = "descriptionCover">
          </td>
          <td width="70%" style = "padding-left: 50px;">
            <?php
              echo "<h1>" . $Books->getTitle() . "</h1>";
              echo "<b>By:</b> " . $Books->getAuthor() . "<br />";
              echo "<b>Genre(s):</b> " . $Books->getGenre() . "<br />";
              echo "<b>Reading Level:</b> " . $Books->getReadinglevel() . "<br /><br />";
              echo $Books->getDescription() . "<br /><br />";
              $_SESSION['encodeBook'] = serialize($Books);
            ?>
            <a class='back' href='../PinPage.html'>Purchase</a><br />
            <a class='back' href='bookShop.php'>Go Back</a>

          </td>
        </tr>
      </table>
    </div>

  </body>
</html>
