-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-24 07:43:33
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
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `name` text NOT NULL,
  `password` varchar(13) NOT NULL COMMENT 'md5加密的用户密码',
  `email` text NOT NULL,
  `gender` int(2) NOT NULL COMMENT '性别',
  `country` int(3) NOT NULL,
  `province` int(3) NOT NULL COMMENT '省份',
  `city` int(5) NOT NULL COMMENT '城市',
  `idcard` varchar(19) NOT NULL COMMENT '身份证号',
  `tel` varchar(15) NOT NULL,
  `article` text NOT NULL,
  `competition` text NOT NULL,
  `server` text NOT NULL COMMENT '常驻服务器',
  `comments_p_receive` text NOT NULL COMMENT '收到的对人评价',
  `comments_a_receive` text NOT NULL COMMENT '收到的对文评价',
  `comments_c_receive` text NOT NULL COMMENT '收到的对赛评价',
  `comments_p_send` text NOT NULL COMMENT '发出的对人评价',
  `comments_a_send` text NOT NULL COMMENT '发出的对文评价',
  `comments_c_send` text NOT NULL COMMENT '发出的对赛评价',
  `identification` int(2) NOT NULL COMMENT '实名制认证情况',
  `calling_card_id` int(8) NOT NULL COMMENT '官方认证名片id',
  `qq` varchar(13) NOT NULL COMMENT 'qq号',
  `weibo` text NOT NULL,
  `weixin` text NOT NULL COMMENT '二维码图片路径',
  `liveplain` text NOT NULL COMMENT '直播平台房间url',
  `avatar` text NOT NULL COMMENT '头像图片的路径',
  `lasttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次登录时间',
  `lastip` varchar(24) NOT NULL COMMENT '最后一次登录IP',
  `regtime` datetime NOT NULL COMMENT '注册时间',
  `onlinestatus` int(2) NOT NULL COMMENT '在线状态',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `idcard` (`idcard`,`tel`,`calling_card_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
