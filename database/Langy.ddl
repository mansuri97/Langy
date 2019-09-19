CREATE TABLE Account (
  Username            varchar(255) NOT NULL,
  Password            varchar(255) NOT NULL,
  ParentalControlsPIN varchar(4) DEFAULT '1111' NOT NULL,
  Friends             varchar(255) NULL,
  LearningLanguage    varchar(255) DEFAULT 'French' NOT NULL,
  PRIMARY KEY (Username));

CREATE TABLE LearningLanguage (
  LearningLanguage varchar(255) NOT NULL,
  PRIMARY KEY (LearningLanguage));

CREATE TABLE Book (
  ID           varchar(255) NOT NULL,
  Title        varchar(255) NOT NULL,
  Author       varchar(255) NOT NULL,
  Genre        varchar(255) NOT NULL,
  ReadingLevel varchar(255) NOT NULL,
  Description  varchar(255) NOT NULL,
  PRIMARY KEY (ID));

CREATE TABLE Account_Book (
  AccountUsername varchar(255) NOT NULL,
  BookID          varchar(255) NOT NULL,
  PRIMARY KEY (AccountUsername,
  BookID));

CREATE TABLE BankCard (
  CardNumber      varchar(16) NOT NULL,
  AccountUsername varchar(255) NOT NULL,
  NameOnCard      varchar(255) NOT NULL,
  ExpiryDate      varchar(4) NOT NULL,
  SecurityCode    varchar(3) NOT NULL,
  PRIMARY KEY (CardNumber));

CREATE TABLE Child (
  AccountUsername varchar(255) NOT NULL,
  FirstName       varchar(255) NOT NULL,
  PRIMARY KEY (AccountUsername));

CREATE TABLE Parent (
  AccountUsername varchar(255) NOT NULL,
  FirstName       varchar(255) NOT NULL,
  PRIMARY KEY (AccountUsername));

ALTER TABLE Account_Book ADD CONSTRAINT FKAccount_Bo180560 FOREIGN KEY (BookID) REFERENCES Book (ID);
ALTER TABLE Account_Book ADD CONSTRAINT FKAccount_Bo687779 FOREIGN KEY (AccountUsername) REFERENCES Account (Username);

ALTER TABLE Account ADD CONSTRAINT FKAccount797900 FOREIGN KEY (LearningLanguage) REFERENCES LearningLanguage (LearningLanguage);

ALTER TABLE BankCard ADD CONSTRAINT FKBankCard552372 FOREIGN KEY (AccountUsername) REFERENCES Account (Username);

ALTER TABLE Parent ADD CONSTRAINT FKParent134571 FOREIGN KEY (AccountUsername) REFERENCES Account (Username);

ALTER TABLE Child ADD CONSTRAINT FKChild497152 FOREIGN KEY (AccountUsername) REFERENCES Account (Username);

INSERT INTO LearningLanguage(LearningLanguage) VALUES ('French');
INSERT INTO LearningLanguage(LearningLanguage) VALUES ('Swedish');
INSERT INTO LearningLanguage(LearningLanguage) VALUES ('German');

INSERT INTO Account(Username, Password, ParentalControlsPIN, Friends, LearningLanguage) VALUES ('shona', '5f4dcc3b5aa765d61d8327deb882cf99', '1111', null, 'French');
INSERT INTO Account(Username, Password, ParentalControlsPIN, Friends, LearningLanguage) VALUES ('david', '5f4dcc3b5aa765d61d8327deb882cf99', '1111', null, 'French');
INSERT INTO Account(Username, Password, ParentalControlsPIN, Friends, LearningLanguage) VALUES ('adam', '5f4dcc3b5aa765d61d8327deb882cf99', '1111', null, 'French');
INSERT INTO Account(Username, Password, ParentalControlsPIN, Friends, LearningLanguage) VALUES ('yogesh', '5f4dcc3b5aa765d61d8327deb882cf99', '1111', null, 'French');
INSERT INTO Account(Username, Password, ParentalControlsPIN, Friends, LearningLanguage) VALUES ('mehshan', '5f4dcc3b5aa765d61d8327deb882cf99', '1111', null, 'French');

INSERT INTO BankCard(CardNumber, AccountUsername, NameOnCard, ExpiryDate, SecurityCode) VALUES ('1234567812345678', 'shona', 'S LOWDEN', '0519', '111');
INSERT INTO BankCard(CardNumber, AccountUsername, NameOnCard, ExpiryDate, SecurityCode) VALUES ('1212454512124545', 'david', 'D HOPES', '0519', '111');
INSERT INTO BankCard(CardNumber, AccountUsername, NameOnCard, ExpiryDate, SecurityCode) VALUES ('2234567812345678', 'adam', 'A MANSURI', '0519', '111');
INSERT INTO BankCard(CardNumber, AccountUsername, NameOnCard, ExpiryDate, SecurityCode) VALUES ('2212454512124545', 'yogesh', 'Y SADAPHUL', '0519', '111');
INSERT INTO BankCard(CardNumber, AccountUsername, NameOnCard, ExpiryDate, SecurityCode) VALUES ('3234567812345678', 'mehshan', 'M KHAN', '0519', '111');

INSERT INTO Parent(AccountUsername, FirstName) VALUES ('shona', 'Shona');
INSERT INTO Parent(AccountUsername, FirstName) VALUES ('david', 'David');
INSERT INTO Parent(AccountUsername, FirstName) VALUES ('adam', 'Adam');
INSERT INTO Parent(AccountUsername, FirstName) VALUES ('yogesh', 'Yogesh');
INSERT INTO Parent(AccountUsername, FirstName) VALUES ('mehshan', 'Mehshan');

INSERT INTO Child(AccountUsername, FirstName) VALUES ('shona', 'Shannon');
INSERT INTO Child(AccountUsername, FirstName) VALUES ('david', 'Davey');
INSERT INTO Child(AccountUsername, FirstName) VALUES ('adam', 'Adrian');
INSERT INTO Child(AccountUsername, FirstName) VALUES ('yogesh', 'Yosef');
INSERT INTO Child(AccountUsername, FirstName) VALUES ('mehshan', 'Mason');

INSERT INTO Book(ID, Title, Author, Genre, ReadingLevel, Description) VALUES (
  '1',
  'Alice\'s Adventures in Wonderland',
  'Lewis Carroll',
  'Fantasy',
  'Hard',
  'A child in the mid-Victorian era, Alice unintentionally goes on an underground adventure after accidentally falling down a rabbit hole into Wonderland.');
INSERT INTO Book(ID, Title, Author, Genre, ReadingLevel, Description) VALUES (
  '2',
  'The Very Hungry Caterpillar',
  'Eric Carle',
  'Weekdays, Numbers, Food',
  'Easy',
  'This story follows the life cycle of a caterpillar as it starts by coming out of its egg, all the way to becoming a butterfly. It teaches the days of the week and counting up to five.');
INSERT INTO Book(ID, Title, Author, Genre, ReadingLevel, Description) VALUES (
  '3',
  'The Rainbow Fish',
  'Marcus Pfister',
  'Sharing, Animals',
  'Medium',
  'The story is about a fish with shiny, multi-colored scales named the Rainbow Fish. One day, a small fish asks him if he could have one, to which the Rainbow Fish refuses in a very rude manner.');
INSERT INTO Book(ID, Title, Author, Genre, ReadingLevel, Description) VALUES (
  '4',
  'The Tale of Peter Rabbit',
  'Beatrix Potter',
  'Animals, Food',
  'Hard',
  'This book follows mischievous and disobedient young Peter Rabbit as he is chased about the garden of Mr. McGregor. He escapes and returns home to his mother, who puts him to bed after dosing him with tea.');

INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('shona','2');
INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('shona','1');
INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('david','2');
INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('adam','2');
INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('yogesh','2');
INSERT INTO Account_Book(AccountUsername, BookID) VALUES ('mehshan','2');
