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
CREATE TABLE IF NOT EXISTS `subscription_plans`(
	`id` INT AUTO_INCREMENT,
    `title` VARCHAR (85),
	`description` VARCHAR(255),
    `price` INT,
    `book_issue_limit` INT,
    `issue_days` INT,
    `time_period` INT, 
    PRIMARY KEY subcription_pk (`id`)
);

-- creating user table 2
CREATE TABLE IF NOT EXISTS `subscribers`(
`id` INT auto_increment,
`person_id` INT not null unique,
`subscription_id` INT null ,
FOREIGN KEY subscription_fk(`subscription_id`) REFERENCES	`subscription_plans`(`id`),
FOREIGN KEY user_fk (`person_id`) REFERENCES `person`(`id`),
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
`id` 	INT auto_increment,
`person_id` Int not null unique,
`salary` INT NOT NULL,
`role_id` INT ,
FOREIGN KEY roles_fk(`role_id`) REFERENCES `roles`(`id`),
FOREIGN KEY person_fk (`person_id`) REFERENCES `person`(`id`),
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
`contact_info` VARCHAR(255),  
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
`page_count` INT NOT NULL,
`year_of_publication` DATE NOT NULL,
`language` varchar(50) NOT NULL,
`volume` INT not null,
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
`subscriber_id` int,
foreign key book_borrow_books_fk (`book_id`) references `books`(`accession_no`),
foreign key user_borrow_books_fk (`subscriber_id`) references `subscribers`(`id`),
PRIMARY KEY borrow_books_pk(`id`)
);


-- Inserting data into tables
-- INSERT INTO `person`(`name`,`email`,`phone_num`,`city`,`state`,`country`,`pin_code`,`dob`,`password`)VALUES("gurpinder singh","singh@gmail.com","892329832","banga","punjab","india","144509","2000-11-15","password");
-- INSERT INTO `subscribers`(`id`) values (1);
-- INSERT INTO `authors`(`name`,`contact_info`) values ("parteek bhatia","bhatia@gmail.com");
-- INSERT INTO `categories`(`name`,`description`)values("Fiction","books about frictional stories");
-- INSERT INTO `publishers` (`name`, `contact_info`) values("Kalyani","publisherkalyani@gmail.com");
-- INSERT INTO `books`(`title`,`condition`,`language`,`edition`,`page_count`,`author_id`,`category_id`,`publisher_id`)values("programming in python","bad","english","1",1,"1","1","1");

-- select * from person p inner join staff_members s on p.id = s.id where p.email = "singh@gmail.com";

-- Retrieving data from tables
SELECT * FROM PERSON;
SELECT * FROM STAFF_MEMBERS;
SELECT * FROM subscribers;
SELECT * FROM BOOKS;
SELECT * FROM BORROW_BOOKS;
SELECT * FROM AUTHORS;
SELECT * FROM CATEGORIES;
SELECT * FROM PUBLISHERS;
SELECT * FROM ROLES;
SELECT * FROM SUBSCRIPTION_PLANS;
select * from subscription_plans;

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

select last_insert_id() from books;
DELETE FROM CUSTOMERS WHERE id = 1;
delete from person where id = 1;
use php_project;
show tables;

select * from books;












































































-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 07:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.

-- show databases;

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- --
-- -- Database: `library`
-- --

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `admin`
-- --

-- create database library;
-- use library;

-- CREATE TABLE `admin` (
--   `id` int(11) NOT NULL,
--   `FullName` varchar(100) DEFAULT NULL,
--   `AdminEmail` varchar(120) DEFAULT NULL,
--   `UserName` varchar(100) NOT NULL,
--   `Password` varchar(100) NOT NULL,
--   `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `admin`
-- --

-- INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
-- (1, 'Gurjot Singh', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2022-01-08 06:03:56');




-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblauthors`
-- --

-- CREATE TABLE `tblauthors` (
--   `id` int(11) NOT NULL,
--   `AuthorName` varchar(159) DEFAULT NULL,
--   `creationDate` timestamp NULL DEFAULT current_timestamp(),
--   `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `tblauthors`
-- --

-- INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
-- (1, 'Anuj kumar', '2022-01-22 07:23:03', '2022-01-22 07:23:03'),
-- (2, 'Chetan Bhagatt', '2022-01-22 07:23:03', '2022-01-22 07:23:03'),
-- (3, 'Anita Desai', '2022-01-22 07:23:03', '2022-01-22 16:23:41'),
-- (4, 'HC Verma', '2022-01-22 07:23:03', '2022-01-22 16:23:45'),
-- (5, 'R.D. Sharma ', '2022-01-22 07:23:03', '2022-01-22 16:23:47'),
-- (9, 'fwdfrwer', '2022-01-22 07:23:03', '2022-01-22 16:23:55'),
-- (10, 'Dr. Andy Williams', '2022-01-22 07:15:32', NULL),
-- (11, 'Kyle Hill', '2022-01-22 07:16:34', NULL),
-- (12, 'Robert T. Kiyosak', '2022-01-22 07:18:38', NULL),
-- (13, 'Kelly Barnhill', '2022-01-22 07:21:54', NULL),
-- (14, 'Herbert Schildt', '2022-01-22 07:23:03', NULL);

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblbooks`
-- --

-- CREATE TABLE `tblbooks` (
--   `id` int(11) NOT NULL,
--   `BookName` varchar(255) DEFAULT NULL,
--   `CatId` int(11) DEFAULT NULL,
--   `AuthorId` int(11) DEFAULT NULL,
--   `ISBNNumber` varchar(25) DEFAULT NULL,
--   `BookPrice` decimal(10,2) DEFAULT NULL,
--   `bookImage` varchar(250) NOT NULL,
--   `isIssued` int(1) DEFAULT NULL,
--   `RegDate` timestamp NULL DEFAULT current_timestamp(),
--   `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `tblbooks`
-- --

-- INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`) VALUES
-- (1, 'PHP And MySql programming', 5, 1, '222333', '20.00', '1efecc0ca822e40b7b673c0d79ae943f.jpg', 1, '2022-01-22 07:23:03', '2022-01-22 16:24:13'),
-- (3, 'physics', 6, 4, '1111', '15.00', 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', 0, '2022-01-22 07:23:03', '2022-01-22 16:24:17'),
-- (5, 'Murach\'s MySQL', 5, 1, '9350237695', '455.00', '5939d64655b4d2ae443830d73abc35b6.jpg', 1, '2022-01-21 16:42:11', '2022-01-22 06:11:03'),
-- (6, 'WordPress for Beginners 2022: A Visual Step-by-Step Guide to Mastering WordPress', 5, 10, 'B019MO3WCM', '100.00', '144ab706ba1cb9f6c23fd6ae9c0502b3.jpg', NULL, '2022-01-22 07:16:07', '2022-01-22 07:20:49'),
-- (7, 'WordPress Mastery Guide:', 5, 11, 'B09NKWH7NP', '53.00', '90083a56014186e88ffca10286172e64.jpg', NULL, '2022-01-22 07:18:03', '2022-01-22 07:20:58'),
-- (8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'B07C7M8SX9', '120.00', '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2022-01-22 07:20:39', NULL),
-- (9, 'The Girl Who Drank the Moon', 8, 13, '1848126476', '200.00', 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2022-01-22 07:22:33', NULL),
-- (10, 'C++: The Complete Reference, 4th Edition', 5, 14, '007053246X', '142.00', '36af5de9012bf8c804e499dc3c3b33a5.jpg', 0, '2022-01-22 07:23:36', '2022-01-22 08:18:22'),
-- (11, 'ASP.NET Core 5 for Beginners', 9, 11, 'GBSJ36344563', '422.00', 'b1b6788016bbfab12cfd2722604badc9.jpg', 0, '2022-01-22 08:14:21', '2022-01-22 08:15:23');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblcategory`
-- --

-- CREATE TABLE `tblcategory` (
--   `id` int(11) NOT NULL,
--   `CategoryName` varchar(150) DEFAULT NULL,
--   `Status` int(1) DEFAULT NULL,
--   `CreationDate` timestamp NULL DEFAULT current_timestamp(),
--   `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `tblcategory`
-- --

-- INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
-- (4, 'Romantic', 1, '2022-01-22 07:23:03', '2022-01-22 07:23:03'),
-- (5, 'Technology', 1, '2022-01-22 07:23:03', '2022-01-22 07:23:03'),
-- (6, 'Science', 1, '2022-01-22 07:23:03', '2022-01-22 16:24:37'),
-- (7, 'Management', 1, '2022-01-22 07:23:03', '2022-01-22 16:24:35'),
-- (8, 'General', 1, '2022-01-22 07:23:03', '2022-01-22 16:24:40'),
-- (9, 'Programming', 1, '2022-01-22 07:23:03', '2022-01-22 16:24:42');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblissuedbookdetails`
-- --

-- CREATE TABLE `tblissuedbookdetails` (
--   `id` int(11) NOT NULL,
--   `BookId` int(11) DEFAULT NULL,
--   `StudentID` varchar(150) DEFAULT NULL,
--   `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
--   `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
--   `RetrunStatus` int(1) DEFAULT NULL,
--   `fine` int(11) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `tblissuedbookdetails`
-- --

-- INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
-- (7, 5, 'SID011', '2022-01-22 05:45:57', NULL, NULL, NULL),
-- (8, 1, 'SID002', '2022-01-22 05:59:17', '2022-01-22 06:18:08', 1, 0),
-- (9, 10, 'SID009', '2022-01-22 07:38:09', '2022-01-22 07:38:54', 1, 0),
-- (10, 11, 'SID009', '2022-01-22 08:15:02', '2022-01-22 08:15:23', 1, 0),
-- (11, 1, 'SID012', '2022-01-22 08:17:15', NULL, NULL, NULL),
-- (12, 10, 'SID012', '2022-01-22 08:18:08', '2022-01-22 08:18:22', 1, 5);

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `tblstudents`
-- --

-- CREATE TABLE `tblstudents` (
--   `id` int(11) NOT NULL,
--   `StudentId` varchar(100) DEFAULT NULL,
--   `FullName` varchar(120) DEFAULT NULL,
--   `EmailId` varchar(120) DEFAULT NULL,
--   `MobileNumber` char(11) DEFAULT NULL,
--   `Password` varchar(120) DEFAULT NULL,
--   `Status` int(1) DEFAULT NULL,
--   `RegDate` timestamp NULL DEFAULT current_timestamp(),
--   `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `tblstudents`
-- --

-- INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
-- (1, 'SID002', 'Anuj kumar', 'anujk@gmail.com', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-02 07:23:03', '2022-01-22 16:25:45'),
-- (4, 'SID005', 'sdfsd', 'csfsd@dfsfks.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 1, '2022-01-02 07:23:03', '2022-01-22 16:25:53'),
-- (8, 'SID009', 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-02 07:23:03', '2022-01-22 16:25:58'),
-- (9, 'SID010', 'Amit', 'amit@gmail.com', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-02 07:23:03', '2022-01-22 16:26:02'),
-- (10, 'SID011', 'Sarita Pandey', 'sarita@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-02 07:23:03', '2022-01-22 16:26:04'),
-- (11, 'SID012', 'John Doe', 'john@test.com', '1234569870', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-22 08:16:18', NULL);

-- --
-- -- Indexes for dumped tables
-- --

-- --
-- -- Indexes for table `admin`
-- --
-- ALTER TABLE `admin`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblauthors`
-- --
-- ALTER TABLE `tblauthors`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblbooks`
-- --
-- ALTER TABLE `tblbooks`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblcategory`
-- --
-- ALTER TABLE `tblcategory`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblissuedbookdetails`
-- --
-- ALTER TABLE `tblissuedbookdetails`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `tblstudents`
-- --
-- ALTER TABLE `tblstudents`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `StudentId` (`StudentId`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `admin`
-- --
-- ALTER TABLE `admin`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --
-- -- AUTO_INCREMENT for table `tblauthors`
-- --
-- ALTER TABLE `tblauthors`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

-- --
-- -- AUTO_INCREMENT for table `tblbooks`
-- --
-- ALTER TABLE `tblbooks`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

-- --
-- -- AUTO_INCREMENT for table `tblcategory`
-- --
-- ALTER TABLE `tblcategory`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- --
-- -- AUTO_INCREMENT for table `tblissuedbookdetails`
-- --
-- ALTER TABLE `tblissuedbookdetails`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- --
-- -- AUTO_INCREMENT for table `tblstudents`
-- --
-- ALTER TABLE `tblstudents`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

