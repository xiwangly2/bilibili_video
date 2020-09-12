-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020-02-06 19:37:21
-- 服务器版本： 5.5.62-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `momojx`
--

-- --------------------------------------------------------

--
-- 表的结构 `danmaku_ip`
--

CREATE TABLE IF NOT EXISTS `danmaku_ip` (
  `ip` varchar(12) NOT NULL COMMENT '发送弹幕的IP地址',
  `c` int(1) NOT NULL DEFAULT '1' COMMENT '规定时间内的发送次数',
  `time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `danmaku_ip`
--

INSERT INTO `danmaku_ip` (`ip`, `c`, `time`) VALUES
('182.129.28.1', 1, 1580987843);

-- --------------------------------------------------------

--
-- 表的结构 `danmaku_list`
--

CREATE TABLE IF NOT EXISTS `danmaku_list` (
  `id` varchar(32) NOT NULL COMMENT '弹幕池id',
  `cid` int(8) NOT NULL COMMENT '弹幕id',
  `type` varchar(8) NOT NULL COMMENT '弹幕类型',
  `text` varchar(128) NOT NULL COMMENT '弹幕内容',
  `color` varchar(20) NOT NULL COMMENT '弹幕颜色',
  `videotime` float(24,3) NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `danmaku_list`
--

INSERT INTO `danmaku_list` (`id`, `cid`, `type`, `text`, `color`, `videotime`, `time`) VALUES
('84fe19ce42e1c3f4e8c3ec2d76c8d2b3', 1, 'right', '1', 'rgb(254, 3, 2)', 11.282, 1580987843),
('84fe19ce42e1c3f4e8c3ec2d76c8d2b3', 2, 'right', '测试', 'rgb(255, 255, 255)', 24.639, 1580987966),
('84fe19ce42e1c3f4e8c3ec2d76c8d2b3', 3, 'right', '测试', 'rgb(254, 3, 2)', 46.535, 1580987988),
('84fe19ce42e1c3f4e8c3ec2d76c8d2b3', 4, 'right', '测试', 'rgb(254, 3, 2)', 63.294, 1580988005);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danmaku_ip`
--
ALTER TABLE `danmaku_ip`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `danmaku_list`
--
ALTER TABLE `danmaku_list`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danmaku_list`
--
ALTER TABLE `danmaku_list`
  MODIFY `cid` int(8) NOT NULL AUTO_INCREMENT COMMENT '弹幕id',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
