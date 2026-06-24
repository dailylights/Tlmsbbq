-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2022-11-11 21:03:17
-- 服务器版本： 5.5.62-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrq_igelou_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `hy_cache`
--

CREATE TABLE `hy_cache` (
  `cachekey` varchar(255) NOT NULL,
  `expire` int(11) NOT NULL,
  `data` blob,
  `datacrc` int(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_chat`
--

CREATE TABLE `hy_chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid1` int(10) UNSIGNED NOT NULL,
  `uid2` int(10) UNSIGNED NOT NULL,
  `content` tinytext NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_chat_count`
--

CREATE TABLE `hy_chat_count` (
  `uid` int(10) UNSIGNED NOT NULL,
  `c` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_count`
--

CREATE TABLE `hy_count` (
  `name` varchar(12) NOT NULL,
  `v` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_file`
--

CREATE TABLE `hy_file` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '附件ID',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '附件主人UID',
  `filename` text NOT NULL COMMENT '附件名称',
  `md5name` text NOT NULL COMMENT '附件随机名',
  `filesize` int(10) UNSIGNED NOT NULL COMMENT '文件大小',
  `atime` int(10) UNSIGNED NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_filegold`
--

CREATE TABLE `hy_filegold` (
  `uid` int(10) UNSIGNED NOT NULL,
  `fileid` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_fileinfo`
--

CREATE TABLE `hy_fileinfo` (
  `fileid` int(10) UNSIGNED NOT NULL,
  `tid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `gold` int(10) UNSIGNED NOT NULL,
  `hide` tinyint(1) UNSIGNED NOT NULL,
  `downs` int(10) UNSIGNED NOT NULL,
  `mess` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_forum`
--

CREATE TABLE `hy_forum` (
  `id` int(10) UNSIGNED NOT NULL,
  `fid` int(10) NOT NULL DEFAULT '-1',
  `fgid` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(12) NOT NULL,
  `name2` varchar(18) NOT NULL,
  `threads` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `forumg` text NOT NULL,
  `json` text NOT NULL,
  `html` longtext NOT NULL,
  `color` varchar(30) NOT NULL,
  `background` varchar(30) NOT NULL,
  `btext` varchar(12) NOT NULL,
  `bontext` varchar(20) NOT NULL,
  `f1` varchar(50) NOT NULL,
  `f2` varchar(50) NOT NULL,
  `qq` char(12) NOT NULL,
  `bimg` text NOT NULL,
  `lg` text NOT NULL,
  `only` int(2) NOT NULL,
  `ti` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_forum`
--

INSERT INTO `hy_forum` (`id`, `fid`, `fgid`, `name`, `name2`, `threads`, `posts`, `forumg`, `json`, `html`, `color`, `background`, `btext`, `bontext`, `f1`, `f2`, `qq`, `bimg`, `lg`, `only`, `ti`) VALUES
(1, -1, 1, '芜湖奇瑞技工学校', 'zzjd', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, 1699706750);

-- --------------------------------------------------------

--
-- 表的结构 `hy_forum_group`
--

CREATE TABLE `hy_forum_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_friend`
--

CREATE TABLE `hy_friend` (
  `uid1` int(10) UNSIGNED NOT NULL,
  `uid2` int(10) UNSIGNED NOT NULL,
  `c` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `atime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_log`
--

CREATE TABLE `hy_log` (
  `uid` int(10) UNSIGNED NOT NULL,
  `gold` int(10) NOT NULL,
  `credits` int(10) UNSIGNED NOT NULL,
  `content` varchar(32) NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_online`
--

CREATE TABLE `hy_online` (
  `uid` int(10) UNSIGNED NOT NULL,
  `user` char(18) NOT NULL,
  `gid` int(10) UNSIGNED NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_online`
--

INSERT INTO `hy_online` (`uid`, `user`, `gid`, `atime`) VALUES
(244, 'admin', 1, 1668171545);

-- --------------------------------------------------------

--
-- 表的结构 `hy_post`
--

CREATE TABLE `hy_post` (
  `pid` int(10) UNSIGNED NOT NULL,
  `tid` int(10) UNSIGNED NOT NULL,
  `fid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `isthread` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL,
  `goods` int(10) UNSIGNED DEFAULT '0',
  `nos` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_post`
--

INSERT INTO `hy_post` (`pid`, `tid`, `fid`, `uid`, `isthread`, `content`, `atime`, `goods`, `nos`, `posts`) VALUES
(419, 393, 1, 1, 1, 'w', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `hy_thread`
--

CREATE TABLE `hy_thread` (
  `tid` int(10) UNSIGNED NOT NULL,
  `fid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT 'user_id',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` char(128) NOT NULL,
  `summary` text NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `btime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `buid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'view_size',
  `posts` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'post_size',
  `goods` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nos` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `img` text NOT NULL,
  `img_count` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `top` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `files` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '附件数量',
  `hide` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `gold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `niming` char(255) DEFAULT NULL,
  `biaobai` tinyint(1) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `lastdate` char(255) DEFAULT NULL,
  `xb` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_thread`
--

INSERT INTO `hy_thread` (`tid`, `fid`, `uid`, `pid`, `title`, `summary`, `atime`, `btime`, `buid`, `views`, `posts`, `goods`, `nos`, `img`, `img_count`, `top`, `files`, `hide`, `gold`, `state`, `niming`, `biaobai`, `content`, `lastdate`, `xb`) VALUES
(1, 1, 1, 0, 'w', 'w', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
(393, 1, 0, 419, 'w', '', 0, 0, 0, 1, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 'w', 1, 'w', '2019-05-01 21:18', 1);

-- --------------------------------------------------------

--
-- 表的结构 `hy_threadgold`
--

CREATE TABLE `hy_threadgold` (
  `uid` int(10) UNSIGNED NOT NULL,
  `tid` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_user`
--

CREATE TABLE `hy_user` (
  `uid` int(10) UNSIGNED NOT NULL,
  `user` varchar(18) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salt` varchar(8) NOT NULL,
  `threads` int(10) UNSIGNED NOT NULL,
  `posts` int(10) UNSIGNED NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL,
  `gid` smallint(2) UNSIGNED NOT NULL DEFAULT '0',
  `gold` int(10) NOT NULL DEFAULT '0' COMMENT '金钱',
  `credits` int(10) NOT NULL DEFAULT '0',
  `etime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ps` varchar(40) DEFAULT '',
  `fans` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `follow` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ctime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `file_size` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `chat_size` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_user`
--

INSERT INTO `hy_user` (`uid`, `user`, `pass`, `email`, `salt`, `threads`, `posts`, `atime`, `gid`, `gold`, `credits`, `etime`, `ps`, `fans`, `follow`, `ctime`, `file_size`, `chat_size`) VALUES
(244, 'admin', '3cd59b35a9e62f3d331475c48e846545', 'admin@qq.com', '4868d2f3', 0, 0, 1556716475, 1, 0, 0, 0, '', 0, 0, 1668169592, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `hy_usergroup`
--

CREATE TABLE `hy_usergroup` (
  `gid` int(10) UNSIGNED NOT NULL,
  `credits` int(11) NOT NULL DEFAULT '-1',
  `space_size` int(10) UNSIGNED DEFAULT '4294967295',
  `chat_size` int(10) UNSIGNED NOT NULL DEFAULT '4294967295',
  `name` varchar(12) NOT NULL,
  `json` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hy_usergroup`
--

INSERT INTO `hy_usergroup` (`gid`, `credits`, `space_size`, `chat_size`, `name`, `json`) VALUES
(1, -1, 1024, 4294967295, '管理员', '{\"thread\":1,\"post\":1,\"upload\":1,\"mess\":1,\"del\":1,\"down\":1,\"uploadfile\":1,\"hide\":1,\"thide\":1,\"tgold\":1,\"nogold\":0}'),
(2, -1, 1024, 4294967295, '普通用户', '{\"thread\":1,\"post\":1,\"upload\":1,\"mess\":1,\"del\":1,\"down\":1,\"uploadfile\":1,\"hide\":1,\"thide\":1,\"tgold\":1,\"nogold\":0}');

-- --------------------------------------------------------

--
-- 表的结构 `hy_vote_post`
--

CREATE TABLE `hy_vote_post` (
  `uid` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hy_vote_thread`
--

CREATE TABLE `hy_vote_thread` (
  `uid` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  `atime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hy_cache`
--
ALTER TABLE `hy_cache`
  ADD UNIQUE KEY `cachekey` (`cachekey`);

--
-- Indexes for table `hy_chat`
--
ALTER TABLE `hy_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid1` (`uid1`,`uid2`);

--
-- Indexes for table `hy_chat_count`
--
ALTER TABLE `hy_chat_count`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `hy_file`
--
ALTER TABLE `hy_file`
  ADD PRIMARY KEY (`id`,`uid`) USING BTREE;

--
-- Indexes for table `hy_filegold`
--
ALTER TABLE `hy_filegold`
  ADD PRIMARY KEY (`uid`,`fileid`) USING BTREE;

--
-- Indexes for table `hy_fileinfo`
--
ALTER TABLE `hy_fileinfo`
  ADD PRIMARY KEY (`fileid`) USING BTREE,
  ADD KEY `tid` (`tid`) USING BTREE,
  ADD KEY `uid` (`uid`) USING BTREE;

--
-- Indexes for table `hy_forum`
--
ALTER TABLE `hy_forum`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `hy_forum_group`
--
ALTER TABLE `hy_forum_group`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hy_friend`
--
ALTER TABLE `hy_friend`
  ADD PRIMARY KEY (`uid1`,`uid2`) USING BTREE,
  ADD KEY `uid2` (`uid2`,`state`) USING BTREE;

--
-- Indexes for table `hy_log`
--
ALTER TABLE `hy_log`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `hy_online`
--
ALTER TABLE `hy_online`
  ADD PRIMARY KEY (`uid`) USING BTREE;

--
-- Indexes for table `hy_post`
--
ALTER TABLE `hy_post`
  ADD PRIMARY KEY (`pid`) USING BTREE,
  ADD KEY `tid` (`tid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `hy_thread`
--
ALTER TABLE `hy_thread`
  ADD PRIMARY KEY (`tid`) USING BTREE,
  ADD KEY `uid` (`uid`),
  ADD KEY `fid` (`fid`),
  ADD KEY `top` (`top`),
  ADD KEY `posts` (`posts`),
  ADD KEY `btime` (`btime`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `hy_threadgold`
--
ALTER TABLE `hy_threadgold`
  ADD PRIMARY KEY (`uid`,`tid`) USING BTREE;

--
-- Indexes for table `hy_user`
--
ALTER TABLE `hy_user`
  ADD PRIMARY KEY (`uid`) USING BTREE,
  ADD UNIQUE KEY `user` (`user`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `gid` (`gid`);

--
-- Indexes for table `hy_usergroup`
--
ALTER TABLE `hy_usergroup`
  ADD PRIMARY KEY (`gid`) USING BTREE;

--
-- Indexes for table `hy_vote_post`
--
ALTER TABLE `hy_vote_post`
  ADD PRIMARY KEY (`uid`,`pid`) USING BTREE;

--
-- Indexes for table `hy_vote_thread`
--
ALTER TABLE `hy_vote_thread`
  ADD PRIMARY KEY (`uid`,`tid`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hy_chat`
--
ALTER TABLE `hy_chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- 使用表AUTO_INCREMENT `hy_file`
--
ALTER TABLE `hy_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '附件ID', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `hy_forum`
--
ALTER TABLE `hy_forum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- 使用表AUTO_INCREMENT `hy_forum_group`
--
ALTER TABLE `hy_forum_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `hy_post`
--
ALTER TABLE `hy_post`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;
--
-- 使用表AUTO_INCREMENT `hy_thread`
--
ALTER TABLE `hy_thread`
  MODIFY `tid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;
--
-- 使用表AUTO_INCREMENT `hy_user`
--
ALTER TABLE `hy_user`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
