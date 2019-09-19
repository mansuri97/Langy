<?php


require("langyclass.php");



$encodedCurrentUser = $_SESSION['encodeCurrentUser'];
$currentUser = unserialize($encodedCurrentUser);
$name = $currentUser->getUsername();
$sql = "SELECT CardNumber,NameOnCard,ExpiryDate,SecurityCode FROM bankcard WHERE AccountUsername = '$name'";
$result = mysqli_query($connect,$sql) or die(mysqli_error());
$row = mysqli_fetch_row($result);

$card1 = new BankCard($row[0],$row[1],$row[2],$row[3]);
$validNumber = $card1->getcardNumber();

$validName =  $card1->getcardName();

$validCode = $card1->getsecurityCode();

$validExpiry = $card1->getexpDate();



?>










<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Payment</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/payment.css">
</head>



<body>
<?php include('payment_action.php');?>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">

        <div class="row">


          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname"><p>Accepted Cards</p></label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname"><h3>Name on Card</h3></label>
            <input type="text" id="cname" name="cardname" value=<?php echo $validName;?>>
            <span class="error">* <?php echo $nameErr; ?></span>
            <label for="ccnum"><h3>Credit card number (16 digits)</h3></label>
            <input type="text" id="ccnum" name="cardnumber" pattern="\d{16}" value=  <?php echo $validNumber;?>>
            <span class="error">* <?php echo $cardnumErr;?></span>



            <div class="row">
              <div class="col-50">
                <label for="cname"><h3>Expiry Date (4 digits)</h3></label>
                <input type="text" id="ccnum" name="expdate" pattern="\d{4}" value=  <?php echo $validExpiry;?>>
                <span class="error">* <?php echo $expdateErr;?></span>

              </div>
              <div class="col-50">
                <label for="cvv"><h3>CVV (3 digits)</h3></label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3}" value=  <?php echo $validCode;?>>

                <span class="error">* <?php echo $cvvErr;?></span>
              </div>
            </div>
          </div>

        </div>

        <input type="submit" value="Purchase" class="btn">

      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4><p>Book</p>
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
          <b>1</b>
        </span>
      </h4>
      <p><a href="#"><p>Product 1</p></a> <span class="price"><p>£2.50</p></span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b><p>£2.50<p></b></span></p>
    </div>
  </div>
</div>

</body>
</html>
