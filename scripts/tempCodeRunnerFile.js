class Leaderboard {
    constructor() {
        if (!Leaderboard.instance) {
            this.accounts = [];
            Leaderboard.instance = this;
        }
        return Leaderboard.instance;
    }

    addAccount(account) {
        if (!this.accounts.includes(account)) {
            this.accounts.push(account);
        } else {
            throw "User account already exists in Leaderboard"
        }
    }

    removeAccount(account) {
        this.accounts.splice(this.accounts.indexOf(account), 1)
    }

    getAccounts() {
        return this.accounts;
    }
}

class Account {
    constructor(username, password) {
        this.username = username;
        this.password = password;
        this.ownedBooks = [];
        this.child = null;
        this.parent = null;
        this.bankcards = [];
        this.pin = null;
    }

    addChild(child) {
        if (this.child == null) {
            this.child = child;
            this.child.setAccount(this);
            return true;
        } else {
            throw "Account already has a child object"
        }
    }

    addParent(parent) {
        if (this.parent == null) {
            this.parent = parent;
            this.parent.setAccount(this);
            return true;
        } else {
            throw "Account already has a parent object"
        }
    }

    getUsername() {
        return this.username;
    }

    setUsername(username) {
        this.username = username;
    }

    getPassword() {
        return this.password;
    }

    setPassword() {
        this.password = password;
    }

    addBankCard(card) {
        card.setAccount(this);
        this.bankcards.push(card);
    }

    getBankcards() {
        return this.bankcards;
    }

    setParentalControlsPin(pin) {
        this.pin = pin;
    }

    addBookToAccount(book) {
        this.ownedBooks.push(book);
    }

    viewOwnedBooks() {
        return this.ownedBooks;
    }

    // FIXME THIS WILL BE HARD TO IMPLEMENT AS PER CLASS DIAGRAM, CURRENTLY JUST FILTERS TITLE
    filterBooks(option) {
        let filteredBooks = this.ownedBooks.filter(book => book.getTitle().includes(option))
        return filteredBooks;
    }

    deleteAccount() {
        // TODO Not yet implemented
        throw "deleteAccount function not yet implemented";
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    getPIN() {
        return this.pin;
    }
}

class User {
    constructor(firstName) {
        this.firstName = firstName;
        this.account = null;
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    setAccount(account) {
        this.account = account;
    }

    // THIS WAS NOT ON CLASS DIAGRAM
    getAccount() {
        return this.account;
    }
    // FIXME THIS IS UNNECESSARY AS ALREADY IMPLEMENTED IN ACCOUNT
    viewOwnedBooks() {
        return this.getAccount().viewOwnedBooks();
    }
}

class Child extends User {
    constructor(firstName) {
        super(firstName)
    }
}

class Parent extends User {
    constructor(firstName) {
        super(firstName)
    }

    // FIXME SHOULD HAVE A METHOD FOR CHECKING PIN TO ALLOW FOR BETTER CODE

    purchaseBook(book, pin) {
        if (pin === this.getAccount().getPIN()) {
            this.getAccount().ownedBooks.push(book);
            return true;
        } else {
            return false;
        }
    }

    viewBankCards() {
        return this.getAccount().getBankcards();
    }

    changePassword(oldPassword, newPassword, pin) {
        if (oldPassword == this.getAccount().getPassword() && pin == this.getAccount().getPIN()) {
            this.account.setPassword(newPassword);
            return true;
        } else {
            return false;
        }
    }

    addBankCard(pin, cardNumber, nameOnCard, expiryDate, securityCode) {
        if (pin == this.getAccount().getPin()) {
            this.account.addBankCard(
                new BankCard(
                    cardNumber, 
                    nameOnCard, 
                    expiryDate, 
                    securityCode)
            );
            return true;
        } else {
            return false;
        }
    }

    removeBankCard(pin, card) {
        if (this.getAccount().getPIN() == pin) {
            this.bankcards.splice(this.bankcards.indexOf(card), 1);
            return true;
        } else {
            return false;
        }
    }

    editBankCard(pin, card, newCardNumber, newNameOnCard, newExpiryDate, newSecurityCode) {
        if (pin == this.getAccount().getPin()) {
            card.setCardNumber(newCardNumber);
            card.setNameOnCard(newNameOnCard);
            card.setExpiryDate(newExpiryDate);
            card.setSecurityCode(newSecurityCode);
            return true;
        } else {
            return false;
        }
    }

    setPin(pin) {
        try {
            this.getAccount().setPin(pin);
            return true;
        } catch (error) {
            return false;
        }
    }

    editPin(newPIN, oldPIN) {
        if (oldPin == this.getAccount().getPIN()) {
            this.getAccount().setPin(newPIN);
            return true;
        } else {
            return false;
        }
    }

    monitorProgress() {
        // TODO Implement this function
        throw "monitorProgress function not yet implemented";
    }

    selectBankCard(card) {
        // DOES NOT MAKE SENSE
    }
}

class Book {
    constructor(title, author, genre, readingLevel, bookText) {
        this.title = title;
        this.author = author;
        this.genre = genre;
        this.readingLevel = readingLevel;
        this.bookText = bookText;
    }

    getTitle() {
        return this.title;
    }
}

class BankCard {
    constructor(cardNumber, nameOnCard, expiryDate, securityCode) {
        this.cardNumber = cardNumber;
        this.nameOnCard = nameOnCard;
        this.expiryDate = expiryDate;
        this.securityCode = securityCode;
        this.account = null;
    }


    // FIXME THIS SHOULD HAVE BEEN IN THE ACCOUNT CLASS, IT LEADS TO RATHER BAD CODE
    addBankCardToAccount() {
        // UNECESSARY TRY/CATCH TO ALLOW FOR BOOLEAN RESPONSE, ARE WE EXPECTING AN ERROR
        // UPON INPUT OR SHOULD IT BE A PROCEDURE THAT THROWS AN ERROR IF SOMETHING GOES WRONG
        try {
            this.account.bankcards.push(this);
            return true;
        } catch (error) {
            return false;
        }
    }

    getCardNumber() {
        return this.cardNumber;
    }

    setCardNumber(cardNumber) {
        // UNECESSARY TRY/CATCH TO ALLOW FOR BOOLEAN RESPONSE, ARE WE EXPECTING AN ERROR
        // UPON INPUT OR SHOULD IT BE A PROCEDURE THAT THROWS AN ERROR IF SOMETHING GOES WRONG
        try {
            this.cardNumber = cardNumber;
            return true;
        } catch (error) {
            return false;
        }
    }

    getNameOnCard() {
        return this.nameOnCard;
    }

    setNameOnCard(name) {
        // UNECESSARY TRY/CATCH TO ALLOW FOR BOOLEAN RESPONSE, ARE WE EXPECTING AN ERROR
        // UPON INPUT OR SHOULD IT BE A PROCEDURE THAT THROWS AN ERROR IF SOMETHING GOES WRONG
        try {
            this.nameOnCard = name;
            return true;
        } catch (error) {
            return false;
        }
    }

    getExpiryDate() {
        return this.expiryDate;
    }

    setExpiryDate(expiryDate) {
        // UNECESSARY TRY/CATCH TO ALLOW FOR BOOLEAN RESPONSE, ARE WE EXPECTING AN ERROR
        // UPON INPUT OR SHOULD IT BE A PROCEDURE THAT THROWS AN ERROR IF SOMETHING GOES WRONG
        try {
            this.expiryDate = expiryDate;
            return true;
        } catch (error) {
            return false;
        }
    }

    getSecurityCode() {
        // FIXME BAD DESIGN FOR A SECURE SYSTEM
        return this.securityCode;
    }

    setSecurityCode(code) {
        // UNECESSARY TRY/CATCH TO ALLOW FOR BOOLEAN RESPONSE, ARE WE EXPECTING AN ERROR
        // UPON INPUT OR SHOULD IT BE A PROCEDURE THAT THROWS AN ERROR IF SOMETHING GOES WRONG
        try {
            this.securityCode = code;
            return true;
        } catch {
            return false;
        }
    }

    setAccount(account) {
        this.account = account;
    }
}

const leaderboard = new Leaderboard();
Object.freeze(leaderboard);

test_account = new Account("hopes", "abc123");

test_account.addChild(new Child("Owen"));
test_account.addParent(new Parent("Sandra"));

test_account.setParentalControlsPin("123");

leaderboard.addAccount(test_account);

testBook1 = new Book(
    "The Order of Time",
    "Carlo Rovelli",
    "Non-Fiction",
    "Advanced",
    "the quick brown fox jumped over the fence"
)

testBook2 = new Book(
    "Feral",
    "George Monbiot",
    "Non-Fiction",
    "Advanced",
    "the quick brown fox jumped over the fence"
)

testBook3 = new Book(
    "The Left Hand of Darkness",
    "Ursula K. Le Guin",
    "Science Fiction",
    "Advanced",
    "the quick brown fox jumped over the fence"
)

testBook4 = new Book(
    "The Mezzanine",
    "Nicholson Baker",
    "Fiction",
    "Basic",
    "the quick brown fox jumped over the fence"
)

console.log(leaderboard);

leaderboard.getAccounts()[0].addBookToAccount(testBook2)
leaderboard.getAccounts()[0].addBookToAccount(testBook1)
leaderboard.getAccounts()[0].addBookToAccount(testBook3)
leaderboard.getAccounts()[0].addBookToAccount(testBook4)

leaderboard.getAccounts()[0].filterBooks("mezzanine").map(function (book) {
    console.log(book.getTitle());
})

// TODO There should be a getParent function in Account class
leaderboard.getAccounts()[0].parent.viewOwnedBooks().map(function (book) {
    console.log(book.getTitle())
});

leaderboard.removeAccount(leaderboard.getAccounts()[0]);
console.log(leaderboard)