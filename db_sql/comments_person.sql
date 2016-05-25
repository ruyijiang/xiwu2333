-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-24 07:43:37
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xiwu2333.com`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments_person`
--

CREATE TABLE IF NOT EXISTS `comments_person` (
  `cpid` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `uid_sender` int(8) NOT NULL COMMENT '评论发出者',
  `uid_receiver` int(8) NOT NULL COMMENT '被评论者',
  `cpid_target` bigint(16) NOT NULL COMMENT '回复的目标评论cpid',
  `score` text NOT NULL COMMENT '打分',
  PRIMARY KEY (`cpid`),
  UNIQUE KEY `cpid` (`cpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
