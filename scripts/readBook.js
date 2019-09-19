/* ================
  Book object code
=================== */
class Book {
  constructor(id, title, author, genre, readingLevel, description, translatableWords, foreignWords, bookText) {
    this.id = id;
    this.title = title;
    this.author = author;
    this.genre = genre;
    this.readingLevel = readingLevel;
    this.description = description;
    this.translatableWords = translatableWords;
    this.foreignWords = foreignWords;
    this.bookText = bookText;
  }
  getId() {
    return this.id;
  }
  getTitle() {
    return this.title;
  }
  getAuthor() {
    return this.author;
  }
  getGenre() {
    return this.genre;
  }
  getReadingLevel() {
    return this.readingLevel;
  }
  getDescription() {
    return this.description;
  }
  getTranslatableWords() {
    return this.translatableWords;
  }
  getForeignWords() {
    return this.foreignWords;
  }
  getBookText() {
    return this.bookText;
  }
}

/* ================
  Make books
  Uses the book class properly
  Does not take data from database/files
=================== */
let bk_1 = make_1();
let bk_2 = make_2();
let bk_3 = make_3();
let bk_4 = make_4();

/* ================
  Display a book
=================== */
function displayBook(book) {
  try {

    // show book info in top
    document.querySelector("#title").textContent = book.getTitle();
    document.querySelector("#subtitle").textContent = book.getAuthor();

    // add each paragraph to main
    for (var i = 0; i < book.getBookText().length; i++){
      let div = document.createElement("div");
      div.setAttribute("class", "bookParagraph");
      let para =  book.getBookText()[i];
      // style the translatable words
      for (var j = 0; j < book.getTranslatableWords().length; j++){
        let englishWord = book.getTranslatableWords()[j];
        let foreignWord = book.getForeignWords()[j];
        let regex = new RegExp("\\b" + englishWord + "\\b", "gi");
        let replacement = "<button class=\"tappyWord\">" + foreignWord + "<span>" + englishWord + "</span></button>";
        para = para.replace(regex, replacement);
        div.innerHTML = para;
      }
      // then add the styled paragraph
      document.querySelector("#main").appendChild(div);
    }
  }
  catch (ex) {
    console.error("displayBook failed: " + ex);
  }
}

/* ================
  Get book ID from url
=================== */
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

/* ================
  Show the selected book!
=================== */
switch (getUrlVars()["book"]){
  case "1":
    displayBook(bk_1);
    break;
  case "2":
    displayBook(bk_2);
    break;
  case "3":
    displayBook(bk_3);
    break;
  case "4":
    displayBook(bk_4);
    break;

  // error if URL param issues
  default:
    let div = document.createElement("div");
    div.setAttribute("class", "bookParagraph");
    let para =  "<center>An error occured.<br />Please <a href=\"../ownedBooks.html\">select a different book</a>.</center>";
    div.innerHTML = para;
    document.querySelector("#main").appendChild(div);
}

/* ================
  Hard-coded book object creation
=================== */
function make_1() {
  let p1 = "Alice was beginning to get very tired of sitting by her sister on the bank, and of having nothing to do. Once or twice she had peeped into the book her sister was reading, but it had no pictures or conversations in it, 'and what is the use of a book,' thought Alice, 'without pictures or conversations?'";
  let p2 = "So she was considering in her own mind (as well as she could, for the day made her feel very sleepy and stupid), whether the pleasure of making a daisy-chain would be worth the trouble of getting up and picking the daisies, when suddenly a White Rabbit with pink eyes ran close by her.";
  let p3 = "There was nothing so very remarkable in that, nor did Alice think it so very much out of the way to hear the Rabbit say to itself, 'Oh dear! Oh dear! I shall be too late!' But when the Rabbit actually took a watch out of its waistcoat-pocket and looked at it and then hurried on, Alice started to her feet, for it flashed across her mind that she had never before seen a rabbit with either a waistcoat-pocket, or a watch to take out of it, and, burning with curiosity, she ran across the field after it and was just in time to see it pop down a large rabbit-hole, under the hedge. In another moment, down went Alice after it!";
  let p4 = "The rabbit-hole went straight on like a tunnel for some way and then dipped suddenly down, so suddenly that Alice had not a moment to think about stopping herself before she found herself falling down what seemed to be a very deep well.";
  let p5 = "Either the well was very deep, or she fell very slowly, for she had plenty of time, as she went down, to look about her. First, she tried to make out what she was coming to, but it was too dark to see anything; then she looked at the sides of the well and noticed that they were filled with cupboards and book-shelves; here and there she saw maps and pictures hung upon pegs. She took down a jar from one of the shelves as she passed. It was labeled 'ORANGE MARMALADE,' but, to her great disappointment, it was empty; she did not like to drop the jar, so managed to put it into one of the cupboards as she fell past it.";
  let p6 = "Down, down, down! Would the fall never come to an end? There was nothing else to do, so Alice soon began talking to herself. 'Dinah'll miss me very much to-night, I should think!'";
  let bkText = [p1,p2,p3,p4,p5,p6];
  let bkTranslatableWords = ["sister","book","pictures","rabbit","cupboards"];
  let bkForeignWords = ["sœur","livre","des photos","lapin","placards"];
  let bk_1 = new Book(
    "1",
    "Alice's Adventures in Wonderland",
    "Lewis Carroll",
    "Fantasy",
    "Hard",
    "A child in the mid-Victorian era, Alice unintentionally goes on an underground adventure after accidentally falling down a rabbit hole into Wonderland.",
    bkTranslatableWords,
    bkForeignWords,
    bkText
  )
  return bk_1;
}
function make_2() {
  let p1 = "In the light of the moon a little egg lay on a leaf.";
  let p2 = "One Sunday morning the warm sun came up and - pop! - out of the egg came a tiny and very hungry Caterpillar.";
  let p3 = "He started to look for some food.";
  let p4 = "On Monday he ate through one apple. But he was still hungry.";
  let p5 = "On Tuesday he ate through two pears, but he was still hungry.";
  let p6 = "On Wednesday he ate through three plums, but he was still hungry.";
  let p7 = "On Thursday he ate through four strawberries, but he was still hungry.";
  let p8 = "On Friday he ate through five oranges, but he was still hungry.";
  let p9 = "On Saturday he ate through one piece of chocolate cake, one ice cream cone, one pickle, one slice of Swiss cheese, one slice of salami, one lollipop, one piece of cherry pie, one sausage, one cupcake, and one slice of watermelon. That night he had a stomach ache!";
  let p10 = "The very hungry Caterpillar then ate through one green leaf. He started to feel better.";
  let p11 = "Now, the caterpillar was no longer small. He was a big, fat, caterpillar.";
  let p12 = "He built a small house, called a cocoon around himself. He stayed inside for more than two weeks. Then he nibbled a small hole in the cocoon, pushed his way out and...";
  let p13 = "A beautiful butterfly!";
  let bkText = [p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13];
  let bkTranslatableWords = ["caterpillar","hungry","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday","two","three","four","five","food","apple","pears","plums","strawberries","oranges","chocolate","cake","cheese","salami","lollipop","cherry","pie","sausage","cupcake","watermelon","leaf","small","big","butterfly"];
  let bkForeignWords = ["chenille", "faim", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche", "deux", "trois", "quatre", "cinq", "nourriture", "pomme", "poires", "prunes", "fraises", "oranges", "chocolat", "gâteau", "fromage", "salami", "sucette", "cerise", "tarte", "saucisse", "cupcake", "melon d'eau", "feuille", "petit", "grand", "papillon"];
  let bk_2 = new Book(
    "2",
    "The Very Hungry Caterpillar",
    "Eric Carle",
    "Weekdays, Numbers, Food",
    "Easy",
    "This story follows the life cycle of a caterpillar as it starts by coming out of its egg, all the way to becoming a butterfly. It teaches the days of the week and counting up to five.",
    bkTranslatableWords,
    bkForeignWords,
    bkText
  )
  return bk_2;
}
function make_3() {
  let p1 = "Far out in the sea lived a fish.  No ordinary fish, however. He was the most beautiful fish in the entire ocean. His scales shimmered with all the colours of the rainbow. ";
  let p2 = "The other fish admired his colourful scales and called him Rainbow Fish. \"Come on, play with us, Rainbow Fish!\" But Rainbow Fish was proud and swam past them.";
  let p3 = "A little blue fish swam along behind him. \"Rainbow Fish, wait for me! Please give me one of your glittering scales. They are so beautiful and you have got so many!\"";
  let p4 = "\"Give you one of my scales? What are you thinking of?\", cried Rainbow Fish. \"Get away from me!\" Shocked, the little blue fish swam away.\"";
  let p5 = "Still upset, he told his friends about it. From then on nobody wanted any more to do with Rainbow Fish. They turned away when he swam past them.";
  let p6 = "What use were Rainbow Fish’s beautiful scales, if they were no longer admired by anyone? Now he was the loneliest fish in the entire ocean! One day he poured out his sorrow to the starfish. \"I’m so beautiful. Why doesn’t anyone like me?\"";
  let p7 = "\"In a cave behind the coral reef lives the wise octopus. Perhaps he can help you,\" the starfish advised him.";
  let p8 = "Rainbow Fish found the cave. It was very dark here. He could hardly see anything. Then suddenly he saw two glowing eyes.";
  let p9 = "\"I have been expecting you,\" said the octopus in a deep voice. \"The waves have told me your story. Listen to my advice: give every fish one of your glittering scales. Then you may not be the most beautiful fish in the ocean, but you will be happy again.\"";
  let p10 = "\"But ...\" Rainbow Fish began to say, but octopus had already disappeared in a dark cloud of ink. \"Give away my scales? My beautiful glittering scales?\" thought Rainbow Fish, horrified. \"Never! No. How could I be happy without them?\"";
  let p11 = "Suddenly he felt the light touch of a fin. The little blue fish was back! \"Rainbow Fish, please, don’t be angry. Please give me one of your glittering scales, a small one.\" Rainbow Fish hesitated. \"A very, very small scale, he thought. Why not, I will hardly miss it.\"";
  let p12 = "Rainbow Fish carefully pulled off the very smallest of his glittering scales. \"Here, I’ll give you this one! But now leave me in peace!\"";
  let p13 = "\"Thank you, thank you very much!\" burbled the little blue fish excitedly. \"You are kind, Rainbow Fish.\" Rainbow Fish felt quite strange. He watched the little blue fish for a long time as he swam away happily through the water with his glittering scale, turning this way and that.";
  let p14 = "The little blue fish darted through the water with his glittering scale. Soon Rainbow Fish was surrounded by other fish. All of them wanted to have a glittering scale. Rainbow Fish shared out his scales and felt happier and happier as he did so. Finally Rainbow Fish had only one glittering scale left. He had given away all the others! And he was happy, happier than he had ever been!";
  let p15 = "\"Come on, Rainbow Fish, come and play with us!\" called the others. \"I’m coming!\" said Rainbow Fish and went happily with the other fish.";
  let bkText = [p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15];
  let bkTranslatableWords = ["fish","scales","scale","starfish","octopus","ocean","beautiful","glittering"];
  let bkForeignWords = ["poisson", "écailles", "écaille", "étoile de mer", "pieuvre", "océan", "belle", "scintillante"];
  let bk_3 = new Book(
    "3",
    "The Rainbow Fish",
    "Marcus Pfister",
    "Sharing, Animals",
    "Medium",
    "The story is about a fish with shiny, multi-colored scales named the Rainbow Fish. One day, a small fish asks him if he could have one, to which the Rainbow Fish refuses in a very rude manner.",
    bkTranslatableWords,
    bkForeignWords,
    bkText
  )
  return bk_3;
}
function make_4() {
  let p1 = "Once upon a time there were four little Rabbits, and their names were Flopsy, Mopsy, Cotton-tail, and Peter.";
  let p2 = "They lived with their Mother in a sand-bank, underneath the root of a very big fir-tree.";
  let p3 = "'Now, my dears,' said old Mrs. Rabbit one morning, 'you may go into the fields or down the lane, but don't go into Mr. McGregor's garden: your Father had an accident there; he was put in a pie by Mrs. McGregor.'";
  let p4 = "'Now run along, and don't get into mischief. I am going out.'";
  let p5 = "Then old Mrs. Rabbit took a basket and her umbrella, and went through the wood to the baker's. She bought a loaf of brown bread and five currant buns.";
  let p6 = "Flopsy, Mopsy, and Cotton-tail, who were good little bunnies, went down the lane to gather blackberries: But Peter, who was very naughty, ran straight away to Mr. McGregor's garden, and squeezed under the gate!";
  let p7 = "First he ate some lettuces and some French beans; and then he ate some radishes; and then, feeling rather sick, he went to look for some parsley.";
  let p8 = "But round the end of a cucumber frame, whom should he meet but Mr. McGregor! Mr. McGregor was on his hands and knees planting out young cabbages, but he jumped up and ran after Peter, waving a rake and calling out, 'Stop thief!'";
  let p9 = "Peter was most dreadfully frightened; he rushed all over the garden, for he had forgotten the way back to the gate. He lost one of his shoes among the cabbages, and the other shoe amongst the potatoes.";
  let p10 = "After losing them, he ran on four legs and went faster, so that I think he might have got away altogether if he had not unfortunately run into a gooseberry net, and got caught by the large buttons on his jacket. It was a blue jacket with brass buttons, quite new.";
  let p11 = "Peter gave himself up for lost, and cried big tears; but his sobs were overheard by some friendly sparrows, who flew to him in great excitement, and implored him to exert himself.";
  let p12 = "Mr. McGregor came up with a sieve, which he intended to pop upon the top of Peter; but Peter wriggled out just in time, leaving his jacket behind him.";
  let bkText = [p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12];
  let bkTranslatableWords = ["rabbit", "rabbits", "mother", "father", "bread", "blackberries", "lettuces", "beans", "radishes", "parsley", "cucumber", "cabbages", "potatoes", "gooseberry", "jacket"];
  let bkForeignWords = ["lapin", "lapins", "mère", "père", "pain", "mûres", "salades", "haricots", "radis", "persil", "concombre", "choux", "pommes de terre ","groseille","veste"];
  let bk_4 = new Book(
    "4",
    "The Tale of Peter Rabbit",
    "Beatrix Potter",
    "Animals, Food",
    "Hard",
    "This book follows mischievous and disobedient young Peter Rabbit as he is chased about the garden of Mr. McGregor. He escapes and returns home to his mother, who puts him to bed after dosing him with tea.",
    bkTranslatableWords,
    bkForeignWords,
    bkText
  )
  return bk_4;
}

// Use this code to make tappyWord do something when clicked
//
// let buttons = document.getElementsByClassName("tappyWord");
// for (var i = 0; i < buttons.length; i++) {
//     let button = buttons[i];
//     button.onclick = function() {
//       document.querySelector("#SOMEDIVIDGOESHERE").textContent = this.firstElementChild.textContent;
//     }
// }
