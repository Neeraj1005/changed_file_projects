-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 09:59 AM
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
-- Table structure for table `knowledgebasesetting`
--

CREATE TABLE `knowledgebasesetting` (
  `id` int(11) NOT NULL,
  `views` tinyint(4) NOT NULL DEFAULT 1,
  `like_unlike` tinyint(4) NOT NULL DEFAULT 1,
  `category` tinyint(4) NOT NULL DEFAULT 1,
  `author` tinyint(4) NOT NULL DEFAULT 1,
  `posted_date` tinyint(4) NOT NULL DEFAULT 1,
  `print` tinyint(4) NOT NULL DEFAULT 1,
  `save_post` tinyint(4) NOT NULL DEFAULT 1,
  `tags` tinyint(4) NOT NULL DEFAULT 1,
  `visit_count` tinyint(4) NOT NULL DEFAULT 1,
  `related_post` tinyint(4) NOT NULL DEFAULT 1,
  `welcome_block` tinyint(4) NOT NULL DEFAULT 1,
  `slider_block` tinyint(4) NOT NULL DEFAULT 1,
  `footer_block` tinyint(4) NOT NULL DEFAULT 1,
  `featured_block` tinyint(4) NOT NULL DEFAULT 1,
  `category_block` tinyint(4) NOT NULL DEFAULT 1,
  `search_block` tinyint(4) NOT NULL DEFAULT 1,
  `listimg_block` int(4) NOT NULL DEFAULT 1 COMMENT 'list image block',
  `homeimg_block` int(4) NOT NULL DEFAULT 1 COMMENT 'home img block',
  `viewimg_block` int(4) NOT NULL DEFAULT 1 COMMENT 'view image block',
  `cteated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowledgebasesetting`
--

INSERT INTO `knowledgebasesetting` (`id`, `views`, `like_unlike`, `category`, `author`, `posted_date`, `print`, `save_post`, `tags`, `visit_count`, `related_post`, `welcome_block`, `slider_block`, `footer_block`, `featured_block`, `category_block`, `search_block`, `listimg_block`, `homeimg_block`, `viewimg_block`, `cteated_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, '2020-02-02 08:58:37', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knowledgebasesetting`
--
ALTER TABLE `knowledgebasesetting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knowledgebasesetting`
--
ALTER TABLE `knowledgebasesetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
