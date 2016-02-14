-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2016 at 12:22 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mr`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `year`, `image`, `director`) VALUES
(1, 'Les évadés', '1994', 'les_evades.jpg', 'Frank Darabont'),
(2, 'Le parrain', '1972', 'le_parrain.jpg', 'Francis Ford Coppola'),
(3, 'the dark knight', '2008', 'the_dark_knight.jpg', 'Christopher Nolan'),
(4, 'Pulb Fiction', '1994', 'pulb_fiction.jpg', 'Quentin Tarantino'),
(5, 'Les évadés 2', '1996', 'les_evades.jpg', 'Frank Darabont'),
(6, 'Le parrain 2', '1978', 'le_parrain.jpg', 'Francis Ford Coppola'),
(7, 'the dark knight risies', '2010', 'the_dark_knight.jpg', 'Christopher Nolan'),
(8, 'Le parrain 3', '1980', 'le_parrain.jpg', 'Francis Ford Coppola'),
(9, 'Pulb Fiction 2', '2017', 'pulb_fiction.jpg', 'Quentin Tarantino');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate`, `user_id`, `movie_id`, `rate_date`) VALUES
(1, 4, 1, '1', '2016-02-14 00:00:00'),
(2, 5, 2, '1', '2016-02-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `movie_types` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `movie_number` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `login`, `email`, `password`, `image`, `movie_types`, `movie_number`, `created_at`, `edited_at`) VALUES
(1, 'tarek', 'chida', 'tarek', 'tarek.chida@gmail.com', '0192023a7bbd73250516f069df18b500', 'd8f3557be62c5364dbf9e3ee7f919e7b.png', 'Drama', 5, '2016-02-13 02:04:48', '2016-02-13 02:04:48'),
(3, 'test', 'disko', 'disko', 'tarek.chida@gmail.com', '0192023a7bbd73250516f069df18b500', 'd8f3557be62c5364dbf9e3ee7f919e7b.png', 'Action,Aventure', 1, '2016-02-13 02:17:27', '2016-02-13 02:17:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
