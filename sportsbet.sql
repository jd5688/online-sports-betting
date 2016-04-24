-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2014 at 08:10 AM
-- Server version: 5.6.15
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sportsbet`
--

-- --------------------------------------------------------

--
-- Table structure for table `bet_item`
--

CREATE TABLE IF NOT EXISTS `bet_item` (
  `bi_id` int(10) NOT NULL AUTO_INCREMENT,
  `bi_game_id` int(10) NOT NULL,
  `bi_description` varchar(255) NOT NULL,
  `bi_description_jp` varchar(255) NOT NULL,
  `bi_winner` int(1) NOT NULL,
  PRIMARY KEY (`bi_id`),
  KEY `bi_game_id` (`bi_game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=450 ;

--
-- Table structure for table `coinpackage`
--

CREATE TABLE IF NOT EXISTS `coinpackage` (
  `cpid` int(5) NOT NULL AUTO_INCREMENT,
  `cpcoin` varchar(10) NOT NULL,
  `cpamount` varchar(10) NOT NULL COMMENT 'in USD',
  `cpenabled` int(1) NOT NULL COMMENT '0-disable,1-enabled',
  PRIMARY KEY (`cpid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;


--
-- Table structure for table `coin_deals`
--

CREATE TABLE IF NOT EXISTS `coin_deals` (
  `cd_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  `cd_amount` varchar(25) NOT NULL,
  `cd_inout` enum('in','out') NOT NULL,
  `tx_id` varchar(50) NOT NULL,
  `cd_type` enum('bet','bet return','bet winning','transfer','house com') NOT NULL,
  `cd_tx_date` varchar(25) NOT NULL,
  PRIMARY KEY (`cd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `cf_name` varchar(150) NOT NULL,
  `cf_value` varchar(150) NOT NULL,
  KEY `cf_name` (`cf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `c_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_keyword` varchar(100) NOT NULL,
  `c_coins` int(5) NOT NULL,
  `c_isWelcome` int(1) NOT NULL COMMENT 'upon registration',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `g_id` int(10) NOT NULL AUTO_INCREMENT,
  `g_title` varchar(255) NOT NULL,
  `g_title_jp` varchar(255) NOT NULL DEFAULT '',
  `g_description` text NOT NULL,
  `g_description_jp` text NOT NULL,
  `g_image` varchar(100) NOT NULL,
  `g_categories` varchar(100) NOT NULL,
  `g_categories_jp` varchar(100) NOT NULL DEFAULT '',
  `g_tags` text NOT NULL,
  `g_tags_jp` text NOT NULL,
  `g_betInfo` text NOT NULL,
  `g_betInfo_jp` text NOT NULL,
  `g_addInfo` text NOT NULL,
  `g_addInfo_jp` text NOT NULL,
  `g_schedFrom` varchar(50) NOT NULL,
  `g_schedTo` varchar(50) NOT NULL,
  `g_timezone` varchar(75) NOT NULL DEFAULT 'Asia/Tokyo',
  `g_coinPerBet` int(5) NOT NULL COMMENT 'min coins per bet',
  `g_houseCom` int(5) NOT NULL COMMENT 'house commission',
  `g_publishType` enum('draft','private','public') NOT NULL,
  `g_isRecommend` int(1) NOT NULL,
  `g_isTrial` int(1) NOT NULL,
  `g_japPage` int(1) NOT NULL,
  `g_engPage` int(1) NOT NULL,
  `g_betMinimum` int(2) NOT NULL COMMENT 'min bets to establish game',
  `g_bookmarks` int(5) NOT NULL,
  `g_likes` int(5) NOT NULL,
  `g_isCancelled` int(1) NOT NULL,
  `g_isClosed` int(1) NOT NULL,
  `g_isDeleted` int(1) NOT NULL,
  `g_lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;


--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `lname` varchar(150) NOT NULL,
  `lvalue` varchar(150) NOT NULL,
  KEY `lname` (`lname`),
  KEY `lvalue` (`lvalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`lname`, `lvalue`) VALUES
('Japanese - 日本語', 'jp'),
('English', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `sports_category`
--

CREATE TABLE IF NOT EXISTS `sports_category` (
  `sc_id` int(5) NOT NULL AUTO_INCREMENT,
  `sc_name` varchar(150) NOT NULL,
  `sc_name_jp` varchar(200) NOT NULL,
  `sc_description` varchar(255) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Table structure for table `sports_tags`
--

CREATE TABLE IF NOT EXISTS `sports_tags` (
  `st_id` int(10) NOT NULL AUTO_INCREMENT,
  `st_name` varchar(150) NOT NULL,
  `st_lang` enum('jp','en') NOT NULL DEFAULT 'en',
  `st_description` varchar(255) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `tr_id` int(10) NOT NULL AUTO_INCREMENT,
  `tr_tx_id` varchar(50) NOT NULL DEFAULT '0',
  `tr_method` enum('cc','neteller') NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `tr_cc_nt_id` int(10) NOT NULL DEFAULT '0' COMMENT 'cc or neteller id',
  `bill_id` int(10) NOT NULL DEFAULT '0',
  `cpid` int(10) NOT NULL DEFAULT '0',
  `tr_gw_tx_id` int(10) NOT NULL DEFAULT '0' COMMENT 'gateway transaction id',
  `tr_amount` int(5) NOT NULL DEFAULT '0',
  `tr_currency` varchar(5) NOT NULL DEFAULT 'USD',
  `tr_coins` int(5) NOT NULL,
  `tr_date` varchar(30) NOT NULL DEFAULT '0',
  `tr_status` int(2) NOT NULL DEFAULT '0' COMMENT '0=fail, 1=success, 2=pending',
  PRIMARY KEY (`tr_id`),
  KEY `user_id` (`user_id`,`tr_cc_nt_id`),
  KEY `tx_id` (`tr_tx_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_fullname` varchar(200) NOT NULL DEFAULT '',
  `user_pic` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(200) NOT NULL,
  `user_coins` float NOT NULL DEFAULT '0',
  `user_betting` int(10) NOT NULL DEFAULT '0',
  `user_email` varchar(100) NOT NULL,
  `user_lastlogin` varchar(30) NOT NULL DEFAULT '',
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_isadmin` int(1) NOT NULL DEFAULT '0',
  `user_status` int(2) NOT NULL COMMENT '0-denied;1-approved;2-pending;3-highroller',
  `user_lang` varchar(5) NOT NULL,
  `user_timezone` varchar(150) NOT NULL DEFAULT 'Tokyo',
  `user_sex` enum('','male','female') NOT NULL,
  `user_bio` text NOT NULL,
  `user_website` varchar(150) NOT NULL DEFAULT '',
  `user_notify` enum('','all','won','cancelled') NOT NULL,
  `user_sendmail` varchar(100) NOT NULL DEFAULT '0' COMMENT '0 = disabled, >0 is category id',
  `user_remind` int(1) NOT NULL COMMENT 'remind user 30 mins b4 game ends',
  `user_gamedigest` int(3) NOT NULL COMMENT '0=disabled, 1=periodically,2=daily',
  `user_sitenews` int(1) NOT NULL COMMENT 'receive news and updates',
  `user_privacy_page` enum('all','following','none') NOT NULL,
  `user_privacy_result` enum('all','following','none') NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`,`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Table structure for table `users_billing_address`
--

CREATE TABLE IF NOT EXISTS `users_billing_address` (
  `bill_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `bill_fullname` varchar(250) NOT NULL,
  `bill_postal` varchar(50) NOT NULL,
  `bill_prefecture` varchar(100) NOT NULL,
  `bill_address1` varchar(250) NOT NULL,
  `bill_address2` varchar(250) NOT NULL,
  `bill_phone` varchar(50) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


--
-- Table structure for table `users_cc`
--

CREATE TABLE IF NOT EXISTS `users_cc` (
  `cc_id` int(6) NOT NULL AUTO_INCREMENT,
  `cc_select` enum('cc','neteller') NOT NULL,
  `cc_type` varchar(25) NOT NULL,
  `cc_number` varchar(50) NOT NULL,
  `cc_holder_name` varchar(150) NOT NULL,
  `cc_exp_mo` varchar(5) NOT NULL,
  `cc_exp_yr` varchar(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  `bill_id` int(5) NOT NULL,
  PRIMARY KEY (`cc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `ua_id` int(10) NOT NULL AUTO_INCREMENT,
  `ua_seen` int(1) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  `ua_fieldname` varchar(25) NOT NULL,
  `ua_fieldvalue` varchar(150) NOT NULL,
  `ua_activity` enum('like','unlike','withdraw','deposit','userfollow','bookmark','unbookmark','won','joinedgame','gamecancelled','changepass') NOT NULL,
  `ua_date` varchar(30) NOT NULL,
  PRIMARY KEY (`ua_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;


CREATE TABLE IF NOT EXISTS `user_bets` (
  `ub_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  `bi_id` int(10) NOT NULL,
  `ub_coins` int(5) NOT NULL,
  `ub_notify` int(1) NOT NULL,
  `cd_id` int(10) NOT NULL COMMENT 'coin_deals',
  `ub_iswinner` int(1) NOT NULL,
  PRIMARY KEY (`ub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;


--
-- Table structure for table `user_bookmarks`
--

CREATE TABLE IF NOT EXISTS `user_bookmarks` (
  `ub_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  PRIMARY KEY (`ub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;


--
-- Table structure for table `user_likes`
--

CREATE TABLE IF NOT EXISTS `user_likes` (
  `ul_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  PRIMARY KEY (`ul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
