<?php
require_once('payment.php');
$encodeBooks = $_SESSION['encodeBook'];
$Books = unserialize($encodeBooks);

        $nameErr = $cardnumErr = $expdateErr = $cvvErr = "";
        $cardname = $cardnumber = $expdate = $cvv = "";
        $validcardName = $validName;
        $validcardNumber = $validNumber;
        $validcvv = $validCode;
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
           if(empty($_POST['cardname']))
           {
             $nameErr = "cardname is required";
           }
           else
           {
             $cardname = test_input($_POST["cardname"]);
             if(!preg_match("/^[a-zA-Z ]*$/",$cardname)){
               $nameErr = "Only letters and white space allowed";
             }
           }
           if(empty($_POST['cardnumber']))
           {
             $cardnumErr = "cardnumber is required";
           }
           else
           {
             $cardnumber = test_input($_POST["cardnumber"]);
             if (!is_numeric($cardnumber))
             {
               $cardnumErr = "is not numeric";
             }
           }
           if(empty($_POST['expdate']))
           {
             $expdateErr = "expiry date is required";
           }
           else
           {
             $expdate = test_input($_POST["expdate"]);
             if (!is_numeric($expdate))
             {
               $expdateErr = "is not numeric";
             }
           }
           if(empty($_POST['cvv']))
           {
             $cvvErr = "cvv is required";
           }
           else
           {
             $cvv = test_input($_POST["cvv"]);
             if (!is_numeric($cvv))
             {
               $cvvErr = "is not numeric";
             }
           }
           // if ($cardnumber == $validcardNumber AND $cvv == $validcvv )
           //
           // {
           //
           //     header("Location: ../ownedBooks.html");
           //
           //
           //  }
            //else{
               //adding new cardname,cardnumber and cvv to the database and redirecting to owned books page
              //if($validcardName == "" AND $validcardNumber == "" AND $validcvv == ""){
              $encodedCurrentUser = $_SESSION['encodeCurrentUser'];
              $currentUser = unserialize($encodedCurrentUser);
                $name=$currentUser->getUsername();
                $bookid = $Books->getId();
                // $sql = "SELECT * FROM bankcard WHERE AccountUsername = '$name'";
                $sql = "SELECT CardNumber,AccountUsername, NameOnCard,ExpiryDate,SecurityCode FROM bankcard WHERE AccountUsername = '$name'";
                $result = mysqli_query($connect,$sql) or die(mysqli_error());
                $sqlbook = "INSERT INTO account_book(AccountUsername,BookID) VALUES('$name','$bookid')";
                if(mysqli_num_rows($result)>0)
                {
                  while($eachrow = mysqli_fetch_assoc($result))
                  {
                    if($eachrow['CardNumber'] == $cardnumber AND $eachrow['SecurityCode'] == $cvv AND $eachrow['ExpiryDate'] == $expdate )
                    {
                      $resultbook = mysqli_query($connect,$sqlbook) or die(mysqli_error());
                      header("Location: ../purchaseSuccess.html");
                    }
                    else
                    {
                      header("Location: ../error.html");
                    }
                  }
                }
                  else
                  {
                    $sql2 = "INSERT INTO bankcard(CardNumber,AccountUsername,NameOnCard,ExpiryDate,SecurityCode)
                              VALUES ('$cardnumber','$name','$cardname', '$expdate','$cvv')";

                    if(mysqli_query($connect,$sql2))
                    {
                      $resultbook = mysqli_query($connect,$sqlbook) or die(mysqli_error());
                      header("Location: ../purchaseSuccess.html");
                    }
                    else
                    {
                      header("Location: ../error.html");
                    }
                  }
         }
         function test_input($data)
         {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
         }
         ?>
