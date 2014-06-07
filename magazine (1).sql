-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2013 at 08:23 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `magazine`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `ArticleID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `Rating` double NOT NULL DEFAULT '5',
  `NumRatings` int(11) NOT NULL DEFAULT '20',
  `Keywords` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Approved` int(11) NOT NULL DEFAULT '0',
  `Categories` varchar(200) NOT NULL,
  PRIMARY KEY (`ArticleID`),
  KEY `Author` (`AuthorID`),
  KEY `AuthorID` (`AuthorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ArticleID`, `Title`, `Description`, `AuthorID`, `Rating`, `NumRatings`, `Keywords`, `Timestamp`, `Approved`, `Categories`) VALUES
(24, 'Lorem Ipsum - All the facts', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at orci neque. Vestibulum gravida pulvinar neque, quis aliquam libero laoreet a. Maecenas sit amet imperdiet mauris. Suspendisse lacinia sodales fringilla. Suspendisse potenti. Aliquam sit amet nisi velit, eu commodo erat. Curabitur consectetur erat sed est malesuada in ultricies ipsum aliquam. Donec vel quam in eros pretium ornare. Maecenas ultricies condimentum arcu sed porta. Sed elit massa, porttitor vel scelerisque a, iaculis et diam. Nam pulvinar odio eu lacus venenatis a facilisis urna luctus.\r\n\r\nIn hac habitasse platea dictumst. Nulla vel auctor neque. Maecenas et egestas magna. Nam diam metus, lobortis eu sagittis quis, venenatis ut quam. Aliquam bibendum vestibulum tellus, vel consectetur tellus facilisis et. Vivamus gravida nisl eu justo consequat bibendum. Donec egestas congue aliquet. Mauris ac mi nulla, sed imperdiet neque. Aenean adipiscing scelerisque elit, gravida molestie arcu semper sed. Duis interdum justo turpis, non accumsan tellus. Nulla facilisi. Sed cursus, quam ac suscipit ornare, nunc est iaculis quam, id malesuada urna nulla ut nisi. Morbi non mauris at ipsum aliquam lobortis. Nulla eget dolor arcu, vitae posuere mauris. Nam dignissim, felis non dictum tempor, massa lectus egestas ipsum, ac ultrices massa lacus at magna.', 1, 5.333333333, 21, 'Random text ', '2013-04-16 19:15:10', 2, 'Others'),
(25, 'This Is the second post !!', 'Aenean lobortis aliquam tincidunt. Quisque vitae nulla orci. Donec tempus, risus id rhoncus blandit, felis ipsum commodo mi, quis luctus nunc augue vitae dolor. Cras tincidunt elit quam. Vestibulum volutpat arcu eget dolor aliquet ac vestibulum dolor auctor. Phasellus imperdiet eleifend dui a pretium. Curabitur eu leo eget erat pharetra mollis. Donec magna nisi, adipiscing quis dictum quis, placerat sit amet dui. Nulla nec velit vitae leo ullamcorper semper. Maecenas at lorem a mi vehicula auctor. Duis vitae sem quis arcu tempus eleifend. Phasellus in massa diam. Maecenas ultricies suscipit orci at dignissim. Cras tristique hendrerit risus ac ornare. Quisque facilisis nisl vel lectus accumsan posuere. Morbi in metus in arcu interdum mollis.\r\n\r\nMaecenas pellentesque fermentum dignissim. Donec et quam sed felis rhoncus pellentesque. Fusce bibendum diam molestie mi fermentum vitae ullamcorper urna aliquet. Aliquam pulvinar consequat lectus auctor ultrices. Nunc auctor placerat libero, vel vestibulum ipsum semper in. In posuere, nisi eu vulputate aliquam, nisi metus imperdiet turpis, eget porta tellus lorem eu risus. Quisque eu scelerisque nibh. Donec in dictum nibh. In faucibus mi sit amet mauris varius nec ornare mauris blandit. Suspendisse potenti. Quisque suscipit massa vitae magna mattis vel varius nunc adipiscing. Integer interdum, urna eu rutrum fringilla, nisi urna accumsan velit, at gravida lorem turpis a arcu.', 1, 5.238095238, 21, 'Second post lorem ipsum', '2013-04-16 19:15:10', 1, 'General Others'),
(26, 'Ancelotti rules out PSG move for Manchester United', 'asdasd', 11, 5.238095238, 21, 'Ancellotti Rooney PSG Football test', '2013-04-16 19:15:10', 1, 'General Others Fashion'),
(39, 'test', 'test', 1, 0.14285714199999994, 21, 'test', '2013-04-17 16:02:00', 1, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryName`) VALUES
('Sports'),
('Technology'),
('General'),
('Politics'),
('Entertainment'),
('Social Issues'),
('Others'),
('Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `ArticleID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL DEFAULT '-1',
  `Comment` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentID`),
  KEY `ArticleID` (`ArticleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `ArticleID`, `AuthorID`, `Comment`, `Timestamp`) VALUES
(36, 39, 11, 'test comment', '2013-04-17 19:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `userID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  KEY `userID` (`userID`),
  KEY `articleID` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`userID`, `articleID`, `rating`) VALUES
(1, 24, 7),
(1, 25, 10),
(1, 26, 10),
(11, 39, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `roll` int(11) NOT NULL,
  `permissions` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `roll`, `permissions`, `password`) VALUES
(1, 'admin', 'admin@localhost.com', 106110085, 1, 'a'),
(3, 'shashank', 'a@a.com', 106110081, 0, ''),
(4, 'asd', '1a@a.com', 106110098, 0, ''),
(6, 'sad', 'A@A.COM', 106110087, 0, 'asd'),
(9, 'a', 'a@a.com', 10611, 0, 'a'),
(10, 'Maddy', 'm@1.com', 106110049, 2, 'Maddy'),
(11, 'Sha', 'a@a.com', 106, 2, 'a'),
(12, 'a', 'a@a.com', 10, 0, 'a'),
(13, '10', 'a@a.com', 1, 0, 'a');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`articleID`) REFERENCES `articles` (`ArticleID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
