-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 02:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supportcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(225) NOT NULL,
  `aslug` varchar(225) NOT NULL,
  `seo` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `show_date` date NOT NULL,
  `image` varchar(225) DEFAULT NULL COMMENT 'this will store media library id ',
  `document` varchar(225) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'featured post status',
  `draft` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'used for draft section',
  `article_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'post status',
  `delete_status` tinyint(4) NOT NULL DEFAULT 1,
  `visit_count` int(11) NOT NULL DEFAULT 0,
  `no_click` int(11) NOT NULL,
  `thumbsup` int(11) DEFAULT NULL,
  `thumbsdown` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `articles` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `articles` ADD FULLTEXT KEY `description_2` (`description`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title_2` (`title`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title_3` (`title`);
ALTER TABLE `articles` ADD FULLTEXT KEY `description_3` (`description`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title_4` (`title`,`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
