-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2021 at 04:02 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `framebit`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` varchar(255) NOT NULL,
  `commentid` int NOT NULL,
  `comment` text NOT NULL,
  `user` text NOT NULL,
  `date` text NOT NULL,
  `hidden` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registeredon` text NOT NULL,
  `profpic` text NOT NULL,
  `aboutme` text NOT NULL,
  `prof_name` text NOT NULL,
  `prof_age` text NOT NULL,
  `prof_city` text NOT NULL,
  `prof_hometown` text NOT NULL,
  `prof_country` text NOT NULL,
  `prof_occupation` text NOT NULL,
  `prof_interests` text NOT NULL,
  `prof_music` text NOT NULL,
  `prof_books` text NOT NULL,
  `prof_movies` text NOT NULL,
  `prof_website` text NOT NULL,
  `featured_vid` varchar(255) NOT NULL,
  `recent_vid` varchar(255) NOT NULL,
  `videos_watched` int NOT NULL,
  `subscribers` int NOT NULL,
  `videos` int NOT NULL,
  `channel_color` varchar(255) NOT NULL,
  `channel_bg` text NOT NULL,
  `brandingpic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brandingurl` text NOT NULL,
  `last_online` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_online`
--

DROP TABLE IF EXISTS `last_online`;
CREATE TABLE IF NOT EXISTS `last_online` (
  `user_id` varchar(255) NOT NULL,
  `last_seen` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videodb`
--

DROP TABLE IF EXISTS `videodb`;
CREATE TABLE IF NOT EXISTS `videodb` (
  `VideoID` varchar(255) NOT NULL,
  `VideoName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `VideoDesc` text NOT NULL,
  `Uploader` text NOT NULL,
  `UploadDate` text NOT NULL,
  `ViewCount` int NOT NULL,
  `VideoCategory` text NOT NULL,
  `VideoFile` text NOT NULL,
  `CustomThumbnail` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` varchar(255) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`video_id`) REFERENCES `videodb`(`VideoID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_pics`
--

DROP TABLE IF EXISTS `profile_pics`;
CREATE TABLE IF NOT EXISTS `profile_pics` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
