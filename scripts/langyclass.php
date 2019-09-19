<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'langy';

$connect =  mysqli_connect($host, $user, $pass, $db);
if(! $connect){
    die('Could not connect' . mysqli_error());
}

class Book{
    private $id;
    private $title;
    private $author;
    private $genre;
    private $readinglevel;
    private $description;
    private $booktext;

    function __construct($Bookid,$bookname,$aut,$gen,$level,$desc){
      $this->id = $Bookid;
      $this->title = $bookname;
      $this->author = $aut;
      $this->genre = $gen;
      $this->readinglevel = $level;
      $this->description = $desc;

    }
    function setId($Bookid){
        $this->id = $Bookid;
    }

    function getId(){
        return $this->id;
    }

    function setTitle($bookname){
        $this->title = $bookname;
    }

    function getTitle(){
        return $this->title;
    }

    function setAuthor($aut){
        $this->author = $aut;
    }

    function getAuthor(){
        return $this->author;
    }

    function setGenre($gen){
        $this->genre = $gen;
    }

    function getGenre(){
        return $this->genre;
    }

    function setReadinglevel($level){
        $this->readinglevel = $level;
    }

    function getReadinglevel(){
        return $this->readinglevel;
    }


    function setDescription($desc){
        $this->description = $desc;
    }

    function getDescription(){
        return $this->description;
    }

    function setBooktext($text){
        $this->booktext = $text;
    }

    function getBooktext(){
        return $this->booktext;
    }

}
/*-----------------------------------Intialising the book object---------------------------------------------------------------------------*/

/*-----------------Alice book------------------------*/
$sql = "SELECT b.ID, b.Title, b.Author,b.Genre,b.ReadingLevel, b.Description FROM book b WHERE b.ID = '1'";
$result = mysqli_query($connect,$sql) or die(mysqli_error());
$row = mysqli_fetch_row($result);
$alice =  new Book($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
$_SESSION['encodeAlice'] = serialize($alice);
/*-------------Caterpillar book---------------------------*/
$sql1 = "SELECT b.ID, b.Title, b.Author,b.Genre,b.ReadingLevel, b.Description FROM book b WHERE b.ID = '2'";
$result1 = mysqli_query($connect,$sql1) or die(mysqli_error());
$row1 = mysqli_fetch_row($result1);
$caterpillar =  new Book($row1[0],$row1[1],$row1[2],$row1[3],$row1[4],$row1[5]);
$_SESSION['encodeCaterpillar'] = serialize($caterpillar);
/*-------------Caterpillar book---------------------------*/
$sql2 = "SELECT b.ID, b.Title, b.Author,b.Genre,b.ReadingLevel, b.Description FROM book b WHERE b.ID = '3'";
$result2 = mysqli_query($connect,$sql2) or die(mysqli_error());
$row2 = mysqli_fetch_row($result2);
$rainbowfish =  new Book($row2[0],$row2[1],$row2[2],$row2[3],$row2[4],$row2[5]);
$_SESSION['encodeRainbowfish'] = serialize($rainbowfish);
/*-------------Caterpillar book---------------------------*/
$sql3 = "SELECT b.ID, b.Title, b.Author,b.Genre,b.ReadingLevel, b.Description FROM book b WHERE b.ID = '4'";
$result3 = mysqli_query($connect,$sql3) or die(mysqli_error());
$row3 = mysqli_fetch_row($result3);
$rabbit =  new Book($row3[0],$row3[1],$row3[2],$row3[3],$row3[4],$row3[5]);
$_SESSION['encodeRabbit'] = serialize($rabbit);
/*--------------------Account Class------------------------------*/
class Account {

        public $username;
        public $password;
        private $owedBooks;
        private $child;
        private $parent;
        private $bankcards;
        private $pin;

    function __construct($user, $pass){
        $this->username = $user;
        $this->password = $pass;
    }


    function addChild($child) {
        if ($this->child == null) {
            $this->child = $child;
            $this->child->setAccount($this);
            return true;
        } else {
            throw "Account already has a child object";
        }
    }

    function addParent($parent) {
        if ($this->parent == null) {
            $this->parent = $parent;
            $this->parent->setAccount($this);
            return true;
        } else {
            throw "Account already has a parent object";
        }
    }

    function getUsername() {
        return $this->username;
    }

    function setUsername($user) {
        $this->username = $user;
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($pass) {
        $this->password = $pass;
    }

    function addBankCard($card) {
        $card->setAccount($this);
        $this->bankcards->push($card);
    }

    function getBankcards() {
        return $this->bankcards;
    }

    function setParentalControlsPin($pin) {
        $this->pin = $pin;
    }

    function addBookToAccount($book) {
        $this->ownedBooks->push($book);
    }

    function viewOwnedBooks() {
        return $this->ownedBooks;
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    function getPIN() {
        return $this->pin;
    }
}

class User {
    function __construct($firstName) {
        $this->firstName = $firstName;
        $this->account = null;
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    function setAccount($account) {
        $this->account = $account;
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    function getAccount() {
        return $this->account;
    }
    // FIXME THIS IS UNNECESSARY AS ALREADY IMPLEMENTED IN ACCOUNT
    function viewOwnedBooks() {
        return $this->getAccount()->viewOwnedBooks();
    }
}

class Child extends User {
    function __construct($firstName) {
        super($firstName);
    }
}

class Parents extends User {
    function __construct($firstName) {
        super($firstName);
    }

    // FIXME SHOULD HAVE A METHOD FOR CHECKING PIN TO ALLOW FOR BETTER CODE

    function purchaseBook($book, $pin) {
        if ($pin === $this->getAccount()->getPIN()) {
            $this->getAccount()->ownedBooks->push($book);
            return true;
        } else {
            return false;
        }
    }

    function viewBankCards() {
        return $this->getAccount()->getBankcards();
    }

    function changePassword($oldPassword, $newPassword, $pin) {
        if ($oldPassword == $this->getAccount()->getPassword() && $pin == $this->getAccount()->getPIN()) {
            $this->account->setPassword($newPassword);
            return true;
        } else {
            return false;
        }
    }

    function addBankCard($pin, $cardNumber, $nameOnCard, $expiryDate, $securityCode) {
        if ($pin == $this->getAccount()->getPin()) {
            $this->account->addBankCard(
                new BankCard(
                    $cardNumber,
                    $nameOnCard,
                    $expiryDate,
                    $securityCode)
            );
            return true;
        } else {
            return false;
        }
    }

    function removeBankCard($pin, $card) {
        if ($this->getAccount()->getPIN() == $pin) {
            $this->bankcards->splice($this->bankcards->indexOf($card), 1);
            return true;
        } else {
            return false;
        }
    }

    function editBankCard($pin, $card, $newCardNumber, $newNameOnCard, $newExpiryDate, $newSecurityCode) {
        if ($pin == $this->getAccount()->getPin()) {
            $card->setCardNumber($newCardNumber);
            $card->setNameOnCard($newNameOnCard);
            $card->setExpiryDate($newExpiryDate);
            $card->setSecurityCode($newSecurityCode);
            return true;
        } else {
            return false;
        }
    }

    function setPin($pin) {
            $this->getAccount()->setPin($pin);
            return true;
    }

    function editPin($newPIN, $oldPIN) {
        if ($oldPin == $this->getAccount()->getPIN()) {
            $this->getAccount()->setPin($newPIN);
            return true;
        } else {
            return false;
        }
    }

    function monitorProgress() {
        // TODO Implement this function
        throw "monitorProgress function not yet implemented";
    }
}

class BankCard{
  private $cardnumber;
  private $cardname;
  private $expiryDate;
  private $securityCode;
  function __construct($cardnumber,$cardname,$expiryDate,$securityCode){
    $this->cardnumber= $cardnumber;
    $this->cardname = $cardname;
    $this->expiryDate = $expiryDate;
    $this->securityCode= $securityCode;
  }
  function getcardName(){
    return $this->cardname;
  }
  function setcardName($cardname){
    $this->cardname = $cardname;
  }
  function getcardNumber(){
    return $this->cardnumber;
  }
  function setcardNumber($cardnumber){
    $this->cardnumber = $cardnumber;
  }
  function getexpDate(){
    return $this->expiryDate;
  }
  function setexpDate($expDate){
    $this->expDate = $expDate;
  }
  function getsecurityCode(){
    return $this->securityCode;
  }
  function setsecurityCode($securityCode){
    $this->securityCode = $securityCode;
  }
}

?>
