-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2018 at 02:46 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(2) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `hobbies` varchar(500) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `email`, `password`, `user_type`, `gender`, `hobbies`, `profile_pic`, `dob`, `address`, `date_created`, `date_updated`) VALUES
(11, 'sdasd', 'asdasd', 'ff', 'admin@gmail.co', 'e10adc3949ba59abbe56e057f20f883e', 2, 'male', 'books_reading', 'face_us.png-1535010283', '1981-08-14', NULL, '2018-08-23 13:14:43', '2018-08-23 13:26:21'),
(12, 'asasd', 'sdsd', 'yes', 'admin@gmail.coa', 'e10adc3949ba59abbe56e057f20f883e', 1, 'male', 'books_reading', '../images/face_us.png-1535015212', '1970-01-14', 'dfdfgdfg', '2018-08-23 13:27:47', '2018-08-23 14:36:52'),
(13, 'sadasd', 'sadasd', 'sad', 'asdasdasdasd@sdsad.com', '73a90acaae2b1ccc0e969709665bc62f', 1, 'male', 'surfing_on_internet', 'face_us.png-1535015424', '1985-10-16', 'sdfsdf', '2018-08-23 14:40:24', '2018-08-23 14:40:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
