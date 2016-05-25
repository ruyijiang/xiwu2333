-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-24 07:43:49
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
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `aid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'article id',
  `uid` int(8) NOT NULL COMMENT '作者user id',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新的时间',
  `content` text NOT NULL COMMENT '文章txt文件的位置',
  `caid` int(12) NOT NULL COMMENT '对该文的评论',
  `mentioned_article` text NOT NULL COMMENT '艾特的文章',
  `mentioned_person` text NOT NULL COMMENT '艾特的人',
  `mentioned_competition` text NOT NULL COMMENT '艾特的比赛',
  `mentioned_topic` text NOT NULL COMMENT '艾特的话题',
  `archieve` text NOT NULL COMMENT '归档',
  `abstract` text NOT NULL COMMENT '文章摘要',
  UNIQUE KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
