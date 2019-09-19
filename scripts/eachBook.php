<?php
require('langyclass.php');

if(isset($_POST['alice'])){
  $encodedAlice = $_SESSION['encodeAlice'];
  $Books = unserialize($encodedAlice);
}
elseif(isset($_POST['caterpillar'])){
  $encodeCaterpillar = $_SESSION['encodeCaterpillar'];
  $Books = unserialize($encodeCaterpillar);
}
elseif(isset($_POST['rainbowfish'])){
  $encodeRainbowfish = $_SESSION['encodeRainbowfish'];
  $Books = unserialize($encodeRainbowfish);
}
elseif(isset($_POST['rabbit'])){
  $encodeRabbit = $_SESSION['encodeRabbit'];
  $Books = unserialize($encodeRabbit);
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title><?php echo $Books->getTitle();?></title>
    <link rel="stylesheet" href="../styles/bookDescription.css">
   </head>
   <body>
     <img src = "../static/covers/<?php echo $Books->getId()?>.jpg" class = "aliceImg" 200px 240px/>
     <h1>Book Description</h1>
     <p id="bookdata">
       <?php
       echo $Books->getTitle();
       echo "<br>";
       echo $Books->getAuthor();
       echo "<br>";
       echo $Books->getGenre();
       echo "<br>";
       echo $Books->getReadinglevel();
       echo "<br>";
       echo $Books->getDescription();
        ?>
     </p>
     <?php
        $_SESSION['encodeBook'] = serialize($Books);
      ?>
     <input type="button" name="purchase" value="Purchase Now" onclick="goToPayment()" class="purchaseBtn">
     <script src="./redirectbook.js" charset="utf-8"></script>
   </body>
 </html>
