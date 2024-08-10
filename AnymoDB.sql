-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2022 at 06:25 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anonomy`
--
CREATE DATABASE IF NOT EXISTS `anonomy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `anonomy`;

-- --------------------------------------------------------

--
-- Table structure for table `access_data`
--

DROP TABLE IF EXISTS `access_data`;
CREATE TABLE IF NOT EXISTS `access_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accountId` int(11) UNSIGNED NOT NULL,
  `accessToken` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `fcm_regId` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `appType` int(10) UNSIGNED DEFAULT '0',
  `clientId` int(11) UNSIGNED DEFAULT '0',
  `lang` char(10) COLLATE utf8_unicode_ci DEFAULT 'en',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_data`
--

INSERT INTO `access_data` (`id`, `accountId`, `accessToken`, `fcm_regId`, `appType`, `clientId`, `lang`, `createAt`, `removeAt`, `u_agent`, `ip_addr`) VALUES
(1, 1, '00d2c1346f85455510fd49b239719ecd', 'elxL14veT_mIQZRTP2ROT3:APA91bEw7hHNPpsGL-fISyH8ldGaYoCsdVJJ2_deE5ILUzyuxbS-2EVZEEyJmx6MkuEXTjAlMJFGZvOAQeIo7fID0Zl6UT99hhkGJo3n5pqbad1TQf-j6ggzilU4CyGX1rcm1c9cYz3-', 2, 12568, '', 1644516180, 1644517241, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '192.168.1.4'),
(2, 2, '1b6d6ca8706490b93bf6911b0c37dbe3', 'elxL14veT_mIQZRTP2ROT3:APA91bEw7hHNPpsGL-fISyH8ldGaYoCsdVJJ2_deE5ILUzyuxbS-2EVZEEyJmx6MkuEXTjAlMJFGZvOAQeIo7fID0Zl6UT99hhkGJo3n5pqbad1TQf-j6ggzilU4CyGX1rcm1c9cYz3-', 2, 12568, '', 1644517297, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '192.168.1.4');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fullname` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `salt`, `password`, `fullname`, `createAt`, `u_agent`, `ip_addr`) VALUES
(1, 'administrator', 'gk4', '3a8de67ac2ace74b466f74e0a8a98749', 'Vedant', 1644318371, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `toUserId` int(11) UNSIGNED DEFAULT '0',
  `fromUserId_lastView` int(11) UNSIGNED DEFAULT '0',
  `toUserId_lastView` int(11) UNSIGNED DEFAULT '0',
  `itemType` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `colorId` int(11) UNSIGNED DEFAULT '0',
  `iconId` int(11) UNSIGNED DEFAULT '0',
  `message` varchar(800) CHARACTER SET utf8 DEFAULT '',
  `messageCreateAt` int(11) UNSIGNED DEFAULT '0',
  `updateAt` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

DROP TABLE IF EXISTS `comment_likes`;
CREATE TABLE IF NOT EXISTS `comment_likes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcm_history`
--

DROP TABLE IF EXISTS `gcm_history`;
CREATE TABLE IF NOT EXISTS `gcm_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `msg` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `msgType` int(10) UNSIGNED DEFAULT '0',
  `accountId` int(11) UNSIGNED DEFAULT '0',
  `status` int(10) UNSIGNED DEFAULT '0',
  `success` int(10) UNSIGNED DEFAULT '0',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `textColor` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bgColor` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `imgBlur` int(11) UNSIGNED DEFAULT '0',
  `imgAlpha` int(11) UNSIGNED DEFAULT '90',
  `likesCount` int(11) UNSIGNED DEFAULT '0',
  `commentsCount` int(11) UNSIGNED DEFAULT '0',
  `reportsCount` int(11) UNSIGNED DEFAULT '0',
  `viewsCount` int(11) UNSIGNED DEFAULT '0',
  `deviceType` int(11) UNSIGNED DEFAULT '0',
  `rating` int(11) UNSIGNED DEFAULT '0',
  `allowComments` int(11) UNSIGNED DEFAULT '1',
  `allowMessages` int(11) UNSIGNED DEFAULT '1',
  `post` varchar(800) CHARACTER SET utf8 DEFAULT '',
  `previewImgUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `imgUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `previewGifUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `gifUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `previewVideoImgUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `videoUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `area` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `moderateAt` int(11) UNSIGNED DEFAULT '0',
  `needToModerate` int(11) UNSIGNED DEFAULT '0',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `fromUserId`, `textColor`, `bgColor`, `imgBlur`, `imgAlpha`, `likesCount`, `commentsCount`, `reportsCount`, `viewsCount`, `deviceType`, `rating`, `allowComments`, `allowMessages`, `post`, `previewImgUrl`, `imgUrl`, `previewGifUrl`, `gifUrl`, `previewVideoImgUrl`, `videoUrl`, `area`, `country`, `city`, `u_agent`, `createAt`, `removeAt`, `moderateAt`, `needToModerate`, `lat`, `lng`, `ip_addr`) VALUES
(1, 1, '#ffffff', '#86780a', 5, 90, 0, 2, 0, 0, 1, 0, 1, 1, 'Hello this is vedant , trying the project', '', '', '', '', '', '', 'Ankara', 'Turkey', 'Unknown', 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', 1644516354, 0, 0, 0, 39.919899, 32.854301, '192.168.1.4');

-- --------------------------------------------------------

--
-- Table structure for table `item_comments`
--

DROP TABLE IF EXISTS `item_comments`;
CREATE TABLE IF NOT EXISTS `item_comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `replyToUserId` int(11) UNSIGNED DEFAULT '0',
  `likesCount` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `itemFromUserId` int(11) UNSIGNED DEFAULT '0',
  `colorId` int(11) UNSIGNED DEFAULT '0',
  `iconId` int(11) UNSIGNED DEFAULT '0',
  `comment` varchar(800) DEFAULT '',
  `commentOriginImgUrl` varchar(255) DEFAULT '',
  `commentNormalImgUrl` varchar(255) DEFAULT '',
  `area` varchar(150) NOT NULL DEFAULT '',
  `country` varchar(150) NOT NULL DEFAULT '',
  `city` varchar(150) NOT NULL DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `notifyId` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) DEFAULT '',
  `ip_addr` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_comments`
--

INSERT INTO `item_comments` (`id`, `fromUserId`, `replyToUserId`, `likesCount`, `itemId`, `itemFromUserId`, `colorId`, `iconId`, `comment`, `commentOriginImgUrl`, `commentNormalImgUrl`, `area`, `country`, `city`, `createAt`, `removeAt`, `notifyId`, `u_agent`, `ip_addr`) VALUES
(1, 1, 0, 0, 1, 1, 0, 0, 'hello', '', '', 'Ankara', 'Turkey', 'Unknown', 1644517136, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '192.168.1.4'),
(2, 1, 0, 0, 1, 1, 0, 0, 'this is mark form saoner', '', '', 'Ankara', 'Turkey', 'Unknown', 1644517148, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '192.168.1.4');

-- --------------------------------------------------------

--
-- Table structure for table `item_followers`
--

DROP TABLE IF EXISTS `item_followers`;
CREATE TABLE IF NOT EXISTS `item_followers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `followType` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_followers`
--

INSERT INTO `item_followers` (`id`, `userId`, `itemId`, `followType`, `createAt`, `removeAt`) VALUES
(1, 1, 1, 0, 1644516354, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_likes`
--

DROP TABLE IF EXISTS `item_likes`;
CREATE TABLE IF NOT EXISTS `item_likes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chatId` int(11) UNSIGNED DEFAULT '0',
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `toUserId` int(11) UNSIGNED DEFAULT '0',
  `message` varchar(800) DEFAULT '',
  `imgUrl` varchar(255) DEFAULT '',
  `stickerId` int(11) UNSIGNED DEFAULT '0',
  `stickerImgUrl` varchar(255) DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `seenAt` int(11) UNSIGNED DEFAULT '0',
  `seenFromUserId` int(11) UNSIGNED DEFAULT '0',
  `seenToUserId` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) DEFAULT '',
  `ip_addr` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notifyToId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `notifyFromId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `notifyType` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `postId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_blacklist`
--

DROP TABLE IF EXISTS `profile_blacklist`;
CREATE TABLE IF NOT EXISTS `profile_blacklist` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blockedByUserId` int(11) UNSIGNED DEFAULT '0',
  `blockedUserId` int(11) UNSIGNED DEFAULT '0',
  `reason` varchar(400) COLLATE utf8_unicode_ci DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemType` int(11) UNSIGNED DEFAULT '0',
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `toUserId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `abuseId` int(11) UNSIGNED DEFAULT '0',
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restore_data`
--

DROP TABLE IF EXISTS `restore_data`;
CREATE TABLE IF NOT EXISTS `restore_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accountId` int(11) UNSIGNED NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `clientId` int(11) UNSIGNED DEFAULT '0',
  `lang` char(10) COLLATE utf8_unicode_ci DEFAULT 'en',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `intValue` int(10) UNSIGNED DEFAULT '0',
  `textValue` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `intValue`, `textValue`) VALUES
(1, 'admob', 1, ''),
(2, 'allowMultiAccountsFunction', 1, ''),
(3, 'allowGoogleAuthorization', 1, ''),
(4, 'defaultAllowMessages', 1, ''),
(5, 'interstitialAdAfterNewItem', 1, ''),
(6, 'interstitialAdAfterNewLike', 5, ''),
(7, 'admobAdAfterItem', 1, ''),
(8, 'allowGoogleAuth', 1, ''),
(9, 'limitItems', 10, ''),
(10, 'limitChats', 5, ''),
(11, 'limitLikes', 40, ''),
(12, 'limitComments', 40, ''),
(13, 'pinnedItemId', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `stickers_data`
--

DROP TABLE IF EXISTS `stickers_data`;
CREATE TABLE IF NOT EXISTS `stickers_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cost` int(11) UNSIGNED DEFAULT '0',
  `category` int(11) UNSIGNED DEFAULT '0',
  `imgUrl` varchar(255) DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stickers_data`
--

INSERT INTO `stickers_data` (`id`, `cost`, `category`, `imgUrl`, `createAt`, `removeAt`) VALUES
(1, 0, 0, 'https://anonymo.fun/stickers/1.png', 1644318371, 0),
(2, 0, 0, 'https://anonymo.fun/stickers/2.png', 1644318371, 0),
(3, 0, 0, 'https://anonymo.fun/stickers/3.png', 1644318371, 0),
(4, 0, 0, 'https://anonymo.fun/stickers/4.png', 1644318371, 0),
(5, 0, 0, 'https://anonymo.fun/stickers/5.png', 1644318371, 0),
(6, 0, 0, 'https://anonymo.fun/stickers/6.png', 1644318371, 0),
(7, 0, 0, 'https://anonymo.fun/stickers/7.png', 1644318371, 0),
(8, 0, 0, 'https://anonymo.fun/stickers/8.png', 1644318371, 0),
(9, 0, 0, 'https://anonymo.fun/stickers/9.png', 1644318371, 0),
(10, 0, 0, 'https://anonymo.fun/stickers/10.png', 1644318371, 0),
(11, 0, 0, 'https://anonymo.fun/stickers/11.png', 1644318371, 0),
(12, 0, 0, 'https://anonymo.fun/stickers/12.png', 1644318371, 0),
(13, 0, 0, 'https://anonymo.fun/stickers/13.png', 1644318371, 0),
(14, 0, 0, 'https://anonymo.fun/stickers/14.png', 1644318371, 0),
(15, 0, 0, 'https://anonymo.fun/stickers/15.png', 1644318371, 0),
(16, 0, 0, 'https://anonymo.fun/stickers/16.png', 1644318371, 0),
(17, 0, 0, 'https://anonymo.fun/stickers/17.png', 1644318371, 0),
(18, 0, 0, 'https://anonymo.fun/stickers/18.png', 1644318371, 0),
(19, 0, 0, 'https://anonymo.fun/stickers/19.png', 1644318371, 0),
(20, 0, 0, 'https://anonymo.fun/stickers/20.png', 1644318371, 0),
(21, 0, 0, 'https://anonymo.fun/stickers/21.png', 1644318371, 0),
(22, 0, 0, 'https://anonymo.fun/stickers/22.png', 1644318371, 0),
(23, 0, 0, 'https://anonymo.fun/stickers/23.png', 1644318371, 0),
(24, 0, 0, 'https://anonymo.fun/stickers/24.png', 1644318371, 0),
(25, 0, 0, 'https://anonymo.fun/stickers/25.png', 1644318371, 0),
(26, 0, 0, 'https://anonymo.fun/stickers/26.png', 1644318371, 0),
(27, 0, 0, 'https://anonymo.fun/stickers/27.png', 1644318371, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stoplist`
--

DROP TABLE IF EXISTS `stoplist`;
CREATE TABLE IF NOT EXISTS `stoplist` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `byAdminId` int(11) UNSIGNED DEFAULT '0',
  `reason` varchar(400) DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clientId` int(11) UNSIGNED DEFAULT '0',
  `accountId` int(11) UNSIGNED DEFAULT '0',
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT '',
  `subject` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `text` varchar(400) COLLATE utf8_unicode_ci DEFAULT '',
  `reply` varchar(400) COLLATE utf8_unicode_ci DEFAULT '',
  `replyAt` int(11) UNSIGNED DEFAULT '0',
  `replyFrom` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state` int(10) UNSIGNED DEFAULT '0',
  `surname` varchar(75) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fullname` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `passw` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `emailVerified` smallint(6) UNSIGNED DEFAULT '0',
  `lang` char(10) COLLATE utf8_unicode_ci DEFAULT 'en',
  `language` char(10) COLLATE utf8_unicode_ci DEFAULT 'en',
  `bYear` smallint(6) UNSIGNED DEFAULT '2000',
  `bMonth` smallint(6) UNSIGNED DEFAULT '0',
  `bDay` smallint(6) UNSIGNED DEFAULT '1',
  `status` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_id` int(10) UNSIGNED DEFAULT '0',
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city_id` int(10) UNSIGNED DEFAULT '0',
  `vk_page` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fb_page` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tw_page` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `my_page` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `verified` smallint(6) UNSIGNED DEFAULT '0',
  `otpPhone` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `otpVerified` smallint(6) UNSIGNED DEFAULT '0',
  `admob_ad_banner` smallint(6) UNSIGNED DEFAULT '0',
  `admob_interstitial` smallint(6) UNSIGNED DEFAULT '0',
  `vk_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fb_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gl_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tw_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `items_count` int(11) UNSIGNED DEFAULT '0',
  `likes_count` int(11) UNSIGNED DEFAULT '0',
  `comments_count` int(11) UNSIGNED DEFAULT '0',
  `rating` int(11) UNSIGNED DEFAULT '0',
  `balance` int(11) UNSIGNED DEFAULT '0',
  `sex` smallint(6) UNSIGNED DEFAULT '0',
  `age` smallint(6) UNSIGNED DEFAULT '18',
  `last_notify_view` int(10) UNSIGNED DEFAULT '0',
  `last_authorize` int(10) UNSIGNED DEFAULT '0',
  `allowComments` smallint(6) UNSIGNED DEFAULT '1',
  `allowMessages` smallint(6) UNSIGNED DEFAULT '1',
  `lowPhotoUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `originPhotoUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `normalPhotoUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `bigPhotoUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `originCoverUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `normalCoverUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `photoModerateAt` int(11) UNSIGNED DEFAULT '0',
  `photoModerateUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `photoPostModerateAt` int(11) UNSIGNED DEFAULT '0',
  `coverModerateAt` int(11) UNSIGNED DEFAULT '0',
  `coverModerateUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `coverPostModerateAt` int(11) UNSIGNED DEFAULT '0',
  `lat` float(10,6) DEFAULT '0.000000',
  `lng` float(10,6) DEFAULT '0.000000',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `state`, `surname`, `fullname`, `salt`, `passw`, `login`, `email`, `emailVerified`, `lang`, `language`, `bYear`, `bMonth`, `bDay`, `status`, `country`, `country_id`, `city`, `city_id`, `vk_page`, `fb_page`, `tw_page`, `my_page`, `phone`, `verified`, `otpPhone`, `otpVerified`, `admob_ad_banner`, `admob_interstitial`, `vk_id`, `fb_id`, `gl_id`, `tw_id`, `items_count`, `likes_count`, `comments_count`, `rating`, `balance`, `sex`, `age`, `last_notify_view`, `last_authorize`, `allowComments`, `allowMessages`, `lowPhotoUrl`, `originPhotoUrl`, `normalPhotoUrl`, `bigPhotoUrl`, `originCoverUrl`, `normalCoverUrl`, `photoModerateAt`, `photoModerateUrl`, `photoPostModerateAt`, `coverModerateAt`, `coverModerateUrl`, `coverPostModerateAt`, `lat`, `lng`, `ip_addr`, `createAt`) VALUES
(1, 0, '', '', ',0l', '7e29dfa612aea7bc1811548a99d760b6', '', 'hguihuweeioe@gmail.com', 0, 'en', '', 2000, 0, 1, '', '', 0, '', 0, '', '', '', '', '', 0, '', 0, 0, 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 18, 0, 1644516354, 1, 1, '', '', '', '', '', '', 0, '', 0, 0, '', 0, 0.000000, 0.000000, '192.168.1.4', 1644516180),
(2, 0, '', '', 'gnl', '929ca87eff35b6d13fae6cbed8d978f5', '', 'tjkakjgalal@gmail.com', 0, 'en', 'en', 2000, 0, 1, '', '', 0, '', 0, '', '', '', '', '', 0, '', 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 18, 0, 1644517297, 1, 1, '', '', '', '', '', '', 0, '', 0, 0, '', 0, 0.000000, 0.000000, '192.168.1.4', 1644517297);
--
-- Database: `anymos`
--
CREATE DATABASE IF NOT EXISTS `anymos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `anymos`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fullname` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `salt`, `password`, `fullname`, `createAt`, `ip_addr`) VALUES
(1, 'Admin', 'm9v', '90bffedc24387ccf2d2584f098348d74', 'Admin', 1645964488, '');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `toUserId` int(11) UNSIGNED DEFAULT '0',
  `fromUserId_lastView` int(11) UNSIGNED DEFAULT '0',
  `toUserId_lastView` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `colorId` int(11) UNSIGNED DEFAULT '0',
  `iconId` int(11) UNSIGNED DEFAULT '0',
  `message` varchar(800) DEFAULT NULL,
  `messageCreateAt` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `fromUserId`, `toUserId`, `fromUserId_lastView`, `toUserId_lastView`, `itemId`, `colorId`, `iconId`, `message`, `messageCreateAt`, `createAt`, `removeAt`) VALUES
(1, 4, 3, 1645970192, 1645970194, 5, 17, 14, 'hi', 1645970192, 1645970192, 0),
(2, 5, 6, 1652001667, 1648193986, 13, 7, 10, '😍', 1648193959, 1645972320, 0),
(3, 5, 1, 1646206194, 1645975146, 1, 13, 1, 'hello dude', 1645975142, 1645975142, 1646206193),
(4, 5, 7, 1648175559, 1646027610, 16, 20, 11, 'Sticker', 1646212849, 1645982318, 1648175559),
(5, 12, 5, 1648192972, 1650333612, 30, 16, 14, 'cbibkfjskjfskj', 1648192914, 1648192914, 1650333611),
(6, 16, 1, 1650335486, 1650335414, 1, 17, 14, '😊😊', 1650335466, 1650335402, 1650335486),
(7, 16, 5, 1650335945, 1652003044, 34, 6, 11, 'Sticker', 1650335936, 1650335627, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `textColor` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bgColor` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `likesCount` int(11) UNSIGNED DEFAULT '0',
  `commentsCount` int(11) UNSIGNED DEFAULT '0',
  `reportsCount` int(11) UNSIGNED DEFAULT '0',
  `viewsCount` int(11) UNSIGNED DEFAULT '0',
  `deviceType` int(11) UNSIGNED DEFAULT '0',
  `allowComments` int(11) UNSIGNED DEFAULT '1',
  `allowMessages` int(11) UNSIGNED DEFAULT '1',
  `post` varchar(800) DEFAULT NULL,
  `area` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `u_agent` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `ip_addr` char(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `fromUserId`, `textColor`, `bgColor`, `likesCount`, `commentsCount`, `reportsCount`, `viewsCount`, `deviceType`, `allowComments`, `allowMessages`, `post`, `area`, `country`, `city`, `u_agent`, `createAt`, `removeAt`, `lat`, `lng`, `ip_addr`) VALUES
(47, 5, '#ffffff', '#d75641', 0, 1, 0, 0, 1, 1, 1, 'Need a frontend developer asap. Dm me', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1652205296, 0, 21.146601, 79.088860, '152.57.178.163'),
(48, 5, '#ffffff', '#d2e6ff', 0, 0, 0, 0, 1, 1, 1, '665 GB premium development courses collection : https://mega.nz/folder/c3QzWZxB#iszy2TuOoyJdDRWIAV-DEA', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1652205468, 0, 21.146601, 79.088860, '152.57.178.163'),
(49, 13, '#ffdbff', '#3ecfeb', 0, 0, 0, 0, 1, 1, 1, 'It\\\'s Never too late for new beginning in your life 💯', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 9; RMX1811 Build/PKQ1.190319.001)', 1652205564, 0, 21.146601, 79.088860, '49.14.86.32'),
(50, 13, '#ffffff', '#38780a', 0, 0, 0, 0, 1, 1, 1, 'Need fulltime Job ... please Type \\\'intrested\\\' in comment', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 9; RMX1811 Build/PKQ1.190319.001)', 1652205703, 0, 21.146601, 79.088860, '106.79.172.43'),
(46, 5, '#ffffff', '#d75641', 0, 0, 0, 0, 1, 1, 1, 'https://www.instagram.com/p/CdWAxiEBsBK/?igshid=YmMyMTA2M2Y=', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1652205242, 0, 21.146601, 79.088860, '152.57.178.163'),
(45, 13, '#ffffff', '#fe780a', 0, 0, 0, 0, 1, 1, 1, 'Its 11:30 pm Good Night 🌉', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 9; RMX1811 Build/PKQ1.190319.001)', 1652205221, 0, 21.146601, 79.088860, '49.14.93.204'),
(42, 5, '#ffffff', '#fe780a', 0, 0, 0, 0, 1, 1, 1, 'https://youtu.be/Aut32pR5PQA', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1652001090, 1652001216, 21.146601, 79.088860, '152.57.143.139'),
(43, 5, '#ffffff', '#4d54ec', 0, 0, 0, 0, 1, 1, 1, '.', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1652001169, 1652001218, 21.146601, 79.088860, '152.57.143.139'),
(39, 5, '#ffffff', '#feffff', 0, 0, 0, 0, 1, 0, 0, 'Hello users, this is admin requesting you all for fair use of application. Please dont abuse', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1651947056, 1651988182, 21.146601, 79.088860, '152.57.139.20'),
(44, 13, '#35ffff', '#ff0072', 2, 0, 0, 0, 1, 1, 1, 'Happy Mother\\\'s Day ..... ❤️', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 9; RMX1811 Build/PKQ1.190319.001)', 1652204577, 0, 21.146601, 79.088860, '1.187.4.231'),
(41, 5, '#ffffff', '#000000', 0, 0, 0, 0, 1, 1, 1, 'Hello users, this is admin requesting you all for fair use of application. Please dont abuse', 'Maharashtra', 'India', 'Nagpur', 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', 1651988267, 1651988291, 21.146601, 79.088860, '152.57.158.171');

-- --------------------------------------------------------

--
-- Table structure for table `item_comments`
--

DROP TABLE IF EXISTS `item_comments`;
CREATE TABLE IF NOT EXISTS `item_comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `replyToUserId` int(11) UNSIGNED DEFAULT '0',
  `likesCount` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `itemFromUserId` int(11) UNSIGNED DEFAULT '0',
  `colorId` int(11) UNSIGNED DEFAULT '0',
  `iconId` int(11) UNSIGNED DEFAULT '0',
  `comment` varchar(800) DEFAULT NULL,
  `area` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `country` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) CHARACTER SET utf8 DEFAULT '',
  `ip_addr` char(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_comments`
--

INSERT INTO `item_comments` (`id`, `fromUserId`, `replyToUserId`, `likesCount`, `itemId`, `itemFromUserId`, `colorId`, `iconId`, `comment`, `area`, `country`, `city`, `createAt`, `removeAt`, `u_agent`, `ip_addr`) VALUES
(1, 4, 0, 0, 5, 3, 13, 41, 'hi', 'Maharashtra', 'India', 'Nagpur', 1645970097, 1646044083, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '106.210.215.75'),
(2, 5, 0, 0, 5, 3, 8, 47, 'I received', 'Maharashtra', 'India', 'Savner', 1645970294, 1651946877, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(3, 5, 0, 0, 5, 3, 8, 47, 'you see it\\\'s giving random username for users while commenting', 'Maharashtra', 'India', 'Savner', 1645970324, 1651946877, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(4, 5, 0, 0, 13, 6, 10, 5, 'yup', 'Maharashtra', 'India', 'Savner', 1645972298, 1646044081, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(5, 5, 0, 0, 23, 5, 0, 0, 'hddjsn', 'Maharashtra', 'India', 'Savner', 1646307506, 1646308549, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(6, 9, 0, 0, 27, 9, 0, 0, 'ghhhh', 'Maharashtra', 'India', 'Nagpur', 1646382206, 1647608612, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '203.192.219.84'),
(7, 5, 0, 0, 5, 3, 8, 47, 'hello', 'Maharashtra', 'India', 'Savner', 1648118239, 1651946877, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.17.130'),
(8, 5, 0, 0, 4, 2, 14, 40, 'working', 'Maharashtra', 'India', 'Savner', 1648118301, 1651946872, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.17.130'),
(9, 5, 0, 0, 30, 5, 0, 0, 'good morning', 'Maharashtra', 'India', 'Savner', 1648185365, 1650437307, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.73.172'),
(10, 5, 0, 0, 29, 5, 0, 0, 'thanks', 'Maharashtra', 'India', 'Savner', 1648185376, 1650518939, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.73.172'),
(11, 12, 0, 0, 31, 12, 0, 0, 'hghsbkjfksjfkjs', 'Maharashtra', 'India', 'Nagpur', 1648192853, 1648193306, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '157.33.73.172'),
(12, 17, 0, 0, 34, 5, 14, 21, 'bkbfjkebjjk', 'Maharashtra', 'India', 'Nagpur', 1650352492, 1650352545, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '152.57.42.158'),
(13, 9, 0, 0, 36, 9, 0, 0, 'Chutiya hu mai', 'Maharashtra', 'India', 'Nagpur', 1650436960, 1650857783, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '157.33.207.3'),
(14, 5, 0, 0, 36, 9, 15, 1, 'indeed', 'Maharashtra', 'India', 'Nagpur', 1650437118, 1650857783, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.189.170'),
(15, 9, 0, 0, 37, 9, 0, 0, 'chutiya hai kya', 'Maharashtra', 'India', 'Yerla', 1650518844, 1650857780, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '157.33.38.6'),
(16, 5, 0, 0, 47, 5, 0, 0, 'ping me', 'Maharashtra', 'India', 'Nagpur', 1652205314, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.178.163');

-- --------------------------------------------------------

--
-- Table structure for table `item_followers`
--

DROP TABLE IF EXISTS `item_followers`;
CREATE TABLE IF NOT EXISTS `item_followers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_followers`
--

INSERT INTO `item_followers` (`id`, `userId`, `itemId`, `createAt`, `removeAt`) VALUES
(1, 1, 1, 1645964650, 1651946850),
(2, 1, 2, 1645964801, 1645968731),
(3, 1, 3, 1645964927, 1651946874),
(4, 2, 4, 1645968973, 1651946872),
(5, 3, 5, 1645969824, 1651946877),
(6, 4, 6, 1645970052, 1645970173),
(7, 4, 6, 1645970179, 1651946871),
(8, 5, 7, 1645970576, 1647608662),
(9, 5, 8, 1645970606, 1651946876),
(10, 5, 9, 1645970839, 1651946868),
(11, 5, 10, 1645970958, 1645982593),
(12, 5, 11, 1645971012, 1651946865),
(13, 5, 12, 1645971050, 1651946865),
(14, 6, 13, 1645971069, 1651946859),
(15, 5, 14, 1645972601, 1651946863),
(16, 5, 15, 1645972919, 1651946858),
(17, 5, 1, 1645975133, 1651946850),
(18, 7, 16, 1645981637, 1651946855),
(19, 5, 17, 1645982461, 1645982580),
(20, 5, 18, 1645982499, 1646212809),
(21, 7, 19, 1646042245, 1646063257),
(22, 6, 20, 1646043694, 1646063256),
(23, 5, 21, 1646145310, 1651946853),
(24, 4, 22, 1646210364, 1646308545),
(25, 5, 22, 1646212818, 1646212882),
(26, 5, 22, 1646301060, 1646308545),
(27, 5, 23, 1646307494, 1646308549),
(28, 5, 24, 1646308349, 1646308539),
(29, 4, 25, 1646381932, 1647608618),
(30, 9, 26, 1646382108, 1647608621),
(31, 9, 27, 1646382183, 1647608612),
(32, 5, 28, 1647498062, 1651946852),
(33, 5, 29, 1648022267, 1650518939),
(34, 5, 30, 1648177614, 1650437307),
(35, 12, 31, 1648192841, 1648193306),
(36, 6, 32, 1649932890, 1650857786),
(37, 5, 33, 1650182055, 1650334821),
(38, 5, 34, 1650335565, 1650352545),
(39, 5, 35, 1650357577, 1651946851),
(40, 9, 36, 1650436929, 1650857783),
(41, 9, 37, 1650518818, 1650857780),
(42, 13, 38, 1650771575, 1651946851),
(43, 5, 39, 1651947056, 1651947126),
(44, 5, 40, 1651947154, 1651947163),
(45, 5, 41, 1651988267, 1651988291),
(46, 5, 42, 1652001090, 1652001216),
(47, 5, 43, 1652001169, 1652001218),
(48, 13, 44, 1652204577, 0),
(49, 13, 45, 1652205221, 0),
(50, 5, 46, 1652205242, 0),
(51, 5, 47, 1652205296, 0),
(52, 5, 48, 1652205468, 0),
(53, 13, 49, 1652205564, 0),
(54, 13, 50, 1652205703, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_likes`
--

DROP TABLE IF EXISTS `item_likes`;
CREATE TABLE IF NOT EXISTS `item_likes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_likes`
--

INSERT INTO `item_likes` (`id`, `fromUserId`, `itemId`, `createAt`, `removeAt`, `ip_addr`) VALUES
(1, 4, 6, 1645970232, 1651946871, '106.210.215.75'),
(2, 5, 13, 1645972273, 1651946859, '152.57.61.194'),
(3, 5, 15, 1645975155, 1645975156, '152.57.61.194'),
(4, 5, 1, 1645975157, 1646025014, '152.57.61.194'),
(5, 5, 15, 1645975157, 1651946858, '152.57.61.194'),
(6, 7, 15, 1646021390, 1651946858, '106.195.0.115'),
(7, 5, 1, 1646025014, 1646025017, '157.33.58.123'),
(8, 5, 3, 1646025015, 1646025016, '157.33.58.123'),
(9, 12, 31, 1648192848, 1648193306, '157.33.73.172'),
(10, 17, 34, 1650352502, 1650352545, '152.57.42.158'),
(11, 9, 1, 1650518760, 1651946850, '157.33.38.6'),
(12, 13, 14, 1651552056, 1651946863, '106.66.207.170'),
(13, 13, 15, 1651552059, 1651946858, '106.66.207.170'),
(14, 13, 16, 1651552063, 1651946855, '106.66.207.170'),
(15, 5, 44, 1652205139, 0, '152.57.178.163'),
(16, 13, 44, 1652205172, 0, '106.79.185.52');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chatId` int(11) UNSIGNED DEFAULT '0',
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `toUserId` int(11) UNSIGNED DEFAULT '0',
  `message` varchar(800) DEFAULT NULL,
  `imgUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `stickerId` int(11) UNSIGNED DEFAULT '0',
  `stickerImgUrl` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `seenAt` int(11) UNSIGNED DEFAULT '0',
  `seenFromUserId` int(11) UNSIGNED DEFAULT '0',
  `seenToUserId` int(11) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) CHARACTER SET utf8 DEFAULT '',
  `ip_addr` char(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chatId`, `fromUserId`, `toUserId`, `message`, `imgUrl`, `stickerId`, `stickerImgUrl`, `createAt`, `removeAt`, `seenAt`, `seenFromUserId`, `seenToUserId`, `u_agent`, `ip_addr`) VALUES
(1, 1, 4, 3, 'hi', '', 0, '', 1645970192, 0, 0, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '106.210.215.75'),
(2, 2, 5, 6, 'hello dude', '', 0, '', 1645972320, 0, 1645972347, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(3, 2, 5, 6, '', 'https://ioptimus.me/stickers/18.png', 18, 'https://ioptimus.me/stickers/18.png', 1645972336, 0, 1645972347, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(4, 2, 6, 5, '🙋‍♂️', '', 0, '', 1645972362, 0, 1645972413, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.177.74'),
(5, 2, 5, 6, 'who is this', '', 0, '', 1645972371, 0, 1645972377, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(6, 2, 5, 6, '', 'https://ioptimus.me/chat_images/img_fb244db1g2.jpg', 0, '', 1645972391, 0, 1645972396, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(7, 2, 6, 5, 'who\\\'s there', '', 0, '', 1645972433, 0, 1645972456, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.177.74'),
(8, 2, 5, 6, 'vedant', '', 0, '', 1645972463, 0, 1645972469, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(9, 2, 5, 6, 'send me hi', '', 0, '', 1645972474, 0, 1645972494, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(10, 2, 6, 5, 'hi', '', 0, '', 1645972485, 0, 1645972501, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.177.74'),
(11, 2, 5, 6, '', 'https://ioptimus.me/chat_images/img_ba8c3f47f5.jpg', 0, '', 1645972510, 1651946926, 1645972516, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(12, 2, 5, 6, 'notification working', '', 0, '', 1645972519, 0, 1645972558, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(13, 2, 6, 5, 'yes , I also got notification', '', 0, '', 1645972538, 0, 1645972550, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.177.74'),
(14, 3, 5, 1, 'hello dude', '', 0, '', 1645975142, 1646206193, 0, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.61.194'),
(15, 4, 5, 7, 'hi yaah', '', 0, '', 1645982318, 1648175559, 1645982347, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(16, 4, 5, 7, 'yash', '', 0, '', 1645982322, 1648175559, 1645982347, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(17, 4, 5, 7, '🤣', '', 0, '', 1645982329, 1648175559, 1645982347, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(18, 4, 7, 5, 'hiiiiiii😁😁', '', 0, '', 1645982362, 1648175559, 1645982366, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '117.99.250.96'),
(19, 4, 5, 7, 'ads remove kar diye', '', 0, '', 1645982380, 1648175559, 1645982388, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(20, 4, 7, 5, '👍', '', 0, '', 1645982388, 1648175559, 1645982393, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '117.99.250.96'),
(21, 4, 5, 7, 'abhi bhi google sign in nahi chal raha', '', 0, '', 1645982392, 1648175559, 1645982399, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(22, 4, 7, 5, 'jane de', '', 0, '', 1645982405, 1648175559, 1645982432, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '117.99.250.96'),
(23, 4, 7, 5, 'bhaad mein dekh lena', '', 0, '', 1645982414, 1648175559, 1645982432, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '117.99.250.96'),
(24, 4, 5, 7, 'bas kal deekhane ke liye setting ki hai', '', 0, '', 1645982422, 1648175559, 1645982482, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '182.68.23.51'),
(25, 2, 5, 6, '', 'https://ioptimus.me/stickers/20.png', 20, 'https://ioptimus.me/stickers/20.png', 1646025245, 0, 1646026527, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.58.123'),
(26, 4, 7, 5, 'hello', '', 0, '', 1646027446, 1648175559, 1646027482, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '106.220.237.4'),
(27, 4, 5, 7, 'hi', '', 0, '', 1646027486, 1648175559, 1646027524, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.75.146'),
(28, 4, 7, 5, 'kya kar rha hai', '', 0, '', 1646027529, 1648175559, 1646027534, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '106.220.237.4'),
(29, 4, 5, 7, 'YouTube video dekh raha hu', '', 0, '', 1646027551, 1648175559, 1646027552, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.75.146'),
(30, 4, 7, 5, 'accha hai', '', 0, '', 1646027560, 1648175559, 1646027561, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX1921 Build/RKQ1.201217.002)', '106.220.237.4'),
(31, 4, 5, 7, '', 'https://ioptimus.me/stickers/19.png', 19, 'https://ioptimus.me/stickers/19.png', 1646212849, 1648175559, 0, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '152.57.115.84'),
(32, 2, 5, 6, '', 'https://ioptimus.me/stickers/8.png', 8, 'https://ioptimus.me/stickers/8.png', 1646307548, 0, 1646307588, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(33, 2, 6, 5, '🐀🐀', '', 0, '', 1646307609, 0, 1646307779, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.152.126'),
(34, 2, 5, 6, '🤣🤣🤣', '', 0, '', 1646307784, 0, 1648114607, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(35, 2, 6, 5, 'hi', '', 0, '', 1648114626, 0, 1648114658, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '157.33.6.52'),
(36, 2, 6, 5, 'hey', '', 0, '', 1648179971, 0, 1648185349, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.13.54'),
(37, 5, 12, 5, 'cbibkfjskjfskj', '', 0, '', 1648192914, 1650333611, 1650182076, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '157.33.73.172'),
(38, 2, 6, 5, '😍', '', 0, '', 1648193959, 0, 1648279931, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2040 Build/RP1A.200720.011)', '152.57.10.178'),
(39, 6, 16, 1, 'hello sir', '', 0, '', 1650335402, 1650335486, 0, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '171.50.142.82'),
(40, 6, 16, 1, '😊😊', '', 0, '', 1650335466, 1650335486, 0, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '171.50.142.82'),
(41, 7, 16, 5, 'Hello sir😊', '', 0, '', 1650335627, 0, 1650335705, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '171.50.142.82'),
(42, 7, 16, 5, 'Are you admin', '', 0, '', 1650335664, 0, 1650335705, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '171.50.142.82'),
(43, 7, 16, 5, '', 'https://ioptimus.me/stickers/1.png', 1, 'https://ioptimus.me/stickers/1.png', 1650335698, 0, 1650335705, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '171.50.142.82'),
(44, 7, 5, 16, 'Hello', '', 0, '', 1650335718, 0, 1650335741, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '171.50.142.82'),
(45, 7, 5, 16, 'yes', '', 0, '', 1650335725, 0, 1650335741, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '171.50.142.82'),
(46, 7, 5, 16, '', 'https://ioptimus.me/stickers/3.png', 3, 'https://ioptimus.me/stickers/3.png', 1650335936, 0, 1650335941, 0, 0, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '171.50.142.82');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notifyToId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `notifyFromId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `notifyType` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `postId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fromUserId` int(11) UNSIGNED DEFAULT '0',
  `itemId` int(11) UNSIGNED DEFAULT '0',
  `abuseId` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(10) UNSIGNED DEFAULT '0',
  `u_agent` varchar(300) COLLATE utf8_unicode_ci DEFAULT '',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `fromUserId`, `itemId`, `abuseId`, `createAt`, `removeAt`, `u_agent`, `ip_addr`) VALUES
(1, 5, 22, 1, 1646301140, 1646301236, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(2, 5, 21, 3, 1646301156, 1646301236, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(3, 5, 18, 2, 1646301212, 1646301236, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(4, 5, 22, 3, 1646301255, 1646302447, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(5, 5, 18, 1, 1646302456, 1651946854, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(6, 5, 16, 3, 1646302465, 1651946855, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(7, 5, 24, 0, 1646308440, 1646308539, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '157.33.84.104'),
(8, 5, 29, 0, 1648022663, 1650518939, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '110.226.92.225'),
(9, 12, 30, 0, 1648193096, 1650437307, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '157.33.73.172'),
(10, 0, 33, 0, 1650333384, 1650334821, 'Dalvik/2.1.0 (Linux; U; Android 11; M2101K7BI Build/RP1A.200720.011)', '171.50.142.82'),
(11, 17, 34, 0, 1650352513, 1650352545, 'Dalvik/2.1.0 (Linux; U; Android 7.1.2; SM-G988N Build/QP1A.190711.020)', '152.57.42.158'),
(12, 9, 30, 3, 1650437088, 1650437176, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '157.33.207.3'),
(13, 9, 30, 2, 1650437211, 1650437307, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '157.33.207.3'),
(14, 9, 29, 2, 1650518886, 1650518939, 'Dalvik/2.1.0 (Linux; U; Android 11; RMX2151 Build/RP1A.200720.011)', '157.33.38.6');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `intValue` int(10) UNSIGNED DEFAULT '0',
  `textValue` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `intValue`, `textValue`) VALUES
(3, 'allowGoogleAuthorization', 1, ''),
(9, 'limitItems', 10, ''),
(10, 'limitChats', 5, ''),
(11, 'limitLikes', 40, ''),
(12, 'limitComments', 40, ''),
(13, 'pinnedItemId', 41, '');

-- --------------------------------------------------------

--
-- Table structure for table `stickers_data`
--

DROP TABLE IF EXISTS `stickers_data`;
CREATE TABLE IF NOT EXISTS `stickers_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `imgUrl` varchar(255) DEFAULT '',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stickers_data`
--

INSERT INTO `stickers_data` (`id`, `imgUrl`, `createAt`, `removeAt`) VALUES
(1, 'https://ioptimus.me/stickers/1.png', 1645964488, 0),
(2, 'https://ioptimus.me/stickers/2.png', 1645964488, 0),
(3, 'https://ioptimus.me/stickers/3.png', 1645964488, 0),
(4, 'https://ioptimus.me/stickers/4.png', 1645964488, 0),
(5, 'https://ioptimus.me/stickers/5.png', 1645964488, 0),
(6, 'https://ioptimus.me/stickers/6.png', 1645964488, 0),
(7, 'https://ioptimus.me/stickers/7.png', 1645964488, 0),
(8, 'https://ioptimus.me/stickers/8.png', 1645964488, 0),
(9, 'https://ioptimus.me/stickers/9.png', 1645964488, 0),
(10, 'https://ioptimus.me/stickers/10.png', 1645964488, 0),
(11, 'https://ioptimus.me/stickers/11.png', 1645964488, 0),
(12, 'https://ioptimus.me/stickers/12.png', 1645964488, 0),
(13, 'https://ioptimus.me/stickers/13.png', 1645964488, 0),
(14, 'https://ioptimus.me/stickers/14.png', 1645964488, 0),
(15, 'https://ioptimus.me/stickers/15.png', 1645964488, 0),
(16, 'https://ioptimus.me/stickers/16.png', 1645964488, 0),
(17, 'https://ioptimus.me/stickers/17.png', 1645964488, 0),
(18, 'https://ioptimus.me/stickers/18.png', 1645964488, 0),
(19, 'https://ioptimus.me/stickers/19.png', 1645964488, 0),
(20, 'https://ioptimus.me/stickers/20.png', 1645964488, 0),
(21, 'https://ioptimus.me/stickers/21.png', 1645964488, 0),
(22, 'https://ioptimus.me/stickers/22.png', 1645964488, 0),
(23, 'https://ioptimus.me/stickers/23.png', 1645964488, 0),
(24, 'https://ioptimus.me/stickers/24.png', 1645964488, 0),
(25, 'https://ioptimus.me/stickers/25.png', 1645964488, 0),
(26, 'https://ioptimus.me/stickers/26.png', 1645964488, 0),
(27, 'https://ioptimus.me/stickers/27.png', 1645964488, 0);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accountId` int(11) UNSIGNED DEFAULT '0',
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT '',
  `subject` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `text` varchar(400) COLLATE utf8_unicode_ci DEFAULT '',
  `reply` varchar(400) COLLATE utf8_unicode_ci DEFAULT '',
  `removeAt` int(11) UNSIGNED DEFAULT '0',
  `createAt` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `accountId`, `email`, `subject`, `text`, `reply`, `removeAt`, `createAt`, `ip_addr`) VALUES
(1, 5, 'trickster3301@gmail.com', 'thanks', 'I liked your app.', '', 0, 1646026331, '152.57.75.146');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `passw` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lang` char(10) COLLATE utf8_unicode_ci DEFAULT 'en',
  `items_count` int(11) UNSIGNED DEFAULT '0',
  `likes_count` int(11) UNSIGNED DEFAULT '0',
  `comments_count` int(11) UNSIGNED DEFAULT '0',
  `ip_addr` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `createAt` int(10) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `passw`, `email`, `lang`, `items_count`, `likes_count`, `comments_count`, `ip_addr`, `createAt`) VALUES
(1, '894b4dad9ff65b6b7b454e9bbca824d0', 'trickster@gmail.com', 'en', 3, 0, 0, '152.57.61.194', 1645964592),
(2, 'f3c1ca6630378a895c45c1b2d6b0da03', 'trickster3301@gmail.com', 'en', 1, 0, 0, '152.57.61.194', 1645968948),
(11, 'a1f287d0a51a2ff674c0c583d686b985', 'abkjagaljalkglkl@gmail.com', 'en', 0, 0, 0, '110.226.92.225', 1648128747),
(4, '19af51a27a501e55e4f87c7df1c49d77', 'noor@mail.com', 'en', 2, 1, 0, '106.210.215.75', 1645970002),
(5, '26f9e8af35f12df0de2ea0442a74dfda', 'helloadmin@hotmail.com', 'en', 3, 1, 1, '152.57.61.194', 1645970162),
(6, 'e72427efa28c68a47018d2b77eb86a02', 'tusharw.cseb19@sbjit.edu.in', 'en', 2, 0, 0, '152.57.179.164', 1645970366),
(7, '8e9d78eaed9f1b06a9a5d579c863ee84', 'husuwjssj@gmail.com', 'en', 2, 1, 0, '117.99.250.96', 1645981589),
(8, '461974d42eeb4d48d35e17db63cf6b2a', 'vjnvc@hotmail.com', 'en', 0, 0, 0, '152.57.115.163', 1646143865),
(9, '08856f2e84b654a199d6ed2fdb88e846', 'sghhgg@yyff.com', 'en', 2, 1, 1, '203.192.219.84', 1646382081),
(10, 'c259bc6fc1a3b8eb6e10751a3d3c7a38', 'vhkhskhjksjslkk@gmail.com', 'en', 0, 0, 0, '117.97.180.2', 1647608507),
(12, 'b04a6f594e9262a455870b64c952ab68', 'jjdaljlkgjlk@gmail.com', 'en', 1, 0, 0, '157.33.73.172', 1648192788),
(13, '84071704c86f1d7390e3d6c31c8d496d', 'sah@gmail.com', 'en', 4, 1, 0, '106.66.211.32', 1648194004),
(14, '91f8d4bea410e415fe62acf265bdac9d', 'qgwuehesbsbs@hotmail.com', 'en', 0, 0, 0, '171.50.142.82', 1650333445),
(15, '09fa0acfa15c6f7ab74db3740f95b01b', 'fhsjjkjgkljsjlksl@gmail.com', 'en', 0, 0, 0, '171.50.142.82', 1650334628),
(16, '9d291e8868d9df879f17edac82c2cb1b', 'hkjshjglsjslkl@gmail.com', 'en', 0, 0, 0, '171.50.142.82', 1650335014),
(17, '1d0eadad0bc96b01ea8e2ddc79345834', 'vgchjgkuhfkjhk@gmail.com', 'en', 0, 0, 0, '152.57.42.158', 1650352480);
--
-- Database: `elearn`
--
CREATE DATABASE IF NOT EXISTS `elearn` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `elearn`;

-- --------------------------------------------------------

--
-- Table structure for table `app_versions`
--

DROP TABLE IF EXISTS `app_versions`;
CREATE TABLE IF NOT EXISTS `app_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latest_version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_versions`
--

INSERT INTO `app_versions` (`id`, `latest_version`) VALUES
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `added_id`, `date`, `time`) VALUES
(1, 65, 11, '2021-09-22', '03:31:41 PM'),
(2, 85, 11, '2021-09-29', '04:15:37 PM');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
CREATE TABLE IF NOT EXISTS `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `batch_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `batch_type` int(11) NOT NULL COMMENT '1= batch free , 2=batch paid',
  `batch_price` varchar(100) NOT NULL,
  `batch_offer_price` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_image` varchar(200) NOT NULL,
  `no_of_student` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `admin_id`, `cat_id`, `sub_cat_id`, `batch_name`, `start_date`, `end_date`, `start_time`, `end_time`, `batch_type`, `batch_price`, `batch_offer_price`, `description`, `batch_image`, `no_of_student`, `status`) VALUES
(8, 1, 2, 8, 'Physics Olympiad', '2021-08-24', '2021-12-31', '14:00:00', '16:00:00', 2, '7000', '700', 'Cras pretium faucibus turpis, ut aliquet odio congue pharetra. Sed id ante porta, viverra nibh sit amet, tristique nibh. Morbi at congue ante. Integer quis varius sapien. Phasellus vitae tempus mi, a auctor magna. Integer euismod a tortor quis pharetra. In nec risus non nisi porttitor tincidunt. Aenean luctus sem mattis laoreet iaculis. Pellentesque cursus mauris vel augue mattis fermentum.', 'Physics_210928150338.jpg', 0, 1),
(5, 1, 2, 8, 'Math Olympiad by Kamath ', '2021-08-18', '2021-12-31', '16:00:00', '19:00:00', 2, '100', '50', 'Cras pretium faucibus turpis, ut aliquet odio congue pharetra. Sed id ante porta, viverra nibh sit amet, tristique nibh. Morbi at congue ante. Integer quis varius sapien. Phasellus vitae tempus mi, a auctor magna. Integer euismod a tortor quis pharetra. In nec risus non nisi porttitor tincidunt. Aenean luctus sem mattis laoreet iaculis. Pellentesque cursus mauris vel augue mattis fermentum.', 'Olympiad_210928150547.jpg', 0, 1),
(9, 1, 2, 8, 'Chemistry Olympiad', '2021-08-26', '2021-12-31', '16:00:00', '19:00:00', 1, '', '', 'Cras pretium faucibus turpis, ut aliquet odio congue pharetra. Sed id ante porta, viverra nibh sit amet, tristique nibh. Morbi at congue ante. Integer quis varius sapien. Phasellus vitae tempus mi, a auctor magna. Integer euismod a tortor quis pharetra. In nec risus non nisi porttitor tincidunt. Aenean luctus sem mattis laoreet iaculis. Pellentesque cursus mauris vel augue mattis fermentum.', 'Chemistry_210928150322.jpg', 6, 1),
(21, 1, 0, 0, 'without cat testing', '2021-09-03', '2021-10-27', '18:00:00', '20:00:00', 1, '', '', 'fsfdsfds', 'Chemistry_211002165427.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch_category`
--

DROP TABLE IF EXISTS `batch_category`;
CREATE TABLE IF NOT EXISTS `batch_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_category`
--

INSERT INTO `batch_category` (`id`, `name`, `slug`, `status`, `time`) VALUES
(2, 'Olympiad', 'engineering', 1, '2021-08-20 06:51:52'),
(3, 'Banking', 'civil_services_', 1, '2021-08-25 10:23:09'),
(4, 'Development', 'it', 1, '2021-09-16 11:23:33'),
(6, 'Arts', 'the_arts', 1, '2021-09-16 11:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `batch_fecherd`
--

DROP TABLE IF EXISTS `batch_fecherd`;
CREATE TABLE IF NOT EXISTS `batch_fecherd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `batch_specification_heading` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_fecherd` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch_fecherd`
--

INSERT INTO `batch_fecherd` (`id`, `batch_id`, `batch_specification_heading`, `batch_fecherd`) VALUES
(1, 1, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Feature 2\",\"Feature 3\"]'),
(3, 2, 'ddgf', '[\"gfhgffdgh\",\"fdghgfhjkhkj\"]'),
(4, 2, '', '[\"Hello testing 1\"]'),
(5, 3, '', '[\"\"]'),
(6, 4, '', '[\"\"]'),
(7, 5, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Feature 2\",\"Feature 3\"]'),
(8, 5, 'What will I get?', '[\"10000+ Questions\",\"1000+ Test Series\",\"Video Lectures\"]'),
(9, 6, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Understand concepts of networking.\",\"Feature 3\"]'),
(10, 6, 'What will I get?', '[\"Books\",\"Practice Kit\",\"Live support\"]'),
(11, 7, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Features 2\",\"Features 3\"]'),
(12, 7, 'What will I get?', '[\"10000 + questions\",\"100+ test papers\",\"Video Lectures for all topic\"]'),
(13, 8, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Features 2\",\"Features 3\"]'),
(14, 8, 'What will I get?', '[\"10000+ questions\",\"Free pdf books\",\"Free Notes\",\"Live classes\"]'),
(15, 9, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Features 2\",\"Features 3\"]'),
(16, 9, 'What will I get?', '[\"10000+ Questions\",\"100+ Papers\",\"Live Classes\",\"Video Lectures\"]'),
(17, 10, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"Feature 2\",\"Feature 3\"]'),
(18, 10, 'What will I get?', '[\"1000+ questions\",\"500+ papers\",\"Study Material\"]'),
(19, 11, '', '[\"\"]'),
(20, 12, 'What will I learn?', '[\"You will be able to solve complex problems easily.\",\"You will be able to solve complex problems easily.\",\"You will be able to solve complex problems easily.\"]'),
(21, 13, '', '[\"\"]'),
(22, 14, 'What will I learn?', '[\"You will be able to solve tricky problems easily.\",\"You will be able to solve tricky problems easily.\"]'),
(23, 15, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\"]'),
(24, 15, 'What will I get?', '[\"10000+ questions\",\"100+ Sample papers\",\"Weekly live classes\"]'),
(25, 16, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\"]'),
(26, 16, 'What will I get?', '[\"1000+ Question papers\",\"100+ Test series\",\"Daily live classes\"]'),
(27, 17, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\"]'),
(28, 17, 'What will I get?', '[\"1000+ Question papers\",\"1000+ Solved papers\",\"Live Classes\"]'),
(29, 18, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\"]'),
(30, 18, 'What will I get?', '[\"Video Tutorial\",\"100+ Series of programs\",\"10+ Programs for your portfolio \",\"Certificate after course completion\"]'),
(31, 14, 'What will I get?', '[\"Live classes\",\"24*7 Support\",\"5 Projects for portfolio \",\"Certificate after completion\"]'),
(32, 12, 'What will I get?', '[\"Live classes\",\"5 Projects for your portfolio\",\"Certificate after completions\",\"24*7 Support\",\"Life time access\"]'),
(33, 19, 'What will I learn?', '[\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\",\"You will be able to solve complex problem easily.\"]'),
(34, 19, 'What will I get?', '[\"10 Programs to showcase in your portfolio \",\"Certificate after completion\",\"24*7 Support\",\"Live classes\"]'),
(35, 20, '', '[\"\"]'),
(36, 21, 'What will I learn?', '[\"Test 1\",\"Test 2\"]'),
(37, 22, 'test', '[\"test\"]'),
(38, 23, '', '[\"\"]');

-- --------------------------------------------------------

--
-- Table structure for table `batch_subcategory`
--

DROP TABLE IF EXISTS `batch_subcategory`;
CREATE TABLE IF NOT EXISTS `batch_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch_subjects`
--

DROP TABLE IF EXISTS `batch_subjects`;
CREATE TABLE IF NOT EXISTS `batch_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter` varchar(500) NOT NULL,
  `sub_start_date` date NOT NULL,
  `sub_end_date` date NOT NULL,
  `sub_start_time` time NOT NULL,
  `sub_end_time` time NOT NULL,
  `chapter_status` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of completed chapter',
  `chapter_complt_date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total_chapter_complt_date` datetime NOT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `batch_id` (`batch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_subjects`
--

INSERT INTO `batch_subjects` (`id`, `batch_id`, `teacher_id`, `subject_id`, `chapter`, `sub_start_date`, `sub_end_date`, `sub_start_time`, `sub_end_time`, `chapter_status`, `chapter_complt_date`, `total_chapter_complt_date`, `added_on`) VALUES
(134, 15, 8, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2021-09-16', '2021-12-31', '14:00:00', '16:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 14:39:42'),
(135, 15, 11, 13, '[\"74\"]', '2021-10-08', '2021-10-29', '14:00:00', '16:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 14:39:42'),
(118, 9, 9, 3, '[\"13\",\"14\",\"15\",\"16\"]', '2021-08-26', '2021-12-31', '16:00:00', '19:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:03:22'),
(116, 10, 10, 7, '[\"46\",\"47\",\"48\"]', '2021-08-25', '2021-12-31', '17:00:00', '20:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:03:01'),
(117, 10, 8, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2021-08-25', '2021-12-31', '17:00:00', '20:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:03:01'),
(124, 5, 8, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2021-08-18', '2021-12-31', '16:00:00', '19:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:05:47'),
(119, 8, 8, 2, '[\"7\",\"8\",\"9\",\"10\",\"11\",\"12\"]', '2021-08-24', '2021-12-31', '14:00:00', '16:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:03:38'),
(132, 14, 11, 12, '[\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\"]', '2021-09-16', '2021-09-30', '17:00:00', '06:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 11:43:39'),
(122, 16, 8, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2021-09-16', '2021-11-30', '12:00:00', '14:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:05:22'),
(121, 17, 8, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2021-09-16', '2021-11-30', '14:00:00', '16:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:05:09'),
(114, 18, 11, 12, '[\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\"]', '2021-09-16', '2021-12-31', '15:00:00', '17:00:00', '[\"51\"]', '{\"51\":\"29-09-2021\"}', '0000-00-00 00:00:00', '2021-09-28 15:02:22'),
(133, 12, 11, 11, '[\"60\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\"]', '2021-09-22', '2021-09-21', '15:00:00', '16:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 11:43:54'),
(113, 19, 11, 13, '[\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\"]', '2021-09-16', '2021-12-31', '16:00:00', '18:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:02:09'),
(125, 20, 11, 11, '[\"65\"]', '2021-09-16', '2021-12-31', '12:00:00', '00:00:00', '', '', '0000-00-00 00:00:00', '2021-09-28 15:06:00'),
(137, 21, 11, 12, '[\"58\"]', '2021-09-10', '2021-09-28', '18:00:00', '20:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 16:54:27'),
(136, 22, 11, 13, '[\"72\",\"74\",\"75\"]', '2021-09-04', '2021-09-04', '18:00:00', '20:00:00', '', '', '0000-00-00 00:00:00', '2021-10-02 16:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `image`, `description`, `admin_id`, `added_by`, `status`, `create_at`) VALUES
(1, 'How to manage Time?', 'blog-celebrating-student-success_210920181157.png', '<div><h3>A 5-step time management program for more productive days Due to the sheer number of ways you can increase and optimize your time management, we’ve broken this guide up into a 5-step program. Start from the beginning or feel free to jump to the section where you need the most help.</h3><h4>Step 1: </h4><p>Understand where your time is going a time audit to set your intentions and see where your time currently goesUnderstand the Planning Fallacy so you can be realistic about what can be done in a dayDiscover the unseen distractions that are eating up your time Set up systems to track your daily progress and stay on track</p><p>Step 2: </p><p>Set smart goals and prioritize time for meaningful work Set smarter goals Prioritize your tasks ruthlessly using one of this practical methods Separate the urgent from the important workUse the 30X rule to delegate more tasksProtect your priorities by learning to say “no” to your boss, clients, and managers</p><p>Step 3: </p><p>Build an efficient daily scheduleBuild a morning routine that gives you momentum Use time blocking to create a daily template Make time for interruptions and breaks‘Batch’ your communication time Give up on multitasking and context switching Work with your body’s natural energy cycle</p><p>Step 4:</p><p> Optimize your work environment Get rid of the clutter (both physical and digital)Reduce noise issues with headphones or (the right) music Bring a bit of nature into your workspace Set up your tools for focusTry the “Workstation Popcorn” method</p><p>Step 5: </p><p>Protect your time (and your focus) from distractions strategic laziness to work on the right things automate non-negotiable focused time throughout the day Use the Ivy Lee Method to end your day properly Don’t forget the benefits of free time Use the right time management tools</p></div>', 1, '', 1, '2021-09-20 18:11:57'),
(2, 'dsdsa', 'images_barcode_210921125845.png', '<h2 xss=removed>What is Lorem Ipsum?</h2><p xss=removed><strong xss=removed>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>', 1, '', 1, '2021-09-21 12:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_role` varchar(11) NOT NULL,
  `user_name` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_email` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_mobile` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `comments` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = painding ,1 =complete , 2 = decline',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `admin_id`, `user_id`, `user_role`, `user_name`, `user_email`, `user_mobile`, `user_image`, `comments`, `status`, `create_at`) VALUES
(1, 1, 1, '1', '1', 'admin', 'admin@eacademy.com', '', 'student_img.png', 'dsdsa', 0, '2021-09-21 19:10:51'),
(2, 1, 1, '1', '1', 'admin', 'admin@eacademy.com', '', 'student_img.png', 'dsdsa', 0, '2021-09-21 19:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments_reply`
--

DROP TABLE IF EXISTS `blog_comments_reply`;
CREATE TABLE IF NOT EXISTS `blog_comments_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` varchar(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `reply` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_pdf`
--

DROP TABLE IF EXISTS `book_pdf`;
CREATE TABLE IF NOT EXISTS `book_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

DROP TABLE IF EXISTS `certificate`;
CREATE TABLE IF NOT EXISTS `certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_setting`
--

DROP TABLE IF EXISTS `certificate_setting`;
CREATE TABLE IF NOT EXISTS `certificate_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_heading` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `certificate_logo` varchar(500) NOT NULL,
  `signature_image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_setting`
--

INSERT INTO `certificate_setting` (`id`, `heading`, `sub_heading`, `title`, `description`, `certificate_logo`, `signature_image`) VALUES
(1, 'Certificate', 'Certificate of Completion', 'Program', 'hjhj', 'logoeacademy.svg', 'sign-12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `chapter_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `no_of_questions` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `chapter_name`, `status`, `no_of_questions`) VALUES
(38, 8, 'Guptas Vakatakas and Vardhanas', 1, 0),
(42, 9, 'International Events', 1, 0),
(43, 9, 'India and its neighbouring countries', 1, 0),
(44, 9, 'Chronology of Medieval India and their important systems', 1, 0),
(45, 9, 'Name of the Kings who built important ancient Temples and Institutions like Nalanda', 1, 0),
(46, 7, 'Verbs', 1, 0),
(47, 7, 'Grammar', 1, 0),
(48, 7, 'Article', 1, 0),
(49, 10, 'test 1', 1, 0),
(50, 10, 'test 2', 1, 0),
(51, 12, 'Basics', 1, 0),
(52, 12, 'Variable Declaration', 1, 0),
(53, 12, 'Definition and Scope', 1, 0),
(54, 12, 'Data Types', 1, 0),
(55, 12, 'Storage Classes', 1, 0),
(56, 12, 'Input and Output', 1, 2),
(57, 12, 'Operators', 1, 0),
(58, 12, 'Preprocessor', 1, 0),
(59, 12, 'Arrays and String', 1, 0),
(60, 11, 'Basics', 1, 0),
(61, 11, 'Variable Declaration', 1, 0),
(62, 11, 'Definition and Scope', 1, 0),
(63, 11, 'Data Types', 1, 0),
(64, 11, 'Storage Classes', 1, 0),
(65, 11, 'Input and Output', 1, 0),
(66, 11, 'Operators', 1, 0),
(67, 11, 'Preprocessor', 1, 0),
(68, 11, 'Arrays and String', 1, 0),
(69, 13, 'Variable Declaration', 1, 0),
(70, 13, 'Definition and Scope', 1, 0),
(71, 13, 'Data Types', 1, 0),
(72, 13, 'Storage Classes', 1, 0),
(73, 13, 'Input and Output', 1, 0),
(74, 13, 'Operators', 1, 0),
(75, 13, 'Preprocessor', 1, 0),
(76, 13, 'Arrays and String', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `course_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `mobile`, `email`, `subject`, `message`, `date`) VALUES
(2, 'darshal', '9826098260', 'darshal@gmail.com', 'Enquiry about course ', 'I want details about Phasellus auctor faucibus erat, nec semper mi. Aliquam vitae metus viverra, ultrices velit id, pellentesque risus. Maecenas eu turpis lorem.', '2021-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 - mock, 2 - practice',
  `format` int(11) NOT NULL COMMENT '1 - Shuffle, 2 - Fix',
  `batch_id` int(11) NOT NULL,
  `total_question` varchar(255) NOT NULL,
  `time_duration` varchar(255) NOT NULL COMMENT 'In Minute Only',
  `question_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mock_sheduled_date` date NOT NULL,
  `mock_sheduled_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extra_classes`
--

DROP TABLE IF EXISTS `extra_classes`;
CREATE TABLE IF NOT EXISTS `extra_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `batch_id` varchar(500) NOT NULL,
  `added_at` datetime NOT NULL,
  `completed_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_classes`
--

INSERT INTO `extra_classes` (`id`, `admin_id`, `date`, `start_time`, `end_time`, `teacher_id`, `description`, `status`, `batch_id`, `added_at`, `completed_date_time`) VALUES
(1, 1, '2021-09-30', '15:00:00', '17:00:00', 11, 'extra class', 'Incomplete', '[\"19\",\"18\"]', '2021-09-29 16:38:44', '0000-00-00 00:00:00'),
(2, 1, '2021-10-06', '17:00:00', '19:00:00', 11, 'gjhsdgajhgdagdals daSKLJGHD SAKLJDGFASLDFGLSAKD ', 'Incomplete', '[\"18\"]', '2021-09-29 16:54:02', '0000-00-00 00:00:00'),
(3, 1, '2021-10-07', '15:00:00', '16:00:00', 11, 'gsdhj sg fsgj', 'Incomplete', '[\"18\"]', '2021-09-29 17:01:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `extra_class_attendance`
--

DROP TABLE IF EXISTS `extra_class_attendance`;
CREATE TABLE IF NOT EXISTS `extra_class_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `icon`, `description`, `status`) VALUES
(1, 'Study Material', 'icofont-address-book', 'We Provide Top Class Study Material to our students.', 1),
(2, 'Test Series', 'icofont-notepad', 'We provide 100+ test series for all the courses.', 1),
(3, 'Certificate', 'icofont-certificate', 'We provide certificates after completing the course successfully.', 1),
(4, 'Class Rooms', 'icofont-building', 'Fully furnished classrooms.', 1),
(5, '24 hrs. Expert Guidance', 'icofont-teacher', 'We provide around-the-clock support to our students.', 1),
(6, 'brainstorming', 'icofont-brainstorming', 'Brainstorming session Every week. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_details`
--

DROP TABLE IF EXISTS `frontend_details`;
CREATE TABLE IF NOT EXISTS `frontend_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `map_api` varchar(255) NOT NULL,
  `slider_details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_form_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faci_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faci_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sec_crse_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sec_crse_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_year` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_img` varchar(255) NOT NULL,
  `abt_sec_img` varchar(255) NOT NULL,
  `abt_sec_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_sec_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_secbtn_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_secbtn_url` varchar(255) NOT NULL,
  `abt_thrd_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_img` varchar(255) NOT NULL,
  `total_toppers` int(11) NOT NULL,
  `trusted_students` int(11) NOT NULL,
  `years_of_histry` int(11) NOT NULL,
  `testimonial` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testi_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testi_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selectn_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selectn_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_of_teacher` int(11) NOT NULL,
  `header_btn_txt` varchar(255) NOT NULL,
  `header_btn_url` varchar(255) NOT NULL,
  `client_imgs` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frontend_details`
--

INSERT INTO `frontend_details` (`id`, `mobile`, `email`, `address`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `map_api`, `slider_details`, `cont_heading`, `cont_sub_heading`, `cont_form_heading`, `faci_heading`, `faci_sub_heading`, `frst_crse_heading`, `frst_crse_sub_heading`, `frst_crse_desc`, `sec_crse_heading`, `sec_crse_sub_heading`, `abt_frst_heading`, `abt_frst_sub_heading`, `abt_year`, `abt_frst_desc`, `abt_frst_img`, `abt_sec_img`, `abt_sec_heading`, `abt_sec_desc`, `abt_secbtn_text`, `abt_secbtn_url`, `abt_thrd_heading`, `abt_thrd_sub_heading`, `abt_thrd_desc`, `abt_thrd_img`, `total_toppers`, `trusted_students`, `years_of_histry`, `testimonial`, `testi_heading`, `testi_subheading`, `selectn_heading`, `selectn_subheading`, `selection`, `teacher_heading`, `teacher_subheading`, `no_of_teacher`, `header_btn_txt`, `header_btn_url`, `client_imgs`) VALUES
(1, '1234567890', 'info@themes91.in', '04 A Agroha Nagar, Dewas, Madhya Pradesh', 'https://www.facebook.com', 'https://www.youtube.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.linkedin.com', '', '{\"slider_heading\":[\"Choose Best For Your Education\",\"Choose Best For Your Education\",\"Choose Best For Your Education\"],\"slider_subheading\":[\"Welcome to E-Academy\",\"Welcome to E-Academy\",\"Welcome to E-Academy\"],\"slider_desc\":[\"\",\"\",\"\"],\"slider_img\":[\"slider3.png\",\"slider1.png\",\"slider2.png\"]}', 'Contact Us For You Query', 'START WITH US', 'Send Us A Message', 'Our Facilities are', 'Our Facilities', 'Online Learning Plateform', 'WE ARE E - ACADEMY', '', 'Our Syllabus', 'WE ENHANCE YOUR TALENT', 'Why Choose Us', 'ABOUT E-ACADEMY', '1997', 'Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eesdoeit dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation and in ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum<br /><br />Excepteur sint occaecat cupidatat noesn proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut peerspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantiuws totam rem aperiam, eaque ipsa quae.Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eesdoeit dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'about_img1.png', 'about_img2.png', 'We Take Care Of Your Careers Do Not Worry', 'We Are Very Cost Friendly And We Would Love To Be A Part Of Your Home Happiness For A Long Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit Sed Eiusmod.', 'Contact Us', 'http://kamleshyadav.in/e-academy/contact-us', 'Why Choose Us From Thousands', 'OUR MISSION', 'Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eesdoeit dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation and in ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.<br /><br />Excepteur sint occaecat cupidatat noesn proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut peerspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantiuws totam rem aperiam, eaque ipsa quae.', 'vission_img.png', 654, 200, 50, '{\"4\":\"fsghhjjgh\",\"3\":\"fgfhg jjyjy qweqe qewfre ret\",\"1\":\"Consectetur adipiscing elit, sed do eiusmod tempor incididunt uerset labore et dolore magna aliqua. Qesuis ipsum esuspendisse ultriceies gravida Risus commodo viverra andes aecenas accumsan lacus vel facilisis. \",\"2\":\"Consectetur adipiscing elit, sed do eiusmod tempor incididunt uerset labore et dolore magna aliqua. Qesuis ipsum esuspendisse ultriceies gravida Risus commodo viverra andes aecenas accumsan lacus vel facilisis. \"}', 'What Student Says', 'E- ACADEMY REVIEWS', 'Our Selections', 'TOPPERS ARE HERE', '{\"2\":\"student\",\"3\":\"student\",\"1\":\"student\"}', 'Qualified Teacher', 'OUR EXPERTS', 6, '', '', '[\"01.png\",\"02.png\",\"03.png\",\"04.png\",\"05.png\",\"06.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `key_text` text NOT NULL,
  `velue_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `key_text`, `velue_text`) VALUES
(1, 'payment gateway type select 1 = razorpay, 2 paypal', 'payment_type', '1'),
(2, 'razorpay key id ', 'razorpay_key_id', 'rzp_test_SyX2TUG1AuuUiC'),
(3, 'razorpay secret key', 'razorpay_secret_key', 'IXo11AWGgZo7iH0UdrFDODGS'),
(4, 'paypal client id', 'paypal_client_id', 'AQoZsAppdXNlefqgf7DnKi9udy75SL4DmqPqRdP-HUODw7CpJDK3BAXClECVoS31dtTOPuNix_L04JD0'),
(5, 'paypal secret key', 'paypal_secret_key', ''),
(6, 'select language type ', 'language_name', 'english'),
(7, 'select currency code', 'currency_code', 'INR'),
(8, 'select currency decimal code', 'currency_decimal_code', '₹'),
(9, 'currency converter api', 'currency_converter_api', ''),
(10, 'send mails SMTP ', 'smtp_mail', 'info@themes91.in'),
(11, 'smtp password mail', 'smtp_pwd', '(I)7A2i!8jzE'),
(12, 'smtp server type mail', 'server_type', 'smtp'),
(13, 'smtp host mail', 'smtp_host', 'mail.themes91.in'),
(14, 'smtp host mails', 'smtp_port', '587'),
(15, 'smtp smtp encryption', 'smtp_encryption', 'tlc'),
(16, 'sandbox accounts', 'sandbox_accounts', 'EHDaz3PQlfFzI6EzgrXmqqfEbqp9bLqm593GIBcq36e4V46zusKiF9EmQ5_dVPoqCXSRoAiOreBrkvTF'),
(17, 'Firebase Accounts', 'firebase_key', 'AAAAFU0Nyks:APA91bFWu1zpzRasM60cqJjMvfcL5Uc667MP38b5CaYd5O3g-ioRYGtVSvBCdFUt5ea4H8eIDbPKNs98z5W0RxFfRsswy07p1EbSKRRlQkUA1b9sb_fBC2sHvFJZWhpILlZlOqz0_M4u');

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

DROP TABLE IF EXISTS `homeworks`;
CREATE TABLE IF NOT EXISTS `homeworks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_id` text NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_management`
--

DROP TABLE IF EXISTS `leave_management`;
CREATE TABLE IF NOT EXISTS `leave_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leave_msg` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`teacher_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `live_class_history`
--

DROP TABLE IF EXISTS `live_class_history`;
CREATE TABLE IF NOT EXISTS `live_class_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `start_time` varchar(500) NOT NULL,
  `end_time` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `live_class_setting`
--

DROP TABLE IF EXISTS `live_class_setting`;
CREATE TABLE IF NOT EXISTS `live_class_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch` int(11) NOT NULL,
  `zoom_api_key` varchar(500) NOT NULL,
  `zoom_api_secret` varchar(500) NOT NULL,
  `meeting_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mock_result`
--

DROP TABLE IF EXISTS `mock_result`;
CREATE TABLE IF NOT EXISTS `mock_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `submit_time` time NOT NULL,
  `total_question` int(11) NOT NULL,
  `time_duration` varchar(255) NOT NULL,
  `attempted_question` int(11) NOT NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double NOT NULL,
  `added_on` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes_pdf`
--

DROP TABLE IF EXISTS `notes_pdf`;
CREATE TABLE IF NOT EXISTS `notes_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes_pdf`
--

INSERT INTO `notes_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Notes on Average', '[\"5\"]', 'Average', 'Maths', '15_Average_(Math)210818184109.pdf', 1, 1, '2021-08-18 18:41:09'),
(2, 1, 'Hello', '[\"10\"]', 'Average', 'Maths', 'file-sample_150kB210927125417.pdf', 1, 8, '2021-09-27 12:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notice_for` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `read_status` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL,
  `seen_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `old_paper_pdf`
--

DROP TABLE IF EXISTS `old_paper_pdf`;
CREATE TABLE IF NOT EXISTS `old_paper_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `batch` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `topic` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `subject` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `file_name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `old_paper_pdf`
--

INSERT INTO `old_paper_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(2, 1, 'old paper', '[\"10\"]', '', 'General Knowledge', 'General-Knowledge-PDF210828153152.pdf', 1, 1, '2021-08-28 15:31:52'),
(3, 1, 'testing', '[\"10\"]', '', 'English', 'sample210830183702.pdf', 1, 1, '2021-08-30 18:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `practice_result`
--

DROP TABLE IF EXISTS `practice_result`;
CREATE TABLE IF NOT EXISTS `practice_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `submit_time` time NOT NULL,
  `total_question` int(11) NOT NULL,
  `time_duration` varchar(255) NOT NULL,
  `attempted_question` int(11) NOT NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double NOT NULL,
  `added_on` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practice_result`
--

INSERT INTO `practice_result` (`id`, `admin_id`, `student_id`, `paper_id`, `paper_name`, `date`, `start_time`, `submit_time`, `total_question`, `time_duration`, `attempted_question`, `question_answer`, `percentage`, `added_on`) VALUES
(26, 1, 85, 11, 'hgh', '2021-09-30', '17:45:00', '17:45:00', 10, '40', 7, '{\"11\":\"B\",\"13\":\"C\",\"16\":\"D\",\"17\":\"C\",\"19\":\"C\",\"20\":\"C\",\"21\":\"A\"}', 7.5, '2021-09-30 17:45:44'),
(27, 1, 85, 11, 'hgh', '2021-09-30', '18:07:00', '18:08:00', 10, '40', 9, '{\"11\":\"C\",\"12\":\"A\",\"13\":\"A\",\"16\":\"C\",\"17\":\"B\",\"18\":\"B\",\"19\":\"B\",\"20\":\"B\",\"21\":\"A\"}', 2.5, '2021-09-30 18:08:07'),
(28, 1, 85, 11, 'hgh', '2021-10-01', '14:27:00', '14:28:00', 10, '40', 10, '{\"11\":\"A\",\"12\":\"B\",\"13\":\"C\",\"14\":\"B\",\"16\":\"C\",\"17\":\"C\",\"18\":\"C\",\"19\":\"B\",\"20\":\"C\",\"21\":\"A\"}', 25, '2021-10-01 14:28:23'),
(29, 1, 85, 11, 'hgh', '2021-10-01', '15:44:00', '15:45:00', 10, '40', 10, '{\"11\":\"D\",\"12\":\"B\",\"13\":\"C\",\"14\":\"B\",\"16\":\"D\",\"17\":\"D\",\"18\":\"D\",\"19\":\"B\",\"20\":\"D\",\"21\":\"A\"}', 12.5, '2021-10-01 15:45:26'),
(30, 1, 85, 21, 'Pr1', '2021-10-01', '17:42:00', '17:43:00', 2, '2', 2, '{\"22\":\"B\",\"23\":\"A\"}', -25, '2021-10-01 17:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy_data`
--

DROP TABLE IF EXISTS `privacy_policy_data`;
CREATE TABLE IF NOT EXISTS `privacy_policy_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy_data`
--

INSERT INTO `privacy_policy_data` (`id`, `description`) VALUES
(1, '&lt;p&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Suspendisse consectetur metus tellus, nec efficitur metus lobortis in. Fusce dapibus lacus sed sapien tincidunt dictum. Aliquam quis&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Suspendisse consectetur metus tellus, nec efficitur metus lobortis in. Fusce dapibus lacus sed sapien tincidunt dictum. Aliquam quis&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `admin_id`, `subject_id`, `chapter_id`, `question`, `options`, `answer`, `added_by`, `status`, `category`, `added_on`) VALUES
(6, 1, 1, 1, 'If you add 1000 to 29898, you obtain', '[39898,30898,29998,29908]', 'B', 1, 1, 0, '2021-08-18 17:13:52'),
(7, 1, 1, 1, 'Which two numbers add up to a sum greater than 1000?', '[\"450 and 545\",\"999 and 1\",\"893 and 100\",\"989 and 12\"]', 'D', 1, 1, 0, '2021-08-18 17:13:52'),
(8, 1, 1, 1, '123 + 345 + 723 =', '[1191,468,1181,1068]', 'A', 1, 1, 0, '2021-08-18 17:13:52'),
(9, 1, 1, 1, 'If 15 + 20 = 20 + n, n is equal to', '[20,15,35,0]', 'B', 1, 1, 0, '2021-08-18 17:13:52'),
(10, 1, 1, 1, 'If z + y = 20 and y = 5, what is z?', '[25,15,5,10]', 'B', 1, 1, 0, '2021-08-18 17:13:52'),
(11, 1, 1, 1, 'There are 15,768 people watching a game in a football stadium and there are 34,890 empty seats. What is the total number of seats in the stadium?', '[\"50,658\",\"49,558\",\"40,658\",\"50,558\"]', 'A', 1, 1, 0, '2021-08-18 17:13:52'),
(12, 1, 1, 1, 'The sum of z and y is equal to 125. If y = 45, which equation can be used to find z?', '[\"z - y = 125\",\"z + y = 45\",\" z - 45 = 125\",\"z + 45 = 125\"]', 'D', 1, 1, 0, '2021-08-18 17:13:52'),
(13, 1, 1, 1, 'A school spent $14589 on computers, $1234 on tables and $876 on chairs. How much money did the school spend?', '[15589,16699,16599,16589]', 'B', 1, 1, 0, '2021-08-18 17:13:52'),
(14, 1, 1, 1, 'Linda wrote a number that is two hundred sixty-five thousand, one hundred eight greater than thirty-two thousand, two hundred twenty-nine. What number did she wrote?', '[\"297,000\",\"297,300\",\"297,327\",\"297,337\"]', 'D', 1, 1, 0, '2021-08-18 17:13:52'),
(21, 1, 3, 13, '<p>Which of the following compounds contains an allylic carbon?</p>\n\n<p><img alt=\"\" src=\"https://themes91.in/ci/e-academy-latest/assets/images/0e19cf85f526_test.png\" style=\"height:163px; width:585px\" /></p>\n\n<p>&nbsp;</p>\n', '[\"\\u003Cp\\u003EA\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EB\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EC\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003ED\\u003C\\/p\\u003E\\n\"]', 'A', 1, 1, 0, '2021-08-26 15:03:34'),
(16, 1, 1, 2, 'Which is the smallest?', '[-1,\"\\u00a0-1\\/2\",0,3]', 'A', 1, 1, 0, '2021-08-18 17:16:16'),
(17, 1, 1, 2, 'Combine terms: 12a + 26b -4b – 16a', '[\"4a + 22b\",\"-28a + 30b\",\"-4a + 22b\",\"28a + 30b\"]', 'C', 1, 1, 0, '2021-08-18 17:16:16'),
(18, 1, 1, 2, 'Simplify: (4 – 5) – (13 – 18 + 2)', '[\"\\u00a0-1\",\"\\u20132\",\"\\u00a01\",2]', 'D', 1, 1, 0, '2021-08-18 17:16:16'),
(19, 1, 1, 2, 'What is |-26|?', '[-26,\"\\u00a026\",\"\\u00a00\",\"\\u00a01\"]', 'B', 1, 1, 0, '2021-08-18 17:16:16'),
(20, 1, 1, 2, '3x4y3 – 48y3.', '[\"3y3(x2\\u00a0+ 4)(x + 2)(x -2)\",\"3y3(x2\\u00a0+ 4)(x + 2)\",\"3y(x2\\u00a0+ 4)(x + 2)\",\"3y3(x2\\u00a0+ 4)(x + 2)(x +2)\"]', 'A', 1, 1, 0, '2021-08-18 17:16:16'),
(22, 1, 12, 56, '<div style=\"display: none;\">&nbsp;</div>\n\n<p>Predict the output of below programs.</p>\n\n<p><code>#include</code></p>\n\n<p><code>int</code> <code>main()</code></p>\n\n<p><code>{</code></p>\n\n<p><code>&nbsp;&nbsp;&nbsp;</code><code>int</code> <code>n;</code></p>\n\n<p><code>&nbsp;&nbsp;&nbsp;</code><code>for</code><code>(n = 7; n!=0; n--)</code></p>\n\n<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>printf</code><code>(</code><code>&quot;n = %d&quot;</code><code>, n--);</code></p>\n\n<p><code>&nbsp;&nbsp;&nbsp;</code><code>getchar</code><code>();</code></p>\n\n<p><code>&nbsp;&nbsp;&nbsp;</code><code>return</code> <code>0;</code></p>\n\n<p><code>}</code></p>\n', '[\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003Einfinite loop\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003Einfinite loop\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003Einfinite loop\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003Einfinite loop\\u003C\\/p\\u003E\\n\"]', 'A', 1, 1, 0, '2021-09-17 15:01:12'),
(23, 1, 12, 56, '<p>What will be the output of the following C code?</p>\n\n<ol>\n	<li>\n	<pre>\n#include &lt;stdio.h&gt;</pre>\n	</li>\n	<li>\n	<pre>\n    int main()</pre>\n	</li>\n	<li>\n	<pre>\n    {</pre>\n	</li>\n	<li>\n	<pre>\n        int a[5] = {1, 2, 3, 4, 5};</pre>\n	</li>\n	<li>\n	<pre>\n        int i;</pre>\n	</li>\n	<li>\n	<pre>\n        for (i = 0; i &lt; 5; i++)</pre>\n	</li>\n	<li>\n	<pre>\n            if ((char)a[i] == &#39;5&#39;)</pre>\n	</li>\n	<li>\n	<pre>\n                printf(&quot;%d\\n&quot;, a[i]);</pre>\n	</li>\n	<li>\n	<pre>\n            else</pre>\n	</li>\n	<li>\n	<pre>\n                printf(&quot;FAIL\\n&quot;);</pre>\n	</li>\n	<li>\n	<pre>\n    }</pre>\n	</li>\n</ol>\n', '[\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EThe compiler will flag an error\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EThe program will compile and print the output 5\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EThe program will compile and print the ASCII value of 5\\u003C\\/p\\u003E\\n\",\"\\u003Cdiv style=\\u0022display: none;\\u0022\\u003E\\u0026nbsp;\\u003C\\/div\\u003E\\n\\n\\u003Cp\\u003EThe program will compile and print FAIL for 5 times\\u003C\\/p\\u003E\\n\"]', 'D', 1, 1, 0, '2021-09-17 15:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `site_details`
--

DROP TABLE IF EXISTS `site_details`;
CREATE TABLE IF NOT EXISTS `site_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_loader` varchar(255) NOT NULL,
  `site_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enrollment_word` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `copyright_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timezone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_details`
--

INSERT INTO `site_details` (`id`, `site_title`, `site_favicon`, `site_logo`, `site_loader`, `site_author`, `site_keywords`, `site_description`, `enrollment_word`, `copyright_text`, `timezone`) VALUES
(1, 'E Academy', 'fav.png', 'logoq.svg', 'e-academy.gif', 'Kamlesh Yadav', 'e academy,academy,education academy', 'Description about e-academy', 'ACAD', 'Copyright © 2020 E Academy. All Right Reserved.', 'Asia/Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enrollment_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `father_designtn` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_id` text NOT NULL,
  `login_status` int(11) NOT NULL,
  `admission_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL COMMENT '(0 unpaid ) (1 paid)',
  `brewers_check` varchar(50) NOT NULL,
  `token` varchar(500) NOT NULL,
  `app_version` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `last_login_app` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admin_id`, `name`, `enrollment_id`, `password`, `image`, `email`, `contact_no`, `gender`, `dob`, `father_name`, `father_designtn`, `address`, `batch_id`, `login_status`, `admission_date`, `status`, `payment_status`, `brewers_check`, `token`, `app_version`, `added_by`, `last_login_app`) VALUES
(42, 1, 'Akshay', 'ACAD14154', '21f555c16ba610d6058ec971ccae794b', 'student_img.png', 'testertretyryr@gmail.com', '1234567890', '', '0000-00-00', '', '', '', '5', 1, '2021-09-20', 1, 1, '', '', '', 'student', '2021-09-20 17:56:58'),
(43, 1, 'saloni', 'ACAD14235', '280dada61433c0d486505ee286a57525', 'student_img.png', 'saloni@gmailll.com', '1234567897890', '', '0000-00-00', '', '', '', '15', 1, '2021-09-20', 1, 1, '', 'fL9XVI6OSYGZmXMA-J3qFS:APA91bG5bV-NHKgkd6xDBKoYDFVbwZcU9oD8nhz-bhfMNavPkCBlUM_X4Svtrmx0CG_mSSL7RNUxRgri0FYrsQp6AXNCJ2e7UN6Ls5JggXPqlVqUbCpFJZwM8c_anSj-xg1RIPJrXWib', '10', 'student', '2021-09-20 18:00:06'),
(44, 1, 'abcde', 'ACAD14349', 'e7e519e6bffe14f0e89d8ef2f8e433f8', 'student_img.png', 'wipoja8072@secbuf.com', '01234567890', '', '0000-00-00', '', '', '', '0', 1, '2021-09-20', 1, 0, 'wUbvLQeVn7', '1', '', 'student', '2021-09-20 18:15:38'),
(45, 1, 'sachinsir', 'ACAD14441', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'sachinsir@gmail.com', '1234567890', '', '0000-00-00', '', '', '', '13', 1, '2021-09-21', 1, 1, '', 'clj7_Pu5SLeV8WI08CpTFa:APA91bFdse2SGtoF9a31_HNnLUkjQzLpUCLWTGh_5cn9gcxDU4lAorPe-IxTq_oRJG6_lqj0mMIpc5Tspjkmo-owQNok8qNnfBUChZG-VnTPIkLaWK37M9uQ7JMkJhcRrGW7n7tcIMv2', '10', 'student', '2021-09-21 14:05:08'),
(47, 1, 'test', 'ACAD14672', 'c4be1beaf59d46768991104e097e8ef2', 'student_img.png', 'tst@gmail.com', '987654321', '', '0000-00-00', '', '', '', '10', 0, '2021-09-21', 1, 0, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 14:24:41'),
(48, 1, 'tst1', 'ACAD14732', 'a0e9e563402451915caa11dbacf71747', 'student_img.png', 'tst1@gmail.com', '987654321', '', '0000-00-00', '', '', '', '10', 0, '2021-09-21', 1, 0, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 14:25:58'),
(49, 1, 'testingggg', 'ACAD14863', '8edd8582af770c9edf668bd427f3b66d', 'student_img.png', 'testingpurpss@gmail.com', '1234567890', '', '0000-00-00', '', '', '', '15', 0, '2021-09-21', 1, 0, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 14:31:41'),
(50, 1, 'test', 'ACAD14984', 'dabc88381a70f4cb03e2ae9ca1d3939e', 'student_img.png', 'test@gmail.com', '9876543210', '', '0000-00-00', '', '', '', '20', 0, '2021-09-21', 1, 1, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 14:39:57'),
(60, 1, 'test name', 'ACAD15083', 'e55844906f852bb348f52b502fe5fbc6', 'student_img.png', 'testEmail@gmail.com', '1478527894', '', '0000-00-00', '', '', '', '15', 1, '2021-09-21', 1, 0, '', 'test', '', 'student', '2021-09-21 16:26:37'),
(61, 1, 'test name', 'ACAD16049', 'e634f68d369e2701c92985623de5848a', 'student_img.png', 'testEmaissl@gmail.com', '1478527892', '', '0000-00-00', '', '', '', '0', 1, '2021-09-21', 1, 0, '', 'test', '', 'student', '2021-09-21 16:27:08'),
(62, 1, 'testing123', 'ACAD16170', '27ec86b615567db7592e33435023b9f4', 'student_img.png', 'testing123@gmail.comm', '9876543219', '', '0000-00-00', '', '', '', '17', 0, '2021-09-21', 1, 1, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 16:32:04'),
(63, 1, 'saloni', 'ACAD16281', 'b1ff7440b47f15607b09067c6574938a', 'student_img.png', 'salonisaloni@gmail.com', '9876543210', '', '0000-00-00', '', '', '', '17', 0, '2021-09-21', 1, 1, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', '10', 'student', '2021-09-21 16:32:50'),
(64, 1, 'testtt', 'ACAD16318', '2d815f8b8857543f9fbcbe934f64cac2', 'student_img.png', 'testtt@gmail.com', '987654321', '', '0000-00-00', '', '', '', '19', 0, '2021-09-21', 1, 1, '', 'fblY9xENQKC7_LzcqNDSG3:APA91bH8rKF8fo_mXAS8qL0ajo1X0dfQz4WENDewK9slmxkskruWbUqBTyrlAu792rp65-JhTOphQa7m511T9ckgO-PZTA5r18FzV0pX0BpNpA2jjxrGkZnbnXXoQe8AVSGS5Pi3IOk_', 'null', 'student', '2021-09-21 16:34:05'),
(65, 1, 'estiben', 'ACAD16466', '6a9ac9f80d24a5154843938ed7d7bde1', 'student_img.png', 'estiben.yosgart@acelap.com', '8319991921', '', '0000-00-00', '', '', '', '5', 0, '2021-09-22', 1, 1, '', 'cKnWeMaYQTm1geUqLw-360:APA91bFjYv8_iy_eBasM3ltSj6wHtJZbVazMnNc3Dh6SyejyG05qwgjnwYPOt4nOmvRxmXVWnoW27jyKkmUNIx43g_DRWBvUu2SxEaNIFyQLB_xrs4TgDuvk7UqT9IW1srCQ_2XhiKpW', '10', 'student', '2021-09-22 16:03:57'),
(66, 1, 'anonymous', 'ACAD16519', '02cc55a7895136a538c2606b69469081', 'student_img.png', 'zsb07161@zwoho.com', '8319991921', '', '0000-00-00', '', '', '', '0', 0, '2021-09-22', 1, 0, '', 'cKnWeMaYQTm1geUqLw-360:APA91bFjYv8_iy_eBasM3ltSj6wHtJZbVazMnNc3Dh6SyejyG05qwgjnwYPOt4nOmvRxmXVWnoW27jyKkmUNIx43g_DRWBvUu2SxEaNIFyQLB_xrs4TgDuvk7UqT9IW1srCQ_2XhiKpW', 'null', 'student', '2021-09-22 15:55:34'),
(67, 1, 'dfgh', 'ACAD16692', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'dfgh@mailinator.com', '123654987', 'female', '2021-09-01', '', '', 'dfg', '18', 0, '2021-09-23', 1, 0, '', 'd-PrK9dnQi-drFeld3gBEe:APA91bFzto3_6eul6X9n-SPkQiHjkZ6L6VXDOotMQ9-iCXCEKohzHxxHcSUuSl_-M5QJEOkim5lZ8pL3jiwH73IyF0cVbUpimvfByx2wbY6MbsqMScExPJHfvNloB6zh6yrODnEFpjAp', '10', '', '2021-09-24 16:23:09'),
(68, 1, 'test', 'ACAD16743', '', 'student_img.png', 'yopimo7747@secbuf.com', '', '', '0000-00-00', '', '', '', '22', 0, '2021-09-23', 1, 0, '0Lc64moIp1', '1', '', 'student', '2021-09-23 18:18:01'),
(69, 1, 'student_leave.php', 'ACAD16815', '', 'student_img.png', 'tonajiv935@secbuf.com', '', '', '0000-00-00', '', '', '', '22', 0, '2021-09-23', 1, 0, 'EgRrz5G4o7', '1', '', 'student', '2021-09-23 18:34:30'),
(70, 1, 'student_leave.php', 'ACAD16982', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'totis95102@secbuf.com', '', '', '0000-00-00', '', '', '', '18', 0, '2021-09-23', 1, 1, 'KMsPJWy0Ia', '1', '10', 'student', '2021-09-24 16:48:18'),
(71, 1, 'Hello', 'ACAD17081', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'wokipey364@soulsuns.com', '1234567890', '', '0000-00-00', '', '', '', '0', 0, '2021-09-23', 1, 0, 'K30ykRDGMX', '1', '', 'student', '2021-09-23 18:57:41'),
(72, 1, 'hello', 'ACAD17126', '1be3c365e902cc93c25a3fcdacb4b736', 'student_img.png', 'misefa6841@secbuf.com', '', '', '0000-00-00', '', '', '', '21', 0, '2021-09-23', 1, 0, 'fxsWhtDbKn', '1', '', 'student', '2021-09-23 19:00:10'),
(73, 1, 'Testing', 'ACAD17218', 'b0e0a3eefd126b1ca0c6cd9882580c65', 'download_(2)_210924114151.jpg', 'lemicec212@secbuf.com', '1234567890', 'male', '2021-09-10', 'fghgj', 'yui', 'asdfdhg', '19', 0, '2021-09-24', 1, 0, '', '', '', '', '0000-00-00 00:00:00'),
(74, 1, 'Hello', 'ACAD17394', '831a120b5c31e0a1516084c40b4d2af1', 'download_(2)_210924115608.jpg', 'resftsdgfh@gmail.com', '1234567890', 'male', '2021-09-02', 'dgfhgj', 'jfj', 'tfhyuiyu', '14', 0, '2021-09-24', 1, 0, '', '', '', '', '0000-00-00 00:00:00'),
(77, 1, 'gtg', 'ACAD17412', '94eb5351c40066f74ba12aac822194a2', 'images_210924124137.jpg', 'kjhjkjhk@gmail.com', '1234567890', 'male', '2021-09-09', 'fghjhgjhg', 'hjkh', 'hgjkhdjfsfds', '0', 0, '2021-09-24', 1, 0, '', '', '', '', '0000-00-00 00:00:00'),
(78, 1, 'tfrxhyfghfj', 'ACAD17795', '9add4f685191e229e13a46b84f69e18f', 'images_210924124422.jpg', 'oisfiusfi@gmail.com', '1234567890', 'female', '2021-09-01', 'gfjk', 'khkjhkhj', '3wrerjr t r tytrytuyi', '[\"19\"]', 0, '2021-09-24', 1, 0, '', '', '', '', '0000-00-00 00:00:00'),
(80, 1, 'CVC', 'ACAD17945', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'cvc@mailinator.com', '456321987', 'female', '2021-06-08', '', '', '', '[\"21\",\"20\",\"19\",\"18\",\"9\"]', 0, '2021-09-25', 1, 0, 'l2ukAMnrSW', '1', '', '', '0000-00-00 00:00:00'),
(79, 1, 'JUST', 'ACAD17875', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'just@mailinator.com', '123456789', 'male', '2021-10-12', 'FAST', 'must', 'hno-4\r\nghar', '21', 1, '2021-09-24', 1, 0, '', 'cJVuiptRTg6DNg4V0xyF8F:APA91bFoonjduCBEQMC5K2RQv5wv5ZeHsk1SuOYsAxXNcWlOI8swgUPvYH7tzB0sG3L7FBV6EdaTOUpxzESSfak6JXtUssXp84OjZdy0aygfXkaZrEFX91RDBiiicKLRPBEc1H-Wd3d5', '10', '', '2021-09-24 16:28:21'),
(84, 1, 'jess', 'ACAD18357', '9133640f01bd389f3f3aa33a22c1930a', 'student_img.png', 'njl25457@cuoly.com', '', '', '0000-00-00', '', '', '', '18', 0, '2021-09-29', 1, 0, 'ufTgR5h7vm', '1', '', 'student', '2021-09-29 15:03:59'),
(81, 1, 'aj', 'ACAD18035', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'aj@gmail.com', '1234567890', 'male', '1970-01-01', 'huyiuoi', 'iopio[p', '', '[\"19\",\"18\"]', 0, '2021-09-25', 1, 0, 'pXLyVU4YJZ', '1', 'null', 'student', '2021-09-25 16:41:10'),
(85, 1, 'astha', 'ACAD18497', '202cb962ac59075b964b07152d234b70', '1632912383638.jpg', 'astha.sharma@pixelnx.com', '1111111111111', '', '0000-00-00', '', '', '', '10', 0, '2021-09-29', 1, 0, '', 'cKnWeMaYQTm1geUqLw-360:APA91bG5lharLqAx9RGfsYV2RG0kBt3Bq2KS4aVo_ndgLoShUnXbV7fOvwrIW8FcVGHEX6iBcLUq91dOw62onq7cKNqDBt5hvy0BXLSd8dBZspin9mwhLUr7WW3TtS4cyrE0uEqoFUDD', '10', 'student', '2021-09-29 17:06:00'),
(83, 1, 'randheer', 'ACAD18250', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'aksel.mattox@acelap.com', '9826098260', 'male', '2004-09-02', 'ran', 'non', 'victoria', '19', 0, '2021-09-28', 1, 0, 'mlF3zQLqKj', '1', '10', '', '2021-09-28 17:19:01'),
(89, 1, 'heat', 'ACAD18885', '6fdfbe6a2118128abbdb8f32e25d7092', 'student_img.png', 'heat@mailinator.com', '123654987', 'male', '2021-08-02', '', '', '', '[\"21\",\"20\"]', 0, '2021-10-02', 1, 0, '', '', '', '', '0000-00-00 00:00:00'),
(86, 1, 'test', 'ACAD18584', 'ad505be3faa7cba244a75ac12227650c', 'student_img.png', 'test@gmail.com', '1234567890', '', '0000-00-00', '', '', '', '', 1, '2021-09-29', 1, 0, '', 'eHvBfhcTSeu913e8f-MyrS:APA91bH8kwp6_BQ2xrmOXdhdXhjxWZ78H2zevzaYkLykvEoozwH5my34tj9UmeoJzV-4hGDHk-iHw_IoaAQBDHx99N5UeN8pwAVR-jRfL8Q6-uWWzfwsbqwgUdNhm9at4TjRMZ5Gxtsf', 'null', 'student', '2021-09-29 16:38:33'),
(87, 1, 'test', 'ACAD18624', '202cb962ac59075b964b07152d234b70', 'student_img.png', 'test1@gmail.com', '1234567890', '', '0000-00-00', '', '', '', '10', 0, '2021-09-29', 1, 0, 'eGNWTxtgAY', '1', '10', 'student', '2021-09-29 17:41:19'),
(88, 1, 'mouser', 'ACAD18798', '35d1df3efa70bec2d53f990eebf3a7e7', 'student_img.png', 'oluwadarasimi.moo@acelap.com', '9826098260', '', '0000-00-00', '', '', '', '5', 1, '2021-10-02', 1, 1, 'eOypYmBV4K', '1', '', 'student', '2021-10-02 14:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `student_doubts_class`
--

DROP TABLE IF EXISTS `student_doubts_class`;
CREATE TABLE IF NOT EXISTS `student_doubts_class` (
  `doubt_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subjects_id` varchar(100) NOT NULL,
  `chapters_id` varchar(500) NOT NULL,
  `users_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0 = pending, 1 = approve, 2 = decline',
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`doubt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_payment_history`
--

DROP TABLE IF EXISTS `student_payment_history`;
CREATE TABLE IF NOT EXISTS `student_payment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `transaction_id` longtext NOT NULL,
  `mode` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_payment_history`
--

INSERT INTO `student_payment_history` (`id`, `student_id`, `batch_id`, `transaction_id`, `mode`, `amount`, `create_at`) VALUES
(26, 42, 5, '', '', 0, '2021-09-20 17:56:58'),
(27, 43, 5, 'pay_HzigxhuCFxuPZU', '', 50, '2021-09-20 18:00:06'),
(28, 15, 20, 'pay_HziwhL0ACvHqII', '', 3000, '2021-09-20 18:15:00'),
(29, 15, 17, 'pay_HzixIDI5q3bKJX', '', 300, '2021-09-20 18:15:34'),
(30, 35, 19, '19', 'Razorpay', 500, '2021-09-20 18:16:33'),
(31, 0, 5, 'pay_Hziz2JRbwsFtF3', '', 50, '2021-09-20 18:17:12'),
(32, 0, 17, 'pay_I01EgKRzBBuW81', '', 300, '2021-09-21 12:08:32'),
(33, 0, 5, 'pay_I01VsDQqI4bVtR', '', 50, '2021-09-21 12:24:49'),
(34, 45, 17, 'pay_I01fIbdX3wBvRd', '', 300, '2021-09-21 12:33:44'),
(35, 0, 20, 'pay_I01kQpbnnqawRv', '', 3000, '2021-09-21 12:38:36'),
(36, 45, 20, 'pay_I01lOaeVGMqcrg', '', 3000, '2021-09-21 12:39:31'),
(37, 0, 16, 'pay_I023SlgiCnYkko', '', 500, '2021-09-21 12:56:37'),
(38, 45, 16, 'pay_I02DflRLLZU6cN', '', 500, '2021-09-21 13:06:17'),
(39, 45, 19, 'pay_I030RwoD7Nk0Vu', '', 500, '2021-09-21 13:52:31'),
(40, 50, 20, 'pay_I03odjrQpBYLm6', '', 3000, '2021-09-21 14:39:57'),
(41, 62, 17, 'pay_I05j572BpwT4So', '', 300, '2021-09-21 16:32:04'),
(42, 63, 17, 'pay_I05kKHsCUlERWr', '', 300, '2021-09-21 16:33:15'),
(43, 64, 19, 'pay_I05ldJ0v3OeKJG', '', 500, '2021-09-21 16:35:03'),
(44, 65, 5, 'pay_I0PeSqwkXVbnid', '', 50, '2021-09-22 12:01:47'),
(45, 65, 17, 'pay_I0Q99ZzcgTQdYQ', '', 300, '2021-09-22 12:30:47'),
(46, 70, 20, '20', 'Razorpay', 3000, '2021-09-23 18:41:54'),
(47, 88, 5, 'pay_I4PcKSBIx3nMV0', 'Razorpay', 50, '2021-10-02 14:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `no_of_questions` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `status`, `no_of_questions`, `admin_id`) VALUES
(1, 'Maths', 1, 19, 1),
(2, 'Physics', 1, 0, 1),
(3, 'Chemistry', 1, 1, 1),
(7, 'English', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sudent_batchs`
--

DROP TABLE IF EXISTS `sudent_batchs`;
CREATE TABLE IF NOT EXISTS `sudent_batchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sudent_batchs`
--

INSERT INTO `sudent_batchs` (`id`, `student_id`, `batch_id`, `status`, `create_at`, `added_by`) VALUES
(48, 35, 17, 0, '2021-09-20 11:37:01', 'student'),
(49, 42, 5, 0, '2021-09-20 17:56:58', 'student'),
(50, 43, 5, 0, '2021-09-20 18:00:06', 'student'),
(51, 43, 15, 0, '2021-09-20 18:00:53', 'student'),
(52, 15, 20, 0, '2021-09-20 18:15:00', 'student'),
(53, 15, 17, 0, '2021-09-20 18:15:34', 'student'),
(54, 35, 19, 0, '2021-09-20 18:16:33', 'student'),
(56, 35, 18, 0, '2021-09-20 18:19:09', 'student'),
(57, 35, 13, 0, '2021-09-20 18:30:24', 'student'),
(61, 45, 17, 0, '2021-09-21 12:33:44', 'student'),
(63, 45, 20, 0, '2021-09-21 12:39:31', 'student'),
(65, 45, 16, 0, '2021-09-21 13:06:17', 'student'),
(66, 45, 19, 0, '2021-09-21 13:52:31', 'student'),
(67, 45, 13, 0, '2021-09-21 13:53:01', 'student'),
(68, 15, 15, 0, '2021-09-21 14:16:54', 'student'),
(69, 15, 14, 0, '2021-09-21 14:17:11', 'student'),
(70, 15, 12, 0, '2021-09-21 14:17:46', 'student'),
(71, 60, 15, 0, '2021-09-21 16:26:37', 'student'),
(72, 62, 17, 0, '2021-09-21 16:32:04', 'student'),
(73, 63, 10, 0, '2021-09-21 16:32:50', 'student'),
(74, 63, 17, 0, '2021-09-21 16:33:15', 'student'),
(75, 64, 19, 0, '2021-09-21 16:35:03', 'student'),
(76, 65, 5, 0, '2021-09-22 12:01:47', 'student'),
(77, 65, 18, 0, '2021-09-22 12:10:47', 'student'),
(78, 65, 17, 0, '2021-09-22 12:30:47', 'student'),
(80, 68, 22, 0, '2021-09-23 18:18:01', 'student'),
(81, 69, 22, 0, '2021-09-23 18:34:30', 'student'),
(82, 70, 22, 0, '2021-09-23 18:39:24', 'student'),
(83, 70, 20, 0, '2021-09-23 18:41:54', 'student'),
(84, 70, 18, 0, '2021-09-23 18:43:11', 'student'),
(85, 72, 22, 0, '2021-09-23 18:59:29', 'student'),
(86, 72, 21, 0, '2021-09-23 19:00:10', 'student'),
(87, 74, 14, 0, '2021-09-24 11:56:08', ''),
(88, 67, 10, 0, '2021-09-24 12:07:56', 'student'),
(89, 67, 18, 0, '2021-09-24 12:09:17', 'student'),
(90, 75, 14, 0, '2021-09-24 12:23:01', 'Admin'),
(91, 76, 19, 0, '2021-09-24 12:26:07', 'Admin'),
(92, 76, 14, 0, '2021-09-24 12:26:07', 'Admin'),
(93, 77, 19, 0, '2021-09-24 12:41:37', 'Admin'),
(94, 77, 14, 0, '2021-09-24 12:41:37', 'Admin'),
(97, 1, 14, 0, '2021-09-24 13:03:16', 'Admin'),
(98, 1, 13, 0, '2021-09-24 13:03:16', 'Admin'),
(99, 1, 12, 0, '2021-09-24 13:03:16', 'Admin'),
(100, 1, 10, 0, '2021-09-24 13:03:16', 'Admin'),
(112, 78, 19, 0, '2021-09-24 16:27:34', 'Admin'),
(113, 79, 21, 0, '2021-09-24 16:27:47', 'Admin'),
(125, 80, 21, 0, '2021-09-27 14:53:43', 'Admin'),
(126, 80, 20, 0, '2021-09-27 14:53:43', 'Admin'),
(127, 80, 19, 0, '2021-09-27 14:53:43', 'Admin'),
(128, 80, 18, 0, '2021-09-27 14:53:43', 'Admin'),
(129, 80, 9, 0, '2021-09-27 14:53:43', 'Admin'),
(130, 82, 19, 0, '2021-09-28 17:06:51', 'Admin'),
(131, 82, 18, 0, '2021-09-28 17:06:51', 'Admin'),
(132, 82, 14, 0, '2021-09-28 17:06:52', 'Admin'),
(133, 82, 12, 0, '2021-09-28 17:06:52', 'Admin'),
(134, 83, 19, 0, '2021-09-28 17:15:40', 'Admin'),
(135, 83, 18, 0, '2021-09-28 17:15:40', 'Admin'),
(136, 83, 14, 0, '2021-09-28 17:15:40', 'Admin'),
(141, 81, 19, 0, '2021-09-29 10:45:50', 'Admin'),
(142, 81, 18, 0, '2021-09-29 10:45:50', 'Admin'),
(143, 84, 18, 0, '2021-09-29 15:03:59', 'student'),
(144, 85, 18, 0, '2021-09-29 15:32:30', 'student'),
(145, 85, 15, 0, '2021-09-29 15:52:34', 'student'),
(146, 85, 10, 0, '2021-09-29 15:53:46', 'student'),
(147, 15, 18, 0, '2021-09-29 16:02:35', 'student'),
(148, 85, 22, 0, '2021-09-29 16:30:15', 'student'),
(149, 87, 18, 0, '2021-09-29 16:43:13', 'student'),
(150, 87, 10, 0, '2021-09-29 16:59:26', 'student'),
(152, 13, 20, 0, '2021-10-01 12:55:25', 'Admin'),
(153, 13, 19, 0, '2021-10-01 12:55:25', 'Admin'),
(154, 13, 10, 0, '2021-10-01 12:55:25', 'Admin'),
(155, 13, 9, 0, '2021-10-01 12:55:25', 'Admin'),
(156, 13, 8, 0, '2021-10-01 12:55:25', 'Admin'),
(157, 13, 5, 0, '2021-10-01 12:55:25', 'Admin'),
(158, 88, 5, 0, '2021-10-02 14:35:34', 'student'),
(159, 13, 18, 0, '2021-10-02 15:14:26', 'student'),
(160, 89, 21, 0, '2021-10-02 18:03:50', 'Admin'),
(161, 89, 20, 0, '2021-10-02 18:03:50', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

DROP TABLE IF EXISTS `temp_data`;
CREATE TABLE IF NOT EXISTS `temp_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_data`
--

INSERT INTO `temp_data` (`id`, `temp`) VALUES
(26, '{\"batch_id\":\"10\",\"student_id\":\"85\"}'),
(27, '{\"batch_id\":\"10\",\"student_id\":\"85\"}'),
(28, '{\"student_id\":\"85\"}'),
(29, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(30, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(31, '{\"search\":\"\",\"start\":\"2\",\"length\":\"7\",\"limit\":\"3\"}'),
(32, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(33, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(34, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(35, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(36, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(37, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(38, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(39, '{\"search\":\"\",\"start\":\"2\",\"length\":\"7\",\"limit\":\"3\"}'),
(40, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(41, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(42, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(43, '{\"search\":\"\",\"start\":\"2\",\"length\":\"7\",\"limit\":\"3\"}'),
(44, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(45, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(46, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(47, '{\"student_id\":\"85\"}'),
(48, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(49, '{\"student_id\":\"85\"}'),
(50, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(51, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(52, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(53, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(54, '{\"student_id\":\"85\"}'),
(55, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(56, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(57, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(58, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(59, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(60, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(61, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(62, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(63, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(64, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(65, '{\"student_id\":\"85\"}'),
(66, '{\"student_id\":\"85\"}'),
(67, '{\"batch_id\":\"10\",\"student_id\":\"85\"}'),
(68, '{\"student_id\":\"85\"}'),
(69, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(70, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(71, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(72, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(73, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(74, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(75, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(76, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(77, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(78, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(79, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(80, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(81, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(82, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(83, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(84, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(85, '{\"student_id\":\"85\"}'),
(86, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(87, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(88, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(89, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(90, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(91, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(92, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(93, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(94, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(95, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(96, '{\"student_id\":\"85\"}'),
(97, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(98, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(99, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(100, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(101, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(102, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(103, '{\"subcat\":\"\'0\'\",\"start\":\"0\"}'),
(104, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(105, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(106, '[]'),
(107, '{\"start\":\"0\"}'),
(108, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(109, '{\"student_id\":\"85\"}'),
(110, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(111, '{\"search\":\"\",\"start\":\"2\",\"length\":\"6\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(112, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(113, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(114, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(115, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(116, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(117, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(118, '{\"student_id\":\"85\"}'),
(119, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(120, '{\"student_id\":\"85\"}'),
(121, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(122, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(123, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(124, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(125, '{\"student_id\":\"85\"}'),
(126, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(127, '{\"student_id\":\"85\"}'),
(128, '{\"start\":\"0\"}'),
(129, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(130, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(131, '{\"student_id\":\"85\"}'),
(132, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(133, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(134, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(135, '{\"student_id\":\"85\"}'),
(136, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(137, '{\"student_id\":\"85\"}'),
(138, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(139, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(140, '{\"student_id\":\"85\"}'),
(141, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(142, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(143, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(144, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(145, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(146, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(147, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(148, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(149, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(150, '{\"student_id\":\"85\"}'),
(151, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(152, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(153, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(154, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(155, '{\"student_id\":\"85\"}'),
(156, '{\"student_id\":\"85\"}'),
(157, '{\"student_id\":\"85\"}'),
(158, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"85\"}'),
(159, '{\"student_id\":\"85\"}'),
(160, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(161, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(162, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(163, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(164, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(165, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(166, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(167, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(168, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(169, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"15\"}'),
(170, '{\"student_id\":\"15\"}'),
(171, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"15\"}'),
(172, '{\"batch_id\":\"9\",\"student_id\":\"15\"}'),
(173, '{\"student_id\":\"15\"}'),
(174, '{\"batch_id\":\"9\",\"student_id\":\"15\"}'),
(175, '{\"student_id\":\"15\"}'),
(176, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"15\"}'),
(177, '{\"student_id\":\"15\"}'),
(178, '{\"search\":\"\",\"start\":\"3\",\"length\":\"7\",\"limit\":\"3\",\"student_id\":\"15\"}'),
(179, '{\"batch_id\":\"9\",\"student_id\":\"15\"}'),
(180, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(181, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(182, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(183, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(184, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(185, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\"}'),
(186, '{\"search\":\"\",\"start\":\"3\",\"length\":\"8\",\"limit\":\"3\"}'),
(187, '{\"search\":\"\",\"start\":\"0\",\"length\":\"3\",\"limit\":\"3\",\"student_id\":\"15\"}'),
(188, '{\"student_id\":\"15\"}');

-- --------------------------------------------------------

--
-- Table structure for table `term_condition_data`
--

DROP TABLE IF EXISTS `term_condition_data`;
CREATE TABLE IF NOT EXISTS `term_condition_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term_condition_data`
--

INSERT INTO `term_condition_data` (`id`, `description`) VALUES
(1, '&lt;p&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Suspendisse consectetur metus tellus, nec efficitur metus lobortis in. Fusce dapibus lacus sed sapien tincidunt dictum. Aliquam quis&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Suspendisse consectetur metus tellus, nec efficitur metus lobortis in. Fusce dapibus lacus sed sapien tincidunt dictum. Aliquam quis&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Suspendisse consectetur metus tellus, nec efficitur metus lobortis in. Fusce dapibus lacus sed sapien tincidunt dictum. Aliquam quisdsfdgf&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1 - admin, 3 - teacher',
  `teach_education` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teach_image` varchar(255) NOT NULL,
  `teach_batch` varchar(255) NOT NULL,
  `teach_subject` varchar(255) NOT NULL,
  `teach_gender` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `token` text NOT NULL,
  `brewers_check` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `teach_education`, `teach_image`, `teach_batch`, `teach_subject`, `teach_gender`, `parent_id`, `status`, `token`, `brewers_check`) VALUES
(1, 'admin', 'admin@eacademy.com', '202cb962ac59075b964b07152d234b70', 1, '', '', '', '', '', 0, 1, '1', '7h8KARiqx9'),
(11, 'John', 'jimmy@eacademy.com', '202cb962ac59075b964b07152d234b70', 3, 'Computer Science', 'white_hat_hacker.jpg', '10,12,14,18,19,20,21,22,15', '[\"13\",\"12\",\"11\"]', 'male', 1, 1, '1', 'WyHjqDebAK'),
(9, 'Diana', 'diana@eacademy.com', '202cb962ac59075b964b07152d234b70', 3, 'MSc.', 'teaching-website1.jpeg', '9', '[\"4\",\"3\"]', 'female', 1, 1, '1', 'NKJDseEYdt'),
(10, 'Maria', 'maria@eacademy.com', '202cb962ac59075b964b07152d234b70', 3, 'M.A.', 'teenager-1887364_960_7203.jpg', '10', '[\"9\",\"8\",\"7\"]', 'female', 1, 1, '1', 'grxHFe3OUW'),
(8, 'jon', 'jon@eacademy.com', '202cb962ac59075b964b07152d234b70', 3, 'MSc', 'Entrevista-El-Pais-Carlos-Torres-BBVA-home-e1523695441593-1920x950.jpg', '5,8,10,15,16,17', '[\"2\",\"1\"]', 'male', 1, 1, '1', 'mpKG2qlLH6');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `last_date` date NOT NULL,
  `mode` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `title`, `description`, `start_date`, `last_date`, `mode`, `files`, `status`, `admin_id`, `added_at`) VALUES
(1, 'Math olympiad', 'ltrices eu tempus mattis, tempor sit amet velit. Suspendisse a mi tempus, scelerisque mi nec, dapibus neque. In hac habitasse platea dictumst. Curabitur efficitur suscipit nisi quis tincidunt. Donec vulputate sollicitudin lorem, eget rutrum velit eleifend quis. Vivamus feugiat nibh metus, in rutrum mauris bibendum sed. Nunc ex nibh, rhoncus vel hendrerit non, euismod vitae risus. Phasellus dictum ipsum nec orci malesuada, sit amet egestas tortor tincidunt.', '2021-08-25', '2021-08-31', 'Offline', '[\"1200px-IMO_logo_svg1.png\"]', 1, 1, '2021-08-18 18:22:53'),
(2, 'Testing', 'dfg fd fgdjf djfd ff', '2021-08-19', '2021-08-24', 'Offline', '[\"sample.pdf\"]', 1, 1, '2021-08-19 14:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `video_lectures`
--

DROP TABLE IF EXISTS `video_lectures`;
CREATE TABLE IF NOT EXISTS `video_lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `url` varchar(255) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `preview_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_lectures`
--

INSERT INTO `video_lectures` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `description`, `url`, `video_type`, `preview_type`, `status`, `added_by`, `added_at`) VALUES
(3, 1, 'Probability problem simplified', '[\"5\"]', 'Probability', 'Maths', 'Probability problem simplified this will help you to simplify ', 'https://www.youtube.com/embed/UORztmWGY6Q', 'youtube', 'preview', 1, 1, '2021-08-25 14:55:02'),
(4, 1, 'Conditional Probability', '[\"5\"]', 'Probability', 'Maths', 'This will teach you about conditional probability ', 'https://www.youtube.com/embed/sqDVrXq_eh0', 'youtube', 'preview', 1, 1, '2021-08-25 15:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `views_notification_student`
--

DROP TABLE IF EXISTS `views_notification_student`;
CREATE TABLE IF NOT EXISTS `views_notification_student` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `notice_type` varchar(100) NOT NULL,
  `views_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `views_notification_student`
--

INSERT INTO `views_notification_student` (`n_id`, `student_id`, `notice_type`, `views_time`) VALUES
(1, 16, 'book_notes_paper', '2021-09-02 11:53:07'),
(2, 16, 'extraClass', '2021-09-02 11:53:30'),
(3, 16, 'homeWork', '2021-09-02 11:53:37'),
(4, 16, 'videoLecture', '2021-09-02 15:45:40'),
(5, 15, 'mockPaper', '2021-09-02 04:45:17'),
(6, 15, 'book_notes_paper', '2021-09-29 17:07:33'),
(7, 16, 'practicePaper', '2021-09-04 12:02:22'),
(8, 15, 'videoLecture', '2021-09-21 15:38:50'),
(9, 15, 'extraClass', '2021-09-04 18:27:52'),
(10, 27, 'notices', '2021-09-15 18:30:35'),
(11, 65, 'notices', '2021-09-22 18:43:10'),
(12, 65, 'practicePaper', '2021-09-22 06:44:19'),
(13, 65, 'vacancy', '2021-09-22 15:33:37'),
(14, 65, 'videoLecture', '2021-09-22 18:43:06'),
(15, 65, 'homeWork', '2021-09-22 18:43:52'),
(16, 65, 'extraClass', '2021-09-22 12:12:35'),
(17, 65, 'book_notes_paper', '2021-09-22 12:58:32'),
(18, 65, 'mockPaper', '2021-09-22 06:45:19'),
(19, 67, 'book_notes_paper', '2021-09-24 12:08:42'),
(20, 67, 'mockPaper', '2021-09-24 12:12:19'),
(21, 67, 'practicePaper', '2021-09-24 12:13:02'),
(22, 70, 'notices', '2021-09-24 16:58:30'),
(23, 85, 'notices', '2021-09-29 17:07:51'),
(24, 85, 'homeWork', '2021-09-29 17:08:16'),
(25, 85, 'practicePaper', '2021-10-01 05:44:15'),
(26, 85, 'mockPaper', '2021-10-01 05:52:11'),
(27, 85, 'vacancy', '2021-09-30 18:06:13'),
(28, 85, 'videoLecture', '2021-09-29 17:03:11'),
(29, 85, 'extraClass', '2021-09-29 17:08:35'),
(30, 85, 'book_notes_paper', '2021-09-29 17:09:36'),
(31, 87, 'book_notes_paper', '2021-09-29 17:12:46'),
(32, 15, 'homeWork', '2021-09-29 16:51:11'),
(33, 87, 'notices', '2021-09-29 17:21:34'),
(34, 87, 'mockPaper', '2021-09-29 05:42:47'),
(35, 87, 'extraClass', '2021-09-29 17:26:47'),
(36, 87, 'vacancy', '2021-09-29 18:06:32'),
(37, 87, 'practicePaper', '2021-09-29 05:59:20'),
(38, 87, 'videoLecture', '2021-09-29 17:13:18'),
(39, 15, 'practicePaper', '2021-09-29 05:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_api_credentials`
--

DROP TABLE IF EXISTS `zoom_api_credentials`;
CREATE TABLE IF NOT EXISTS `zoom_api_credentials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `android_api_key` varchar(250) NOT NULL,
  `android_api_secret` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zoom_api_credentials`
--

INSERT INTO `zoom_api_credentials` (`id`, `android_api_key`, `android_api_secret`) VALUES
(1, 'CpVBurIP1Qw9w8wJ9vfXDO08ohbLTxA1cWTX', 'OfOROAaUckcPviaGYhRj0Kf2MS94k003Y4Yr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
