Drop database if exists php_project;
CREATE DATABASE IF NOT EXISTS  php_project;
use php_project;



-- creating table 
-- creating person table 1
CREATE TABLE IF NOT EXISTS `person`(
`id` INT AUTO_INCREMENT,
`name` VARCHAR(85) NOT NULL,
`email` VARCHAR(150) NOT NULL UNIQUE,
`dob` DATE NOT NULL,
`city` VARCHAR(100) NOT NULL,
`state` VARCHAR(100) NOT NULL,
`country` VARCHAR(100) NOT NULL,
`pin_code` VARCHAR(100) NOT NULL,
`phone_num` VARCHAR(50) NOT NULL UNIQUE,
`password` VARCHAR(85) NOT NULL,
PRIMARY KEY person_pk(`id`)
);

-- creating subscription table 6
CREATE TABLE IF NOT EXISTS `subscriptions`(
	`id` INT AUTO_INCREMENT,
    `title` VARCHAR (85),
    `price` VARCHAR(85),
    `no_book_to_issue` INT,
    `fine_amount` INT,
    `no_of_days_to_return` INT,
    `time_period` INT, 
    PRIMARY KEY subcription_pk (`id`)
);

-- creating user table 2
CREATE TABLE IF NOT EXISTS `customers`(
`id` INT,
`subscription_id` INT null ,
FOREIGN KEY subscription_fk(`subscription_id`) REFERENCES	`subscriptions`(`id`),
FOREIGN KEY user_fk (`id`) REFERENCES `person`(`id`),
PRIMARY KEY user_pk(`id`)
);

-- creating permissions tables 5
CREATE TABLE IF NOT EXISTS `permissions`(
`id` INT AUTO_INCREMENT,
`title` VARCHAR(50), 
`other_information` VARCHAR(150),
PRIMARY KEY permission_pk (`id`)
);


-- creating roles table 4
CREATE TABLE IF NOT EXISTS `roles`(
`id` INT AUTO_INCREMENT,
`title` VARCHAR(50) NOT NULL,
`description` VARCHAR(150),
`permission_id` INT,
FOREIGN KEY permissions_fk(`permission_id`)REFERENCES `permissions`(`id`),
PRIMARY KEY roles_pk(`id`)
);

-- creating staff_members table 3
CREATE TABLE IF NOT EXISTS `staff_members`(
`id` 	INT,
`salary` INT,
`role_id` INT unique,
FOREIGN KEY roles_fk(`role_id`) REFERENCES `roles`(`id`),
FOREIGN KEY person_fk (`id`) REFERENCES `person`(`id`),
PRIMARY KEY staff_member_pk(`id`)

);

-- creating publisher table 8
CREATE TABLE IF NOT EXISTS publishers(
`id` INT AUTO_INCREMENT,
`name` VARCHAR(85) not null unique,
`contact_info` VARCHAR(200),
PRIMARY KEY publisher_pk(`id`)
);
 

-- creating categories table 10
CREATE TABLE IF NOT EXISTS categories(
`id` INT AUTO_INCREMENT,
`name` VARCHAR(50) NOT NULL unique,
`description` VARCHAR(255),  
PRIMARY KEY category_pk(`id`)
);



-- creating author table 9
CREATE TABLE IF NOT EXISTS authors(
`id` INT AUTO_INCREMENT,
`name` VARCHAR(85)  NOT NULL UNIQUE,
`contact_info` VARCHAR(200),
PRIMARY KEY author_pk(`id`)
);



-- creating  book table 7
CREATE TABLE IF NOT EXISTS books(
`accession_no` INT AUTO_INCREMENT,
`title` VARCHAR(85) NOT NULL,
`condition` ENUM('best','good','bad'),
`language` VARCHAR(60),  
`edition` VARCHAR(31),
`publisher_id` INT NOT NULL,
`category_id` INT NOT NULL,
`author_id` INT NOT NULL,
FOREIGN KEY book_publisher_fk(`publisher_id`) references publishers(`id`),
FOREIGN KEY book_category_fk(`category_id`) references categories(`id`),
FOREIGN KEY book_author_fk(`author_id`) references authors(`id`),
PRIMARY KEY book_pk(`accession_no`)
);





-- creating borrow_books table 11
CREATE TABLE IF NOT EXISTS borrow_books(
`id` INT AUTO_INCREMENT,
`issue_date` DATE NOT NULL,
`return date` DATE,
`expected_return_date` DATE NOT NULL,
`book_id` int,
`customer_id` int,
foreign key book_borrow_books_fk (`book_id`) references `books`(`accession_no`),
foreign key user_borrow_books_fk (`customer_id`) references `customers`(`id`),
PRIMARY KEY borrow_books_pk(`id`)
);


-- Inserting data into tables
INSERT INTO `person`(`name`,`email`,`phone_num`,`city`,`state`,`country`,`pin_code`,`dob`,`password`)VALUES("gurpinder singh","singh@gmail.com","892329832","banga","punjab","india","144509","2000-11-15","password");
INSERT INTO `customers`(`id`) values (1);
INSERT INTO `authors`(`name`,`contact_info`) values ("parteek bhatia","bhatia@gmail.com");
INSERT INTO `categories`(`name`,`description`)values("Fiction","books about frictional stories");
INSERT INTO `publishers` (`name`, `contact_info`) values("Kalyani","publisherkalyani@gmail.com");
INSERT INTO `books`(`title`,`condition`,`language`,`edition`,`author_id`,`category_id`,`publisher_id`)values("programming in python","bad","english","1","1","1","1");

-- Retrieving data from tables
SELECT * FROM PERSON;
SELECT * FROM STAFF_MEMBERS;
SELECT * FROM CUSTOMERS;
SELECT * FROM BOOKS;
SELECT * FROM BORROW_BOOKS;
SELECT * FROM AUTHORS;
SELECT * FROM CATEGORIES;
SELECT * FROM PUBLISHERS;
SELECT * FROM ROLES;
SELECT * FROM SUBSCRIPTIONS;

-- DROPING TABLES
DROP TABLE IF EXISTS PERSON;
DROP TABLE IF EXISTS STAFF_MEMBERS;
DROP TABLE IF EXISTS CUSTOMERS;
DROP TABLE IF EXISTS BOOKS;
DROP TABLE IF EXISTS BORROW_BOOKS;
DROP TABLE IF EXISTS AUTHORS;
DROP TABLE IF EXISTS CATEGORIES;
DROP TABLE IF EXISTS PUBLISHERS;
DROP TABLE IF EXISTS ROLES;
DROP TABLE IF EXISTS SUBSCRIPTIONS;


-- DELETING DATA FROM TABLES
DELETE FROM PERSON;
DELETE FROM STAFF_MEMBERS;
DELETE FROM CUSTOMERS;
DELETE FROM BOOKS;
DELETE FROM BORROW_BOOKS;
DELETE FROM AUTHORS;
DELETE FROM CATEGORIES;
DELETE FROM PUBLISHERS;
DELETE FROM ROLES;
DELETE FROM SUBSCRIPTIONS;
show tables;

select last_insert_id() from person;
DELETE FROM CUSTOMERS WHERE id = 1;
delete from person where id = 1;
