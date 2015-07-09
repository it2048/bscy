-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2015 年 07 月 09 日 23:07
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `baisheng`
--

-- --------------------------------------------------------

--
-- 表的结构 `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('默认角色', 'cdu220', NULL, 'N;');

-- --------------------------------------------------------

--
-- 表的结构 `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admincontentcontroller-index', 0, NULL, NULL, NULL),
('admincontentcontroller-logout', 0, NULL, NULL, NULL),
('admincontentcontroller-usernewpass', 0, NULL, NULL, NULL),
('default', 1, '默认权限', '', ''),
('默认角色', 2, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('default', 'admincontentcontroller-index'),
('default', 'admincontentcontroller-logout'),
('default', 'admincontentcontroller-usernewpass'),
('默认角色', 'default');

-- --------------------------------------------------------

--
-- 表的结构 `bs_admin`
--

CREATE TABLE IF NOT EXISTS `bs_admin` (
  `username` varchar(128) NOT NULL COMMENT '用户名',
  `tel` varchar(64) DEFAULT NULL COMMENT '电话',
  `name` varchar(45) DEFAULT NULL COMMENT '用户名',
  `dep_name` varchar(45) DEFAULT NULL COMMENT '部门名',
  `type` int(11) NOT NULL COMMENT '1，2，3办公室，餐厅',
  `ct_name` varchar(128) DEFAULT NULL COMMENT '餐厅名',
  `dh_name` varchar(16) DEFAULT NULL COMMENT '店号',
  `ct_boss` varchar(16) DEFAULT NULL COMMENT '餐厅boss',
  `desc` text COMMENT '杂项',
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bs_admin`
--

INSERT INTO `bs_admin` (`username`, `tel`, `name`, `dep_name`, `type`, `ct_name`, `dh_name`, `ct_boss`, `desc`) VALUES
('admin', '85319487/85319467', '', '', 0, '', '', '', '\r\n');

-- --------------------------------------------------------

--
-- 表的结构 `bs_money`
--

CREATE TABLE IF NOT EXISTS `bs_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `cb_id` varchar(16) NOT NULL,
  `yg_id` varchar(16) NOT NULL,
  `yg_name` varchar(32) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='薪酬表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `bs_money`
--

INSERT INTO `bs_money` (`id`, `type`, `month`, `cb_id`, `yg_id`, `yg_name`, `desc`) VALUES
(1, 2, 201507, '86012019', '100038396', '张静', '2680|0|0|0|0|0|0|0|0|0|0|0|0|0|2680|9.6|223.6|62.75|0|0|0|0|0|0|0|0|199|0|2185.05|0|0|0|0|2185.05|'),
(2, 2, 201507, '86012033', '100038286', '龚科鹰', '2660|0|0|0|0|0|332.5|0|0|0|0|0|0|0|2992.5|0|198.08|72.38|13.52|0|0|0|0|0|-13.52|0|173.32|0|2548.72|0|0|0|0|2548.72|'),
(3, 2, 201507, '86012034', '100035961', '魏婧', '2860|0|0|0|0|0|0|0|0|0|0|0|0|0|2860|0|228.8|57.2|14.3|0|0|0|0|0|-32.12|0|222|0|2369.82|0|0|0|0|2369.82|'),
(4, 2, 201507, '86012035', '100037195', '张璇', '2860|0|0|0|0|0|0|0|0|0|0|0|0|0|2860|0|228.8|57.2|14.3|0|0|0|0|0|-32.58|0|204|0|2388.28|0|0|0|0|2388.28|'),
(5, 2, 201507, '86012039', '100038741', '唐英', '2390|0|0|0|0|0|0|0|0|0|0|0|0|0|2390|0|196.08|61.38|10.78|0|0|0|0|0|0|0|152.53|0|1969.23|0|0|0|0|1969.23|'),
(6, 2, 201507, '86012039', '100038843', '谢春琴', '2400|0|0|0|0|0|0|0|0|0|0|0|0|0|2400|0|196.08|61.38|10.78|0|0|0|0|0|0|0|126.63|0|2005.13|0|0|0|0|2005.13|'),
(7, 1, 201507, '86012002', '100037174', '袁帮穗', '11.3|163.8|7|7.25|0|0|0|0|0|0|0|0|0|0|0|0|0|2093.95|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|2093.95|'),
(8, 1, 201507, '86012002', '100037345', '付晶', '11.3|128.38|5.75|4.75|0|0|0|0|0|0|0|0|0|0|0|0|0|1623.13|0|0|0|0|0|-23.82|0|0|11.91|47.64|130.72|114|0|0|0|1342.68|'),
(9, 1, 201507, '86012002', '100039958', '曹利娜', '13|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|1930.5|1930.5|0|0|0|0|0|-23.82|0|0|11.91|47.64|187.92|172|0|0|0|1534.85|'),
(10, 1, 201507, '86012002', '100242512', '李会芬', '11.3|195.65|9.25|4.75|114.15|0|0|12.13|0|0|0|0|0|0|0|0|0|2890.94|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|2890.94|');

-- --------------------------------------------------------

--
-- 表的结构 `bs_pwd`
--

CREATE TABLE IF NOT EXISTS `bs_pwd` (
  `username` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bs_pwd`
--

INSERT INTO `bs_pwd` (`username`, `password`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e');

--
-- 限制导出的表
--

--
-- 限制表 `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
