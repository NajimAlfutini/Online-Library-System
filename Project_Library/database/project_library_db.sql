-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 12:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(150) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `yearOfPublication` int(10) NOT NULL,
  `bookCopies` int(10) NOT NULL,
  `categories` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `ISBN`, `title`, `author`, `publisher`, `yearOfPublication`, `bookCopies`, `categories`) VALUES
(1, '20220001', ' Understanding AJAX', ' Eichorn J.', ' Prentice Hall', 2006, 12, ' Web Development'),
(2, '20220002', ' Teach Yourself VISUALLY HTML and CSS', ' Mike Wooldridge, Linda Wooldridge', ' Visual', 2008, 4, ' Web Development'),
(3, '20220003', ' Java Enterprise in a Nutshell', ' Flanagan', ' OReilly', 2001, 65, ' Web Development'),
(4, '20220004', ' Programming PHP', ' Leon Atkinson, Zeev Suraski', ' Prentice Hall', 2003, 0, ' Web Development'),
(5, '20220005', '  Sams Teach Yourself Android Application Development in 24 Hours', ' Lauren Darcey, Shane Conder', ' SAMS', 2010, 5, ' Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `userID` int(9) NOT NULL,
  `username` varchar(100) NOT NULL,
  `bookID` int(11) NOT NULL,
  `bookTitle` varchar(100) NOT NULL,
  `returnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`userID`, `username`, `bookID`, `bookTitle`, `returnDate`) VALUES
(202006448, 'WaleedSaleh', 5, '  Sams Teach Yourself Android Application Development in 24 Hours', '0000-00-00'),
(202006448, 'WaleedSaleh', 3, ' Java Enterprise in a Nutshell', '2022-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `id` int(9) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `username`, `password`) VALUES
(1, 'librarian', 'd04530154311b521535587eb5a20db3d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phoneNumber` varchar(8) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `photo` text NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `phoneNumber`, `username`, `password`, `photo`, `address`) VALUES
(202003215, 'Najim Abdulkarim Musaed Alfetaini', '2@gmail.com', '33886640', 'NajimAlfetaini', '40a77f99d38035e35f64568d3d0b8f51', 'Najim.png', 'Riffa'),
(202004452, 'Nader Dahan', '4@gmail.com', '36059919', ' NaderDahan', '6e8411895e09a876224a9abd7a38f811', 'Nader.png', 'Riffa'),
(202004484, 'Maged Hussain', '3@gmail.com', '37762422', 'MagedHussain', '678395d3ec56639ad3c60ad6509cfdab', 'Maged.png', 'Riffa'),
(202006448, 'Waleed Saleh Ali Saleh', '1@gmail.com', '33642632', 'WaleedSaleh', '9c1f046e426d0bde5435251db53ca2c8', 'Waleed.png', 'Riffa'),
(202006577, 'Yousef Ali Naji', '5@gmail.com', '66761622', 'YousefAli', '292f082600a993402d2c8ceeaad51dbb', 'Yousef.png', 'Hajiyat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD KEY `userID` (`userID`),
  ADD KEY `borrow_ibfk_1` (`bookID`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
