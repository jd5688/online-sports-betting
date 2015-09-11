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
-- Dumping data for table `bet_item`
--

INSERT INTO `bet_item` (`bi_id`, `bi_game_id`, `bi_description`, `bi_description_jp`, `bi_winner`) VALUES
(422, 1, 'Miami Heat', 'Miami Heat', 0),
(426, 2, 'Wozniacki', 'ウォズニアッキ', 0),
(413, 3, 'Scoreless Draw', '引き分け', 0),
(13, 6, 'Mayweather', '', 1),
(12, 6, 'Pacquiao', '', 0),
(14, 7, 'Jones', '', 0),
(15, 7, 'Gustaffson', '', 0),
(382, 8, 'FC Barcelona', 'FCバルセロナ', 0),
(19, 9, 'Real Madrid', '', 0),
(20, 9, 'FC Barcelona', '', 0),
(21, 9, 'Both teams scoreless', '', 0),
(417, 10, 'Colombia', 'コロンビア', 0),
(416, 10, 'Brasil', 'ブラジル', 0),
(25, 11, 'Weidman', '', 0),
(26, 11, 'Machida', '', 0),
(407, 12, 'gfgfgfgf', 'PKでアルゼンチンが勝つ', 0),
(30, 13, 'Netherlands', '', 0),
(31, 13, 'Costa Rica', '', 0),
(32, 15, 'LA Lakers', '', 0),
(33, 15, 'Miami Heat', '', 0),
(34, 16, 'Sharapova', '', 0),
(35, 16, 'Wozniacki', '', 0),
(36, 17, 'Sharapova', '', 0),
(37, 17, 'Wozniacki', '', 0),
(302, 21, 'Both dead', '', 0),
(301, 21, 'Batman', '', 0),
(300, 21, 'Superman', '', 0),
(293, 20, 'Both dead', '', 0),
(292, 20, 'Batman', '', 0),
(291, 20, 'Superman', '', 1),
(281, 19, 'Both dead', '', 0),
(280, 19, 'Batman', '', 0),
(279, 19, 'Superman', '', 1),
(278, 18, 'Ewan', '', 0),
(277, 18, 'Sipa', '', 0),
(276, 18, 'Hulk', '', 0),
(275, 18, 'Neymar', '', 0),
(274, 18, 'Kagawa', '', 0),
(303, 22, 'Japan en', 'Japan jp', 0),
(304, 22, 'China en', 'China jp', 0),
(305, 22, 'both teams scoreless en', 'both teams scoreless jp', 0),
(309, 23, 'Evil EN', 'Evil JP', 0),
(308, 23, 'Good EN', 'Good JP', 0),
(314, 27, 'Good EN', 'Good JP', 0),
(315, 27, 'Evil EN', 'Evil JP', 0),
(395, 28, 'NO', 'スタメン出場しない', 0),
(394, 28, 'YES', 'スタメン出場する', 0),
(421, 1, 'LA Lakers', 'LA Lakers', 0),
(412, 3, 'Brazil', 'ブラジル', 0),
(411, 3, 'Japan', '日本', 0),
(404, 12, 'Both Teams Scoreless', '延長戦でドイツが勝つ', 0),
(405, 12, 'hjhjhdhg', '延長戦でアルゼンチンが勝つ', 0),
(406, 12, 'fgfsfg', 'PKでドイツが勝つ', 0),
(403, 12, 'Argentina', 'アルゼンチンが90分以内に勝つ', 0),
(402, 12, 'Germany', 'ドイツが90分以内に勝つ', 0),
(383, 8, 'Both teams scoreless', 'スコアレスドロー', 0),
(381, 8, 'Real Madrid', 'レアルマドリード', 0),
(418, 10, 'Both teams scoreless', '引き分け', 0),
(425, 2, 'Sharapova', 'シャラポワ', 0),
(427, 29, 'Gamba Osaka', 'ガンバ大阪', 0),
(428, 29, 'Yokohama F. Marinos', '横浜 F.マリノス', 0),
(429, 29, 'Draw', '引き分け', 0),
(434, 30, '', 'MLBオールスターチーム', 0),
(433, 30, '', '侍ジャパン', 0),
(435, 30, '', '引き分け', 0),
(449, 31, '', '引き分け', 0),
(447, 31, '', '侍ジャパン', 0),
(448, 31, '', 'MLBオールスターチーム', 0),
(445, 32, '', '錦織圭', 0),
(446, 32, '', 'R.フェデラー', 0);

-- --------------------------------------------------------

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
-- Dumping data for table `coinpackage`
--

INSERT INTO `coinpackage` (`cpid`, `cpcoin`, `cpamount`, `cpenabled`) VALUES
(1, '500', '50', 1),
(2, '1200', '100', 1),
(3, '3500', '300', 1),
(4, '6500', '500', 1),
(8, '7000', '550', 1),
(9, '8000', '600', 1),
(10, '9000', '700', 1),
(11, '10000', '800', 1);

-- --------------------------------------------------------

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
-- Dumping data for table `coin_deals`
--

INSERT INTO `coin_deals` (`cd_id`, `user_id`, `g_id`, `cd_amount`, `cd_inout`, `tx_id`, `cd_type`, `cd_tx_date`) VALUES
(1, 6, 0, '50', 'out', '0', 'bet', '1403433159'),
(2, 6, 0, '1000', 'in', '1', 'transfer', '1403433160'),
(3, 6, 0, '20', 'out', '0', 'bet', '1403435002'),
(4, 7, 0, '100', 'out', '0', 'bet', '1403504592'),
(5, 7, 0, '1000', 'in', '0', 'transfer', '1403504592'),
(6, 7, 0, '50', 'out', '0', 'bet', '1403508027'),
(7, 7, 0, '20', 'out', '0', 'bet', '1403517317'),
(8, 7, 0, '20', 'out', '0', 'bet', '1403519727'),
(9, 7, 0, '10', 'out', '0', 'bet', '1403686203'),
(11, 6, 0, '50', 'in', '0', 'bet return', '1403787891'),
(12, 7, 0, '120', 'in', '0', 'bet return', '1403787891'),
(13, 0, 0, '25.5', 'in', '0', 'house com', '1403787891'),
(14, 6, 6, '42.5', 'in', '0', 'bet winning', '1403787891'),
(15, 7, 0, '102', 'in', '0', 'bet winning', '1403787891'),
(16, 7, 0, '50', 'out', '0', 'bet', '1403858356'),
(18, 7, 0, '50', 'out', '0', 'bet', '1404027014'),
(19, 7, 0, '50', 'in', '0', 'bet return', '1404027084'),
(20, 0, 2, '3.75', 'in', '0', 'house com', '1404027084'),
(21, 7, 0, '42.5', 'in', '0', 'bet winning', '1404027084'),
(22, 7, 0, '50', 'out', '0', 'bet', '1404179463'),
(23, 7, 0, '10', 'out', '0', 'bet', '1404179598'),
(24, 6, 0, '20', 'out', '0', 'bet', '1404217967'),
(25, 6, 0, '20', 'out', '0', 'bet', '1404218072'),
(26, 6, 0, '100', 'out', '0', 'bet', '1404218097'),
(27, 6, 0, '30', 'out', '0', 'bet', '1404560009'),
(28, 6, 0, '100', 'out', '0', 'bet', '1404561406'),
(29, 5, 0, '50', 'out', '0', 'bet', '1404865070'),
(30, 6, 0, '100', 'out', '0', 'bet', '1404979849'),
(31, 5, 0, '30', 'out', '0', 'bet', '1404998913'),
(32, 6, 0, '500', 'in', 'CC1405133776', 'transfer', '1405133776'),
(33, 6, 0, '500', 'in', 'CC1405134385', 'transfer', '1405134385'),
(34, 6, 0, '500', 'in', 'CC1405134709', 'transfer', '1405134709'),
(35, 6, 0, '1200', 'in', 'CC1405136711', 'transfer', '1405136711'),
(36, 6, 0, '500', 'in', 'CC1405137433', 'transfer', '1405137433'),
(37, 6, 0, '500', 'in', 'CC1405137550', 'transfer', '1405137550'),
(38, 6, 0, '500', 'in', 'CC1405137839', 'transfer', '1405137839'),
(39, 6, 0, '500', 'in', 'CC1405137973', 'transfer', '1405137973'),
(40, 6, 0, '500', 'in', 'CC1405144346', 'transfer', '1405144346'),
(41, 6, 0, '500', 'in', 'CC1405144445', 'transfer', '1405144445'),
(42, 6, 0, '1200', 'in', 'CC1405145278', 'transfer', '1405145278'),
(43, 6, 0, '500', 'in', 'CC1405145792', 'transfer', '1405145792'),
(44, 6, 0, '500', 'in', 'CC1405145931', 'transfer', '1405145931'),
(45, 6, 0, '500', 'in', 'CC1405146047', 'transfer', '1405146047'),
(46, 6, 0, '100', 'out', '', 'bet', '1405409799'),
(47, 6, 0, '10', 'out', '', 'bet', '1405410167'),
(48, 5, 0, '10000', 'in', 'CC1405410699', 'transfer', '1405410699'),
(49, 5, 0, '100', 'out', '', 'bet', '1405410850'),
(50, 5, 0, '100', 'out', '', 'bet', '1405410868'),
(51, 5, 0, '100', 'out', '', 'bet', '1405410938'),
(52, 5, 0, '100', 'out', '', 'bet', '1405410998'),
(53, 6, 0, '100', 'out', '', 'bet', '1405497843'),
(54, 6, 0, '20', 'out', '', 'bet', '1405506484'),
(55, 6, 0, '20', 'out', '', 'bet', '1405514725'),
(56, 6, 0, '100', 'out', '', 'bet', '1405515497'),
(57, 6, 0, '100', 'out', '', 'bet', '1405516974'),
(58, 5, 0, '50', 'out', '', 'bet', '1406036908'),
(59, 5, 0, '20', 'out', '', 'bet', '1406036987'),
(60, 5, 0, '1200', 'in', 'CC1406037085', 'transfer', '1406037085'),
(61, 5, 0, '10', 'out', '', 'bet', '1406037608'),
(62, 5, 0, '20', 'out', '', 'bet', '1406037640'),
(63, 5, 0, '100', 'out', '', 'bet', '1406189573'),
(64, 6, 0, '10', 'out', '', 'bet', '1406189848'),
(65, 5, 0, '11', 'out', '', 'bet', '1406190259'),
(66, 5, 0, '1000', 'out', '', 'bet', '1406200025'),
(67, 5, 0, '5', 'out', '', 'bet', '1406212541'),
(68, 6, 0, '24', 'out', '', 'bet', '1406212568'),
(69, 6, 0, '0', 'out', '', 'bet', '1406272304'),
(70, 6, 0, '0', 'out', '', 'bet', '1406272873'),
(71, 6, 0, '0', 'out', '', 'bet', '1406273152'),
(72, 6, 0, '0', 'out', '', 'bet', '1406274715'),
(73, 6, 19, '0', 'in', '0', 'bet winning', '1406275263'),
(74, 6, 0, '0', 'out', '', 'bet', '1406276783'),
(75, 6, 20, '0', 'in', '0', 'bet winning', '1406276845'),
(76, 6, 0, '0', 'out', '', 'bet', '1406282649'),
(77, 6, 0, '0', 'out', '', 'bet', '1406282769'),
(78, 18, 0, '8000', 'in', 'CC1406285549', 'transfer', '1406285549'),
(79, 18, 0, '10', 'out', '', 'bet', '1406285725'),
(80, 18, 0, '100', 'out', '', 'bet', '1406285875'),
(81, 18, 0, '1', 'out', '', 'bet', '1406285955'),
(82, 6, 0, '10', 'out', '', 'bet', '1406537725'),
(83, 6, 0, '10', 'out', '', 'bet', '1406537783'),
(84, 6, 0, '10', 'out', '', 'bet', '1406537855'),
(85, 6, 0, '80', 'out', '', 'bet', '1406538121'),
(86, 5, 0, '9000', 'in', 'CC1406624164', 'transfer', '1406624164'),
(87, 5, 0, '5', 'out', '', 'bet', '1406624282'),
(88, 6, 0, '30', 'out', '', 'bet', '1406806665'),
(89, 18, 0, '10000', 'in', 'CC1415537941', 'transfer', '1415537941'),
(90, 5, 0, '5', 'out', '', 'bet', '1415571981'),
(91, 5, 0, '20', 'out', '', 'bet', '1415572959'),
(92, 18, 0, '10', 'out', '', 'bet', '1415712726'),
(93, 18, 0, '10', 'out', '', 'bet', '1415712778'),
(94, 18, 0, '10', 'out', '', 'bet', '1415712798'),
(95, 18, 0, '10', 'out', '', 'bet', '1415712823'),
(96, 18, 0, '9000', 'in', 'CC1415712879', 'transfer', '1415712879');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `cf_name` varchar(150) NOT NULL,
  `cf_value` varchar(150) NOT NULL,
  KEY `cf_name` (`cf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`cf_name`, `cf_value`) VALUES
('maintenance_mode', '0'),
('site name', 'sports9G'),
('site description', 'wala'),
('site meta keywords', 'test'),
('default language', 'jp'),
('currency', 'USD'),
('time zone', 'Asia/Tokyo'),
('default house commission', '10'),
('mail receive game result', '1'),
('mail receive daily sales', '0'),
('mail receive when user deposited money', '0'),
('twitter id', 'jd5688@gmail.com'),
('tweet when game live', '1'),
('tweet when game ends', '0'),
('bot username', 'admin'),
('bot system', '0');

-- --------------------------------------------------------

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
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`c_id`, `c_keyword`, `c_coins`, `c_isWelcome`) VALUES
(1, 'abcdefg', 15, 0),
(2, 'keyword', 10, 1);

-- --------------------------------------------------------

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
-- Dumping data for table `games`
--

INSERT INTO `games` (`g_id`, `g_title`, `g_title_jp`, `g_description`, `g_description_jp`, `g_image`, `g_categories`, `g_categories_jp`, `g_tags`, `g_tags_jp`, `g_betInfo`, `g_betInfo_jp`, `g_addInfo`, `g_addInfo_jp`, `g_schedFrom`, `g_schedTo`, `g_timezone`, `g_coinPerBet`, `g_houseCom`, `g_publishType`, `g_isRecommend`, `g_isTrial`, `g_japPage`, `g_engPage`, `g_betMinimum`, `g_bookmarks`, `g_likes`, `g_isCancelled`, `g_isClosed`, `g_isDeleted`, `g_lastUpdated`) VALUES
(1, 'LA Lakers vs. Miami Heat | which team will win world cup 2015', 'NBAファイナル LA Lakers vs. Miami Heat どっちのチームが勝つと思いますか？', 'game 1', 'NBA LA Lakers vs. Miami Heat どっちのチームが勝つと思いますか？', '1406537399.jpg', 'Basketball', 'バスケットボール', 'nba, which team will win', '', '', 'NBA LA Lakers vs. Miami Heat どっちのチームが勝つと思いますか？', 'fdfd<br>', 'NBA LA Lakers vs. Miami Heat どっちのチームが勝つと思いますか？', '1405807200', '1406810400', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 300, 1, 2, 0, 0, 0, '2014-08-04 00:47:46'),
(2, 'Sharapova vs. Wozniacki', '女子テニスのエキシビジョンマッチ、マリア・シャラポワvsキャロライン・ウォズニアッキどっちが勝つ？', 'game1', '女子テニスのエキシビジョンマッチ、マリア・シャラポワvsキャロライン・ウォズニアッキどっちが勝つ？', '1406189070.jpg', 'Tennis', 'テニス', 'wimbledon', '', 'fdfd<br>', '', 'fdfd<br>', '', '1406757600', '1406818800', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, '2014-08-04 00:24:55'),
(3, 'Japan vs. Brazil | which team will win world cup 2014', 'コンフェデレーションズカップ 日本対ブラジル でどちらのチームが勝つと思いますか？', 'fifa', 'コンフェデレーションズカップ 日本対ブラジル でどちらのチームが勝つと思いますか？', '1406537301.jpg', 'Soccer', 'サッカー', 'fifa, which team will win', '', 'dffdf<br>', 'コンフェデレーションズカップ 日本対ブラジル でどちらのチームが勝つと思いますか？', 'fdfd<br>', 'コンフェデレーションズカップ 日本対ブラジル でどちらのチームが勝つと思いますか？', '1406239200', '1406844000', 'Asia/Tokyo', 10, 15, 'public', 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, '2014-08-04 00:24:55'),
(6, 'Pacquiao vs. Mayweather', '', 'This fight will finally determine who is the number 1 pound-for-pound king of the boxing ring!', '', '1402731350.png', 'Boxing', 'ボクシング', 'boxing, las vegas, pound for pound', '', '<ul>\r\n						<li>Mon, Sep 20th Liga BBVA 2013-14 Match 20</li>\r\n						<li>Real Madrid vs FC Barcelona</li>\r\n						<li>Mon, Sep 20th 19:00 Kick Off (GMT+8)</li>\r\n					</ul>', '', '<ul>\r\n						<li>Book closes Mon, Sep 20th 18:00 (GMT+8)</li>\r\n						<li>An unplayed or postponed match will be treated as a non-runner for settling purposes unless it is played within the same week (ending on Sunday) in which case the bet will stand unless cancelled by mutual consent.</li>\r\n					</ul>', '', '1403215200', '1403301600', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, '2014-08-04 00:24:55'),
(7, 'Jon Jones vs. Alexander Gustafsson', '', 'ufc 155', '', '1406189313.jpg', 'UFC', 'UFC', 'ufc', '', 'fdfdf<br>', '', 'fdfdf<br>', '', '1403820000', '1406498400', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(8, 'Real Madrid vs FC Barcelona Which team will get a first goal?', '伝統のクラシコ レアルマドリードvsFCバルセロナ どちらが先に先制点を取る？', 'Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis facilisis arcu. Aenean sollicitudin ligula vel imperdiet accumsan. Pellentesque vitae lectus nec nisl comm', '伝統のクラシコ レアルマドリードvsFCバルセロナ どちらが先に先制点を取る？', '1406188267.jpg', 'Soccer', 'サッカー', 'soccer, world cup', '', '<div><ul></ul></div><div><div><div><li>Mon, Sep 20th Liga BBVA 2013-14 Match 20</li></div></div><div><div><li>Real Madrid vs FC Barcelona</li></div></div><div><div><li>Mon, Sep 20th 19:00 Kick Off (GMT+8)</li></div></div></div><div></div>', '伝統のクラシコ レアルマドリードvsFCバルセロナ どちらが先に先制点を取る？', '<div><ul></ul></div><div><div><div><li>Book closes Mon, Sep 20th 18:00 (GMT+8)</li></div></div><div><div><li>An\r\n unplayed or postponed match will be treated as a non-runner for \r\nsettling purposes unless it is played within the same week (ending on \r\nSunday) in which case the bet will stand unless cancelled by mutual \r\nconsent.</li></div></div></div><div></div>', '伝統のクラシコ レアルマドリードvsFCバルセロナ どちらが先に先制点を取る？', '1404079200', '1406757600', 'Asia/Tokyo', 1, 15, 'public', 1, 0, 1, 1, 10, 1, 1, 0, 0, 0, '2014-08-04 00:24:55'),
(9, 'ダルビッシュ投手は次の登板試合でいくつ奪三振を獲得できる？', '', 'Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis facilisis arcu. Aenean sollicitudin ligula vel imperdiet accumsan. Pellentesque vitae lectus nec nisl comm', '', '1406189128.png', 'Baseball', '野球', 'MLB, japanese', '', '<div><ul></ul></div><div><div><div><li>Mon, Sep 20th Liga BBVA 2013-14 Match 20</li></div></div><div><div><li>Real Madrid vs FC Barcelona</li></div></div><div><div><li>Mon, Sep 20th 19:00 Kick Off (GMT+8)</li></div></div></div><div></div>', '', '<div><ul></ul></div><div><div><div><li>Book closes Mon, Sep 20th 18:00 (GMT+8)</li></div></div><div><div><li>An\r\n unplayed or postponed match will be treated as a non-runner for \r\nsettling purposes unless it is played within the same week (ending on \r\nSunday) in which case the bet will stand unless cancelled by mutual \r\nconsent.</li></div></div></div><div></div>', '', '1404338400', '1404424800', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(10, 'Brasil vs Colombia | which team will win world cup 2014', 'ワールドカップラウンド16 ブラジルvsコロンビア どっちの国が勝つと思う？', 'Brasil and Colombia battle it up for the semifinals slot.', 'ワールドカップラウンド16 ブラジルvsコロンビア どっちの国が勝つと思う？', '1406188795.jpg', 'Soccer', 'サッカー', 'world cup, which team will win', '', 'match betting text lorem ipsom dolor...', '', 'game condition text lorem ipsum dolor...', '', '1404511200', '1406671200', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(11, 'Machida vs Weidman', '', 'Machida tries to get the championship belt from Weidman!', '', '1406188939.jpg', 'UFC', 'UFC', '175', '', 'fdfdf fdfd<br>', '', 'dfd fdfd<br>', '', '1404918000', '1406646000', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 100, 1, 2, 0, 0, 0, '2014-08-04 00:24:55'),
(12, 'Germany vs Argentina | which team will win world cup 2014', 'ブラジルワールドカップ決勝戦 ドイツ vs アルゼンチン どっちのチームが勝つと思う？', 'championship world cup brazil', 'ブラジルワールドカップ決勝戦 ドイツ vs アルゼンチン どっちのチームが勝つと思う？', '1406535915.jpg', 'Soccer', 'サッカー', 'world cup, which team will win', '', 'fdfdf<br>', 'fdfd<br>', 'fdfdf<br>', 'fdfd<br>', '1405782000', '1406646000', 'Asia/Tokyo', 10, 10, 'public', 0, 0, 1, 1, 10, 1, 1, 0, 0, 0, '2014-08-04 00:24:55'),
(13, 'Netherlands vs. Costa Rica', '', 'fdfdfd', '', '1406189002.jpg', 'Soccer', 'サッカー', 'which team will win', '', 'fdfdf<br>', '', 'fdfdf<br>', '', '1405436400', '1405522800', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 10, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(15, 'LA Lakers vs. Miami Heat', '', 'game 1', '', '', 'Basketball', 'バスケットボール', 'nba', '', 'fdfd<br>', '', 'fdfd<br>', '', '1405807200', '1406810400', 'Asia/Tokyo', 1, 15, 'draft', 0, 0, 1, 1, 300, 0, 0, 0, 0, 1, '2014-08-04 00:24:55'),
(16, 'Sharapova vs. Wozniacki', '', 'game1', '', '1406188138.jpg', 'Tennis', 'テニス', 'wimbledon', '', 'fdfd<br>', '', 'fdfd<br>', '', '1406120760', '1406811960', 'Asia/Tokyo', 15, 15, 'public', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(17, 'Sharapova vs. Wozniacki', '', 'game1', '', '', 'Tennis', 'テニス', 'wimbledon', '', 'fdfd<br>', '', 'fdfd<br>', '', '1406188085', '1406188085', 'Asia/Tokyo', 1, 15, 'draft', 0, 0, 1, 1, 0, 0, 0, 0, 0, 1, '2014-08-04 00:24:55'),
(18, 'Japan vs. Brazil | who player will get first goal?', '', 'fifa', '', '1406187871.jpg', 'Soccer', 'サッカー', 'fifa, first goal', '', 'dffdf<br>', '', 'fdfd<br>', '', '1406190900', '1406795700', 'Asia/Tokyo', 10, 15, 'public', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(19, 'Superman vs Batman', '', 'Superman and Batman battle it out. Who will die first?', '', '1406270692.jpg', 'UFC', 'UFC', 'superman, batman, superhero', '', 'fdfd', '', 'fdfd', '', '1406214000', '1406300400', 'Asia/Tokyo', 1, 15, 'public', 0, 1, 1, 1, 0, 0, 0, 0, 1, 0, '2014-08-04 00:24:55'),
(20, 'Superman vs Batman', '', 'Superman and Batman battle it out. Who will die first?', '', '1406270692.jpg', 'UFC', 'UFC', 'superman, batman, superhero', '', 'fdfd', '', 'fdfd', '', '1406276100', '1406362500', 'Asia/Tokyo', 1, 15, 'public', 0, 1, 1, 1, 0, 0, 0, 0, 1, 0, '2014-08-04 00:24:55'),
(21, 'Superman vs Batman III', '', 'Superman and Batman battle it out. Who will die first?', '', '1406270692.jpg', 'UFC', 'UFC', 'superman, batman, superhero', '', 'fdfd', '', 'fdfd', '', '1406282160', '1406368560', 'Asia/Tokyo', 1, 15, 'public', 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, '2014-08-04 00:24:55'),
(22, 'Japan vs. China', 'Japan vs China', 'who wins the soccer match', '誰がサッカーの試合に勝利', '', 'Soccer', 'サッカー', 'tagen, tag2en', 'tagjp, tag2jp', 'match betting en<br>', 'match betting jp<br>', 'game condition en<br>', 'game condition jp<br>', '1406300400', '1406300400', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 100, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(23, 'Good vs Evil EN', 'Good vs Evil', 'en who will prevail', 'who will prevail', '', 'Basketball', 'バスケットボール', 'gooden, evilen', 'goodjp, eviljp', 'mb en<br>', 'mb JP<br>', 'gc en<br>', 'gc JP<br>', '1406300400', '1406300400', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 1, 100, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(27, 'Good vs Evil EN', 'Good vs Evil', 'en who will prevail', 'who will prevail', '', 'Basketball', 'バスケットボール', 'gooden, evilen', 'goodjp, eviljp', 'mb en<br>', 'mb JP<br>', 'gc en<br>', 'gc JP<br>', '1406378855', '1406378855', 'Asia/Tokyo', 1, 15, 'draft', 0, 0, 1, 1, 100, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(28, 'Shinji Kagawa into starting lineup?', '香川選手はプレミアリーグ14/15シーズンの開幕戦でスタメン出場するでしょうか？', 'Shinji Kagawa into starting lineup?', '香川選手はスタメン出場するでしょうか？', '1406535998.png', 'Soccer', 'サッカー', '', '香川, スタメン予想, プレミアリーグ', '', '香川選手はスタメン出場するでしょうか？', '', '香川選手はスタメン出場するでしょうか？', '1406473200', '1406732400', 'Asia/Tokyo', 30, 15, 'public', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(29, 'J - League game18 Gamba vs Marinos which team will win in this game?', 'Jリーグ 第18節 ガンバvsマリノス 勝つのはどっち？', 'gamba osaka vs yokohama F. marinos. which team will win in this game?', '2014シーズン Jリーグ 第18節 ガンバ大阪 vs 横浜 F.マリノス 勝つのはどっちのチームでしょうか？中村俊輔選手のフリーキックは炸裂？それとも宇佐美選手のキレキレドリブルが出るのでしょうか？', '1406551074.jpg', 'Soccer', 'サッカー', 'J-League', 'Jリーグ', '2014season J League game 18 Gamba osaka vs Yokohama F. marinos', '2014シーズン Jリーグ18節 ガンバ大阪 vs 横浜マリノス', 'if game is canceled', '無効試合の場合、キャンセルになります', '1406547900', '1406970000', 'Asia/Tokyo', 10, 15, 'public', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, '2014-08-04 00:24:55'),
(30, '', '2014 SUZUKI 日米野球　第1戦 勝つのはどっち？', '', '11月12日(水) 京セラドーム大阪 にて18:00から開催される『2014 SUZUKI 日米野球 第1戦 侍ジャパン 対 MLBオールスターチーム』の勝敗結果を予想してください。', '1415571865.jpg', 'Baseball', '野球', '', '日米野球', '', '11月12日(水) 京セラドーム大阪 にて18:00から開催される『2014 SUZUKI 日米野球 第1戦』の勝敗結果を予想してください。', '', '延長、天候により無効試合となった場合、投票されたBETは無効となりCOIN返却されます。', '1415566800', '1415782800', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2014-11-09 22:45:34'),
(31, '', '2014 SUZUKI 日米野球　第2戦 勝つのはどっち？', '', '11月14日(金) 東京ドーム にて18:00から開催される『2014 SUZUKI 日米野球 第1戦 侍ジャパン 対 MLBオールスターチーム』の勝敗結果を予想してください。', '1415571865.jpg', 'Baseball', '野球', '', '日米野球', '', '11月14日(金)&nbsp;東京ドーム&nbsp;にて18:00から開催される『2014 SUZUKI 日米野球 第2戦』の勝敗結果を予想してください。', '', '延長、天候により無効試合となった場合、投票されたBETは無効となりCOIN返却されます。', '1415566800', '1415955600', 'Asia/Tokyo', 1, 15, 'public', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2014-11-09 22:46:57'),
(32, '『ATPワールドツアーファイナルズ』錦織圭 vs R.フェデラー 勝つのはどっち？', '『ATPワールドツアーファイナルズ』錦織圭 vs R.フェデラー 勝つのはどっち？', '11月11日(火)に試合予定の『ATPワールドツアーファイナルズ』錦織圭 vs R.フェデラー の勝敗結果を予想してください。\r\n', '11月11日(火)に試合予定の『ATPワールドツアーファイナルズ』錦織圭 vs R.フェデラー の勝敗結果を予想してください。\r\n', '1415572841.jpg', 'Tennis', 'テニス', '', 'ワールドツアーファイナルズ', '', '11月11日(火) ATP ワールドツアー ファイナルズ 第2戦 錦織圭 vs R.フェデラー<br>', '', '延長、天候により無効試合となった場合、投票されたBETは無効となりCOIN返却されます。', '1415545200', '1415674800', 'Asia/Tokyo', 10, 15, 'public', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2014-11-09 22:44:56');

-- --------------------------------------------------------

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
-- Dumping data for table `sports_category`
--

INSERT INTO `sports_category` (`sc_id`, `sc_name`, `sc_name_jp`, `sc_description`) VALUES
(1, 'Basketball', 'バスケットボール', ''),
(2, 'Soccer', 'サッカー', ''),
(3, 'Baseball', '野球', ''),
(4, 'Volleyball', 'バレーボール', ''),
(7, 'Hockey', 'ホッケー', ''),
(8, 'Tennis', 'テニス', ''),
(9, 'Boxing', 'ボクシング', ''),
(10, 'UFC', 'UFC', ''),
(11, 'Sumo', '相撲', '');

-- --------------------------------------------------------

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
-- Dumping data for table `sports_tags`
--

INSERT INTO `sports_tags` (`st_id`, `st_name`, `st_lang`, `st_description`) VALUES
(1, 'nba', 'en', ''),
(2, 'wimbledon', 'en', ''),
(3, 'boxing', 'en', 'test'),
(4, 'fight', 'en', ''),
(5, 'soccer', 'en', ''),
(6, 'fifa', 'en', ''),
(8, 'ufc', 'en', ''),
(9, ' las vegas', 'en', ''),
(10, ' pound for pound', 'en', ''),
(11, ' world cup', 'en', ''),
(12, ' japanese', 'en', ''),
(13, 'world cup', 'en', ''),
(14, '175', 'en', ''),
(15, ' which team will win', 'en', ''),
(16, 'which team will win', 'en', ''),
(17, 'MLB', 'en', ''),
(18, ' first goal', 'en', ''),
(19, 'superman', 'en', ''),
(20, 'batman', 'en', 'fdf'),
(21, ' superhero', 'en', ''),
(25, 'tagjp', 'jp', ''),
(26, ' tag2jp', 'jp', ''),
(27, 'tagen', 'en', ''),
(28, ' tag2en', 'en', ''),
(29, 'goodjp', 'jp', ''),
(30, ' eviljp', 'jp', ''),
(31, 'gooden', 'en', ''),
(32, ' evilen', 'en', ''),
(33, '香川', 'jp', ''),
(34, ' スタメン予想', 'jp', ''),
(35, ' プレミアリーグ', 'jp', ''),
(36, 'Jリーグ', 'jp', ''),
(37, 'J-League', 'en', ''),
(38, '日米野球', 'jp', ''),
(39, 'ワールドツアーファイナルズ', 'jp', '');

-- --------------------------------------------------------

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
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`tr_id`, `tr_tx_id`, `tr_method`, `user_id`, `tr_cc_nt_id`, `bill_id`, `cpid`, `tr_gw_tx_id`, `tr_amount`, `tr_currency`, `tr_coins`, `tr_date`, `tr_status`) VALUES
(1, 'CC1405133776', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 50, '1405133776', 1),
(2, 'CC1405134385', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405134385', 1),
(3, 'CC1405134709', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405134709', 1),
(6, 'CC1405136711', 'cc', 6, 4, 4, 2, 0, 100, 'USD', 1200, '1405136711', 1),
(7, 'CC1405137433', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405137433', 1),
(8, 'CC1405137550', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405137550', 1),
(9, 'CC1405137839', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405137839', 1),
(10, 'CC1405137973', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405137973', 1),
(11, 'CC1405144346', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405144346', 1),
(12, 'CC1405144445', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405144445', 1),
(13, 'CC1405145278', 'cc', 6, 4, 4, 2, 0, 100, 'USD', 1200, '1405145278', 1),
(14, 'CC1405145792', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405145792', 1),
(15, 'CC1405145931', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405145931', 1),
(16, 'CC1405146047', 'cc', 6, 4, 4, 1, 0, 50, 'USD', 500, '1405146047', 1),
(17, '1', 'cc', 6, 4, 4, 2, 0, 100, 'USD', 1000, '1403433160', 1),
(18, 'CC1405410699', 'cc', 5, 5, 5, 11, 0, 800, 'USD', 10000, '1405410699', 1),
(19, 'CC1406037085', 'cc', 5, 5, 5, 2, 0, 100, 'USD', 1200, '1406037085', 1),
(20, 'CC1406285549', 'cc', 18, 0, 6, 9, 0, 600, 'USD', 8000, '1406285549', 1),
(21, 'CC1406624164', 'cc', 5, 0, 5, 10, 0, 700, 'USD', 9000, '1406624164', 1),
(22, 'CC1415537941', 'cc', 18, 0, 6, 11, 0, 800, 'USD', 10000, '1415537941', 1),
(23, 'CC1415712879', 'cc', 18, 0, 6, 10, 0, 700, 'USD', 9000, '1415712879', 1);

-- --------------------------------------------------------

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fullname`, `user_pic`, `user_password`, `user_coins`, `user_betting`, `user_email`, `user_lastlogin`, `user_registered`, `user_isadmin`, `user_status`, `user_lang`, `user_timezone`, `user_sex`, `user_bio`, `user_website`, `user_notify`, `user_sendmail`, `user_remind`, `user_gamedigest`, `user_sitenews`, `user_privacy_page`, `user_privacy_result`) VALUES
(4, 'dem', 'Rudem Labial', '', '65744c6c1a9a07f3f960fa03fc4d3f98', 0, 0, 'jd5688@gmail.com', '1406162260', '2014-06-20 06:07:35', 1, 1, 'en', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(5, 'Takez', 'Hiro Takenaka', '5.png', '8253d7ef4c54e8bd267b6126ef0c543d', 18474, 0, 'taketake0814@gmail.com', '1415563857', '2014-06-20 06:08:48', 1, 1, 'jp', 'Asia/Tokyo', 'male', '', 'http://', '', '0', 0, 0, 0, '', 'all'),
(6, 'sugarol', 'Mister Bet', '6.jpg', '65744c6c1a9a07f3f960fa03fc4d3f98', 8428.5, 0, 'sugarol@gmail.com', '1406706956', '2014-06-22 02:52:26', 1, 1, 'undef', 'undefined', 'male', 'its me', 'http://me.com', 'cancelled', 'all,2', 1, 2, 1, 'none', 'none'),
(7, 'Jack', 'Black Jack', '', '65744c6c1a9a07f3f960fa03fc4d3f98', 954.5, 0, 'bj@email.com', '1404183501', '2014-06-23 03:21:54', 0, 1, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(8, 'Aaric', '', '', 'atl275', 0, 0, 'aaric@gmail.com', '', '2014-06-29 09:02:03', 0, 2, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(10, 'Asiong', '', '', 'atl25', 0, 0, 'asiong@gmail.com', '', '2014-06-29 09:15:41', 0, 2, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(11, 'tess', '', '', 'atl63', 0, 0, 'tess@gmail.com', '', '2014-06-29 09:17:31', 0, 2, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(12, 'money', '', '', 'atl533', 0, 0, 'money@money.com', '', '2014-06-29 09:25:44', 0, 2, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(13, 'pusoy', '', '', 'atl729', 0, 0, 'pusoy@yahoo.com', '', '2014-06-30 02:27:12', 0, 1, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(14, 'erap', '', '', 'atl558', 0, 0, 'erap@email.com', '', '2014-06-30 05:13:04', 0, 1, '', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(15, 'uto', '', '', 'db99a92a7a292127eea5ae461a0f0f40', 0, 0, 'utol@mail.com', '', '2014-07-10 07:00:38', 0, 1, '', 'Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(16, 'talunan', '', '', '26bf64cceb49f3a23f8e4ff458dc7806', 0, 0, 'talunan@gmail.com', '', '2014-07-10 07:20:03', 0, 1, '', 'Tokyo', '', '', '', '', '0', 0, 0, 0, '', 'all'),
(17, 'A', '', '', 'b9ea420842ce5a6e3e472b162e359196', 0, 0, 'A@com', '', '2014-07-23 08:13:42', 0, 1, '', 'Tokyo', '', '', '', '', '0', 0, 0, 0, 'all', 'all'),
(18, 'komurokenji', '', '', 'a0b8d18419cbd4ccdcaaab16b138b18f', 26849, 0, 'komurokenji@gmail.com', '1415537077', '2014-07-25 09:48:10', 0, 1, 'en', 'Asia/Tokyo', '', '', '', '', '0', 0, 0, 0, 'all', 'all');

-- --------------------------------------------------------

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
-- Dumping data for table `users_billing_address`
--

INSERT INTO `users_billing_address` (`bill_id`, `user_id`, `bill_fullname`, `bill_postal`, `bill_prefecture`, `bill_address1`, `bill_address2`, `bill_phone`) VALUES
(2, 4, 'Rudem Labial', '1800', '北海道', 'B4, L9, UBB', 'Marikina City', '123456'),
(3, 4, 'Rudem Labial', '90233', '', 'Los Angeles', 'CA', '13434343'),
(8, 6, 'Sugar Roll', '1800', '', 'B4, L9 UBB', 'Marikina City', '12345678'),
(5, 5, '', '', '', '', '', ''),
(6, 18, 'komuro kenji', '123456', '青森県', '123', '', '123456'),
(9, 6, 'Sugar Roll', '1800', '', 'B4, L9 UBB1', 'Marikina City1', '12345678');

-- --------------------------------------------------------

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
-- Dumping data for table `users_cc`
--

INSERT INTO `users_cc` (`cc_id`, `cc_select`, `cc_type`, `cc_number`, `cc_holder_name`, `cc_exp_mo`, `cc_exp_yr`, `user_id`, `bill_id`) VALUES
(3, 'cc', 'Visa', '4054600011209650', 'Rudem Labial', '01', '2016', 4, 3),
(4, 'cc', 'Visa', '4054600011298888', 'Rudem Labial', '01', '2016', 6, 8),
(5, 'cc', 'Visa', '12131131', '424242', '01', '2014', 5, 5),
(6, 'cc', 'Visa', '123456789', 'kk', '01', '2014', 18, 6),
(9, 'cc', 'Visa', '5555555555555555', 'Rudem Labial', '01', '2014', 6, 9);

-- --------------------------------------------------------

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

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`ua_id`, `ua_seen`, `user_id`, `ua_fieldname`, `ua_fieldvalue`, `ua_activity`, `ua_date`) VALUES
(2, 1, 5, 'g_id', '12', 'joinedgame', '1405410850'),
(3, 1, 6, 'g_id', '12', 'like', '1405412275'),
(5, 1, 6, 'g_id', '12', 'unbookmark', '1405412519'),
(6, 1, 6, 'g_id', '12', 'bookmark', '1405412528'),
(8, 1, 6, 'user_id', '6', 'changepass', '1405419361'),
(10, 1, 6, 'g_id', '2', 'like', '1405504433'),
(12, 1, 6, 'g_id', '12', 'joinedgame', '1405514725'),
(14, 1, 6, 'g_id', '13', 'joinedgame', '1405516974'),
(17, 1, 5, 'g_id', '1', 'like', '1406037019'),
(18, 1, 5, 'g_id', '1', 'unlike', '1406037048'),
(20, 1, 5, 'g_id', '1', 'joinedgame', '1406037640'),
(21, 1, 0, 'g_id', '1', 'like', '1406107338'),
(22, 1, 0, 'g_id', '1', 'bookmark', '1406107339'),
(23, 1, 0, 'g_id', '1', 'unbookmark', '1406107345'),
(25, 1, 6, 'g_id', '11', 'like', '1406189710'),
(27, 1, 5, 'g_id', '16', 'joinedgame', '1406190259'),
(29, 1, 5, 'g_id', '10', 'joinedgame', '1406212541'),
(30, 1, 6, 'g_id', '7', 'joinedgame', '1406212568'),
(34, 1, 6, 'g_id', '19', 'joinedgame', '1406274715'),
(35, 1, 6, 'g_id', '19', 'won', '1406275263'),
(36, 1, 5, 'g_id', '12', 'like', '1406275742'),
(37, 1, 5, 'g_id', '12', 'bookmark', '1406275743'),
(38, 1, 5, 'g_id', '12', 'unbookmark', '1406275745'),
(39, 1, 5, 'g_id', '12', 'unlike', '1406275747'),
(40, 1, 6, 'g_id', '20', 'joinedgame', '1406276783'),
(41, 1, 6, 'g_id', '20', 'won', '1406276845'),
(43, 1, 6, 'g_id', '21', 'joinedgame', '1406282770'),
(44, 1, 6, 'g_id', '21', 'like', '1406282788'),
(47, 1, 18, 'g_id', '10', 'joinedgame', '1406285955'),
(48, 1, 18, 'user_id', '18', 'changepass', '1406286752'),
(52, 1, 6, 'g_id', '1', 'joinedgame', '1406538121'),
(53, 1, 5, 'g_id', '11', 'unlike', '1406570232'),
(54, 1, 5, 'g_id', '11', 'like', '1406570233'),
(55, 1, 5, 'g_id', '11', 'unbookmark', '1406570235'),
(56, 1, 5, 'g_id', '11', 'bookmark', '1406570235'),
(57, 1, 5, 'g_id', '11', 'joinedgame', '1406624282'),
(58, 1, 6, 'g_id', '16', 'joinedgame', '1406806665'),
(59, 1, 5, 'g_id', '30', 'joinedgame', '1415571981'),
(60, 1, 5, 'g_id', '32', 'joinedgame', '1415572959'),
(61, 1, 18, 'g_id', '31', 'joinedgame', '1415712726'),
(64, 1, 18, 'g_id', '30', 'joinedgame', '1415712824');

-- --------------------------------------------------------

--
-- Table structure for table `user_bets`
--

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
-- Dumping data for table `user_bets`
--

INSERT INTO `user_bets` (`ub_id`, `user_id`, `g_id`, `bi_id`, `ub_coins`, `ub_notify`, `cd_id`, `ub_iswinner`) VALUES
(1, 6, 6, 13, 50, 1, 1, 1),
(2, 6, 6, 12, 20, 0, 3, 0),
(3, 7, 6, 13, 100, 0, 4, 1),
(4, 7, 6, 12, 50, 0, 6, 0),
(5, 7, 6, 12, 20, 0, 7, 0),
(6, 7, 6, 13, 20, 0, 8, 1),
(7, 7, 6, 12, 10, 0, 9, 0),
(8, 7, 7, 15, 50, 0, 16, 0),
(9, 7, 2, 4, 50, 0, 18, 1),
(10, 7, 9, 21, 50, 0, 22, 0),
(11, 7, 9, 19, 10, 0, 23, 0),
(12, 6, 9, 20, 20, 0, 24, 0),
(13, 6, 9, 20, 20, 0, 25, 0),
(14, 6, 9, 21, 100, 0, 26, 0),
(15, 6, 10, 23, 30, 0, 27, 0),
(16, 6, 10, 22, 100, 0, 28, 0),
(17, 5, 11, 26, 50, 0, 29, 0),
(18, 6, 11, 25, 100, 0, 30, 0),
(19, 5, 11, 26, 30, 0, 31, 0),
(20, 6, 12, 27, 100, 0, 46, 0),
(21, 6, 12, 29, 10, 0, 47, 0),
(22, 5, 12, 28, 100, 0, 49, 0),
(23, 5, 12, 28, 100, 0, 50, 0),
(24, 5, 12, 28, 100, 0, 51, 0),
(25, 5, 12, 28, 100, 0, 52, 0),
(26, 6, 12, 28, 100, 0, 53, 0),
(27, 6, 12, 29, 20, 0, 54, 0),
(28, 6, 12, 27, 20, 0, 55, 0),
(29, 6, 13, 31, 100, 0, 56, 0),
(30, 6, 13, 30, 100, 0, 57, 0),
(31, 5, 1, 2, 50, 0, 58, 0),
(32, 5, 1, 1, 20, 0, 59, 0),
(33, 5, 1, 2, 10, 0, 61, 0),
(34, 5, 1, 2, 20, 0, 62, 0),
(35, 5, 11, 26, 100, 0, 63, 0),
(36, 6, 7, 14, 10, 0, 64, 0),
(37, 5, 16, 34, 11, 0, 65, 0),
(38, 5, 10, 22, 1000, 0, 66, 0),
(39, 5, 10, 24, 5, 0, 67, 0),
(40, 6, 7, 14, 24, 0, 68, 0),
(43, 6, 19, 280, 0, 0, 71, 0),
(44, 6, 19, 279, 0, 0, 72, 1),
(45, 6, 20, 291, 0, 0, 74, 1),
(46, 6, 21, 300, 0, 0, 76, 0),
(47, 6, 21, 302, 0, 0, 77, 0),
(48, 18, 10, 22, 10, 0, 79, 0),
(49, 18, 10, 22, 100, 0, 80, 0),
(50, 18, 10, 24, 1, 0, 81, 0),
(51, 6, 1, 415, 10, 0, 82, 0),
(52, 6, 1, 414, 10, 0, 83, 0),
(53, 6, 1, 414, 10, 0, 84, 0),
(54, 6, 1, 414, 80, 0, 85, 0),
(55, 5, 11, 26, 5, 0, 87, 0),
(56, 6, 16, 34, 30, 0, 88, 0),
(57, 5, 30, 433, 5, 0, 90, 0),
(58, 5, 32, 446, 20, 0, 91, 0),
(59, 18, 31, 447, 10, 0, 92, 0),
(60, 18, 30, 0, 10, 0, 93, 0),
(61, 18, 30, 0, 10, 0, 94, 0),
(62, 18, 30, 433, 10, 0, 95, 0);

-- --------------------------------------------------------

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
-- Dumping data for table `user_bookmarks`
--

INSERT INTO `user_bookmarks` (`ub_id`, `user_id`, `g_id`) VALUES
(3, 6, 8),
(4, 6, 0),
(6, 6, 1),
(7, 6, 6),
(11, 6, 12),
(12, 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE IF NOT EXISTS `user_likes` (
  `ul_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  PRIMARY KEY (`ul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`ul_id`, `user_id`, `g_id`) VALUES
(7, 6, 8),
(8, 6, 1),
(9, 6, 3),
(11, 6, 12),
(12, 6, 2),
(14, 0, 1),
(15, 6, 11),
(17, 6, 21),
(18, 5, 11);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
