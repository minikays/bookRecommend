-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 09 月 04 日 09:52
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `growthtrack`
--

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bookName` varchar(45) NOT NULL,
  `fillYear` year(4) NOT NULL,
  `bookNum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fillYear`,`bookName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `books`
--

INSERT INTO `books` (`bookName`, `fillYear`, `bookNum`) VALUES
('壹百度', 2013, 1),
('编程之美', 2013, 1);

-- --------------------------------------------------------

--
-- 表的结构 `info1`
--

CREATE TABLE IF NOT EXISTS `info1` (
  `name` varchar(20) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `sid` varchar(10) NOT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `dorm` varchar(20) DEFAULT NULL,
  `charityAct` tinytext,
  `book` tinytext,
  `competition` tinytext,
  `groupAct` tinytext,
  `sciPro` tinytext,
  `paper` tinytext,
  `failSub` tinytext,
  `GPA` varchar(10) DEFAULT NULL,
  `occupation` tinytext,
  `train` tinytext,
  `grantsInAid` tinytext,
  `loan` tinytext,
  `partTimeJob` tinytext,
  `Allowance` tinytext,
  `otherExp` tinytext,
  `applyDate` date DEFAULT NULL,
  `FcharityAct` tinytext,
  `FGPA` decimal(3,2) DEFAULT NULL,
  `Fbook` tinytext,
  `FsciPro` tinytext,
  `Fpaper` tinytext,
  `Fcompetition` tinytext,
  `Ftour` tinytext,
  `FgroupAct` tinytext,
  `FapplyDate` date DEFAULT NULL,
  `FotherExp` tinytext,
  `thought` tinytext,
  `fillYear` varchar(4) NOT NULL,
  `fillPercent` decimal(2,2) DEFAULT NULL,
  `politics` varchar(5) DEFAULT NULL,
  `scholarship` tinytext,
  PRIMARY KEY (`sid`,`fillYear`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `info1`
--

INSERT INTO `info1` (`name`, `gender`, `sid`, `phoneNum`, `department`, `grade`, `major`, `class`, `email`, `qq`, `dorm`, `charityAct`, `book`, `competition`, `groupAct`, `sciPro`, `paper`, `failSub`, `GPA`, `occupation`, `train`, `grantsInAid`, `loan`, `partTimeJob`, `Allowance`, `otherExp`, `applyDate`, `FcharityAct`, `FGPA`, `Fbook`, `FsciPro`, `Fpaper`, `Fcompetition`, `Ftour`, `FgroupAct`, `FapplyDate`, `FotherExp`, `thought`, `fillYear`, `fillPercent`, `politics`, `scholarship`) VALUES
('彭俊凯', '男', '11331257', '13580513242', '软件学院', '大三', '计算机应用软件', '11级3班', 'mnpengjk@gmail.com', '415599074', '慎思园6号510', '三月义卖，团日活动之爱心义卖，三下乡，公益编程马拉松志愿者，c++培训志愿者，创新赛志愿者等', '《编程之美》《壹百度》', 'ACM校赛，中山大学创意创新大赛', '飞扬C调，小品剧', '公益技术平台', '', '无', '4.58', '班长，IT文化俱乐部主席，中心常委', '扛哑铃', '', '', '400&&12013-09-15&&240', '', '无', '0000-00-00', '更多公益技术比赛', 4.80, '《java疯狂讲义》《android疯狂讲义》', '公益技术', '无', 'ACM', '香港', '无', '2013-09-15', '无', '无', '2013', NULL, '团员', '2000&&12013-09-15&&20&&&2500&&12013-09-15&&20'),
('张三', '男', '1234', '', '软件学院', '大三', '通信软件', '11级2班', '', '', '', '', '', '', '', '', '', '', '0', '', '跑步', '', '', '', '', '', '0000-00-00', '', 0.00, '', '', '', '', '', '', '0000-00-00', '', '', '2013', NULL, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `info2`
--

CREATE TABLE IF NOT EXISTS `info2` (
  `sid` int(10) unsigned NOT NULL,
  `fillYear` year(4) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `charityHours` decimal(10,2) DEFAULT NULL,
  `bookNum` int(10) unsigned DEFAULT NULL,
  `groupActTimes` int(10) unsigned DEFAULT NULL,
  `failSubNum` int(10) unsigned DEFAULT NULL,
  `trainHours` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`sid`,`fillYear`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `info2`
--

INSERT INTO `info2` (`sid`, `fillYear`, `department`, `grade`, `charityHours`, `bookNum`, `groupActTimes`, `failSubNum`, `trainHours`) VALUES
(1234, 2013, '软件学院', '大三', 0.00, 0, 0, 0, 0.50),
(11331257, 2013, '软件学院', '大三', 74.00, 2, 2, 0, 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `patent`
--

CREATE TABLE IF NOT EXISTS `patent` (
  `sid` int(10) unsigned NOT NULL,
  `fillYear` year(4) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `patentType` varchar(45) DEFAULT NULL,
  `patent` tinytext,
  `patentId` varchar(45) NOT NULL,
  PRIMARY KEY (`fillYear`,`sid`,`patentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prize`
--

CREATE TABLE IF NOT EXISTS `prize` (
  `sid` int(10) unsigned NOT NULL,
  `fillYear` year(4) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `content` tinytext,
  `prizeid` int(10) unsigned NOT NULL,
  `gavecommitte` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sid`,`fillYear`,`prizeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `prize`
--

INSERT INTO `prize` (`sid`, `fillYear`, `department`, `grade`, `level`, `content`, `prizeid`, `gavecommitte`) VALUES
(11331257, 2013, '软件学院', '大三', '校级', 'ACM', 0, '中山大学');

-- --------------------------------------------------------

--
-- 表的结构 `statics`
--

CREATE TABLE IF NOT EXISTS `statics` (
  `fillYear` year(4) NOT NULL,
  `department` varchar(45) NOT NULL,
  `avgCHour` decimal(6,2) unsigned DEFAULT NULL,
  `countryPriNum` int(10) unsigned DEFAULT NULL,
  `provincePriNum` int(10) unsigned DEFAULT NULL,
  `CollegePriNum` int(10) unsigned DEFAULT NULL,
  `departPriNum` int(10) unsigned DEFAULT NULL,
  `AvgGroupActNum` decimal(6,2) unsigned DEFAULT NULL,
  `patentType1Num` int(10) unsigned DEFAULT NULL,
  `patentType2Num` int(10) unsigned DEFAULT NULL,
  `patentType3Num` int(10) unsigned DEFAULT NULL,
  `avgTrainHour` decimal(6,2) unsigned DEFAULT NULL,
  `totalFailSub` int(10) unsigned DEFAULT NULL,
  `partyMemNum` int(10) unsigned DEFAULT NULL,
  `LeagueMemNum` int(10) unsigned DEFAULT NULL,
  `avgTourDay` int(11) NOT NULL,
  `stuNum` int(11) NOT NULL,
  PRIMARY KEY (`fillYear`,`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `statics`
--

INSERT INTO `statics` (`fillYear`, `department`, `avgCHour`, `countryPriNum`, `provincePriNum`, `CollegePriNum`, `departPriNum`, `AvgGroupActNum`, `patentType1Num`, `patentType2Num`, `patentType3Num`, `avgTrainHour`, `totalFailSub`, `partyMemNum`, `LeagueMemNum`, `avgTourDay`, `stuNum`) VALUES
(2013, '全校', 37.00, 0, 0, 1, 0, 1.00, 0, 0, 0, 1.50, 0, 0, 1, 0, 2),
(2013, '软件学院', 37.00, 0, 0, 1, 0, 1.00, 0, 0, 0, 1.50, 0, 0, 1, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `tour`
--

CREATE TABLE IF NOT EXISTS `tour` (
  `sid` int(10) unsigned NOT NULL,
  `fillYear` year(4) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `place` varchar(45) DEFAULT NULL,
  `days` int(10) unsigned DEFAULT NULL,
  `time` varchar(45) NOT NULL,
  `theme` varchar(45) DEFAULT NULL,
  `hostEntity` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sid`,`fillYear`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `sid` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`sid`, `password`) VALUES
('11330000', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
('11331257', '55341c96951b1761853476298ddf3ba58fdfbcf5'),
('1234', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
