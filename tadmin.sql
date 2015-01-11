-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-01-11 12:47:49
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tadmin`
--

-- --------------------------------------------------------

--
-- 表的结构 `ta_auth_group`
--

CREATE TABLE IF NOT EXISTS `ta_auth_group` (
`id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  `title` char(255) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `remark` varchar(100) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则","隔开'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ta_auth_group`
--

INSERT INTO `ta_auth_group` (`id`, `title`, `remark`, `status`, `rules`) VALUES
(1, 'A_G_T_1', 'A_G_R_1', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26'),
(2, 'A_G_T_2', 'A_G_R_2', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27'),
(3, 'A_G_T_3', 'A_G_R_3', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `ta_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `ta_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

--
-- 转存表中的数据 `ta_auth_group_access`
--

INSERT INTO `ta_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ta_auth_rule`
--

CREATE TABLE IF NOT EXISTS `ta_auth_rule` (
`id` mediumint(8) unsigned NOT NULL COMMENT '主键',
  `tid` tinyint(2) unsigned NOT NULL COMMENT '分类编号',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '如果为1， condition字段就可以定义规则表达式',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则表' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `ta_auth_rule`
--

INSERT INTO `ta_auth_rule` (`id`, `tid`, `name`, `title`, `type`, `status`, `listorder`, `condition`) VALUES
(1, 1, 'Index/index', 'R_INDEX_INDEX', 1, 1, 0, ''),
(2, 1, 'Index/profile', 'R_INDEX_PROFILE', 1, 1, 0, ''),
(3, 2, 'Menu/index', 'R_MENU_INDEX', 1, 1, 0, ''),
(4, 2, 'Menu/add', 'R_MENU_ADD', 1, 1, 2, ''),
(5, 2, 'Menu/edit', 'R_MENU_EDIT', 1, 1, 2, ''),
(6, 2, 'Menu/del', 'R_MENU_DEL', 1, 1, 2, ''),
(7, 2, 'Menu/order', 'R_MENU_ORDER', 1, 1, 0, ''),
(8, 2, 'Menu/status', 'R_MENU_STATUS', 1, 1, 1, ''),
(9, 5, 'Rule/index', 'R_RULE_INDEX', 1, 1, 0, ''),
(10, 5, 'Rule/order', 'R_RULE_ORDER', 1, 1, 0, ''),
(11, 5, 'Rule/status', 'R_RULE_STATUS', 1, 1, 0, ''),
(12, 5, 'Rule/add', 'R_RULE_ADD', 1, 1, 0, ''),
(13, 5, 'Rule/edit', 'R_RULE_EDIT', 1, 1, 0, ''),
(14, 5, 'Rule/del', 'R_RULE_DEL', 1, 1, 0, ''),
(15, 5, 'Member/index', 'R_MEMBER_INDEX', 1, 1, 0, ''),
(17, 5, 'Member/add', 'R_MEMBER_ADD', 1, 1, 0, ''),
(16, 5, 'Member/status', 'R_MEMBER_STATUS', 1, 1, 0, ''),
(18, 5, 'Member/edit', 'R_MEMBER_EDIT', 1, 1, 0, ''),
(19, 5, 'Member/del', 'R_MEMBER_DEL', 1, 1, 0, ''),
(21, 6, 'Update/index', 'R_UPDATE_INDEX', 1, 1, 0, ''),
(20, 5, 'Group/index', 'R_GROUP_INDEX', 1, 1, 0, ''),
(22, 5, 'Group/add', 'R_GROUP_ADD', 1, 1, 1, ''),
(23, 5, 'Group/status', 'R_GROUP_STATUS', 1, 1, 0, ''),
(24, 5, 'Group/edit', 'R_GROUP_EDIT', 1, 1, 1, ''),
(25, 5, 'Group/del', 'R_GROUP_DEL', 1, 1, 1, ''),
(26, 5, 'Group/access', 'R_GROUP_ACCESS', 1, 1, 1, ''),
(27, 2, 'Siteset/index', 'R_SITESET_INDEX', 1, 1, 0, ''),
(28, 2, 'Siteset/ospro', 'R_SITESET_OSPRO', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `ta_member`
--

CREATE TABLE IF NOT EXISTS `ta_member` (
`id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `realname` varchar(20) NOT NULL COMMENT '昵称',
  `email` varchar(80) NOT NULL COMMENT '用户邮箱',
  `question` varchar(30) NOT NULL COMMENT '安全问题',
  `answer` varchar(30) NOT NULL COMMENT '答案',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态',
  `regtime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `login_ip` char(15) NOT NULL COMMENT '登入IP',
  `last_login_time` int(10) unsigned NOT NULL COMMENT '最后登入时间戳',
  `login_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登入次数'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ta_member`
--

INSERT INTO `ta_member` (`id`, `password`, `username`, `realname`, `email`, `question`, `answer`, `status`, `regtime`, `login_ip`, `last_login_time`, `login_count`) VALUES
(1, '30bc103d85df152c8c703bcbbcc7fd4d', 'admin', '你买单我就来', 'itsky71@foxmail.com', '我还会回来的...', '灰太狼？呵呵。。。', 1, 1419068912, '127.0.0.1', 1420700102, 28),
(2, '30bc103d85df152c8c703bcbbcc7fd4d', 'itsky', '你地盘我做主', 'zmh0515005@163.com', '你是谁?', '呵呵...', 1, 1419587881, '127.0.0.1', 1420960724, 78);

-- --------------------------------------------------------

--
-- 表的结构 `ta_menu`
--

CREATE TABLE IF NOT EXISTS `ta_menu` (
`id` smallint(5) unsigned NOT NULL,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT '图标',
  `name` varchar(20) NOT NULL COMMENT '语言标识',
  `model` varchar(20) NOT NULL COMMENT '模块',
  `action` varchar(20) NOT NULL COMMENT '方法',
  `data` varchar(50) NOT NULL COMMENT '参数',
  `remark` varchar(100) NOT NULL COMMENT '备注',
  `isos` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '99' COMMENT '排序'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单' AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `ta_menu`
--

INSERT INTO `ta_menu` (`id`, `pid`, `icon`, `name`, `model`, `action`, `data`, `remark`, `isos`, `status`, `listorder`) VALUES
(1, 0, 'glyphicon glyphicon-dashboard', 'M_INDEX_INDEX', 'Index', 'index', '', '', 1, 1, 0),
(3, 1, 'glyphicon glyphicon-user', 'M_INDEX_PROFILE', 'Index', 'profile', '', '', 1, 1, 0),
(2, 1, 'glyphicon glyphicon-cog', 'M_INDEX_SET', 'Index', 'set', '', '', 1, 1, 0),
(4, 0, 'glyphicon glyphicon-cog', 'M_OSSET_INDEX', 'Osset', 'index', '', '', 1, 1, 0),
(5, 4, '', 'M_SITECONFIG_INDEX', 'Siteconfig', 'index', '', '', 1, 1, 0),
(6, 5, 'glyphicon glyphicon-eye-open', 'M_SITESET_INDEX', 'Siteset', 'index', '', '', 1, 1, 0),
(7, 5, 'glyphicon glyphicon-hdd', 'M_SITESET_OSPRO', 'Siteset', 'ospro', '', '', 1, 1, 0),
(8, 5, 'glyphicon glyphicon-envelope', 'M_SITESET_OSEMAIL', 'Siteset', 'osemail', '', '', 1, 1, 0),
(9, 5, 'glyphicon glyphicon-floppy-disk', 'M_SITESET_ATTACH', 'Siteset', 'attach', '', '', 1, 1, 0),
(10, 5, 'glyphicon glyphicon-user', 'M_SITESET_MEMBER', 'Siteset', 'member', '', '', 1, 1, 0),
(11, 5, 'glyphicon glyphicon-plus-sign', 'M_SITESET_ADDVAR', 'Siteset', 'addvar', '', '', 1, 1, 0),
(12, 4, '', 'M_POSID_INDEX', 'Posid', 'index', '', '', 1, 1, 0),
(13, 4, '', 'M_URLRULE_INDEX', 'Urlrule', 'index', '', '', 1, 1, 0),
(14, 4, '', 'M_DBSOURCE_INDEX', 'Dbsource', 'index', '', '', 1, 1, 0),
(15, 4, '', 'M_LANG_INDEX', 'Lang', 'index', '', '', 1, 1, 0),
(16, 4, '', 'M_TYPE_INDEX', 'Type', 'index', '', '', 1, 1, 0),
(17, 4, '', 'M_MENU_INDEX', 'Menu', 'index', '', '', 1, 1, 0),
(18, 0, 'glyphicon glyphicon-list-alt', 'M_CONTENT_INDEX', 'Content', 'index', '', '', 1, 1, 0),
(19, 18, '', 'M_CATEGORY_INDEX', 'Category', 'index', '', '', 1, 1, 0),
(20, 18, '', 'M_ARTICLE_INDEX', 'Article', 'index', '', '', 1, 1, 0),
(21, 18, '', 'M_PRODUCT_INDEX', 'Product', 'index', '', '', 1, 1, 0),
(22, 18, '', 'M_PICTURE_INDEX', 'Picture', 'index', '', '', 1, 1, 0),
(23, 18, '', 'M_DOWNLOAD_INDEX', 'Download', 'index', '', '', 1, 1, 0),
(24, 18, '', 'M_MODEL_INDEX', 'Model', 'index', '', '', 1, 1, 0),
(25, 0, 'glyphicon glyphicon-th-large', 'M_MODULES_INDEX', 'Modules', 'index', '', '', 1, 1, 0),
(26, 25, '', 'M_MODULE_INDEX', 'Module', 'index', '', '', 1, 1, 0),
(27, 25, '', 'M_LINK_INDEX', 'Link', 'index', '', '', 1, 1, 0),
(28, 25, '', 'M_KEFU_INDEX', 'Kefu', 'index', '', '', 1, 1, 0),
(29, 25, '', 'M_ORDER_INDEX', 'Order', 'index', '', '', 1, 1, 0),
(30, 25, '', 'M_PAYMENT_INDEX', 'Payment', 'index', '', '', 1, 1, 0),
(31, 25, '', 'M_PAY_INDEX', 'Pay', 'index', '', '', 1, 1, 0),
(32, 25, '', 'M_FEEDBACK_INDEX', 'Feedback', 'index', '', '', 1, 1, 0),
(33, 25, '', 'M_GUESTBOOK_INDEX', 'Guestbook', 'index', '', '', 1, 1, 0),
(34, 0, 'glyphicon glyphicon-user', 'M_USER_INDEX', 'User', 'index', '', '', 1, 1, 0),
(35, 34, '', 'M_MEMBER_INDEX', 'Member', 'index', '', '', 1, 1, 0),
(36, 34, '', 'M_GROUP_INDEX', 'Group', 'index', '', '', 1, 1, 0),
(37, 34, '', 'M_RULE_INDEX', 'Rule', 'index', '', '', 1, 1, 0),
(38, 0, 'glyphicon glyphicon-refresh', 'M_UPDATES_INDEX', 'Updates', 'index', '', '', 1, 1, 0),
(39, 0, 'glyphicon glyphicon-file', 'M_TPL_INDEX', 'Tpl', 'index', '', '', 1, 1, 0),
(40, 39, '', 'M_TEMPLET_INDEX', 'Templet', 'index', '', '', 1, 1, 0),
(41, 39, '', 'M_BLOCK_INDEX', 'Block', 'index', '', '', 1, 1, 0),
(42, 39, '', 'M_SLIDE_INDEX', 'Slide', 'index', '', '空间看工人', 1, 1, 0),
(43, 38, '', 'M_UPDATE_CACHE', 'Update', 'cache', '', '', 0, 1, 99),
(44, 38, '', 'M_UPDATE_INDEX', 'Update', 'index', '', '', 0, 1, 0),
(45, 38, '', 'M_UPDATE_LANG', 'Update', 'lang', '', '', 0, 1, 99),
(46, 38, '', 'M_UPDATE_COLHTML', 'Update', 'colhtml', '', '', 0, 1, 99),
(47, 38, '', 'M_UPDATE_CONHTML', 'Update', 'conhtml', '', '', 0, 1, 99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_auth_group`
--
ALTER TABLE `ta_auth_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_auth_group_access`
--
ALTER TABLE `ta_auth_group_access`
 ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`), ADD KEY `uid` (`uid`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `ta_auth_rule`
--
ALTER TABLE `ta_auth_rule`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ta_member`
--
ALTER TABLE `ta_member`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_menu`
--
ALTER TABLE `ta_menu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_auth_group`
--
ALTER TABLE `ta_auth_group`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ta_auth_rule`
--
ALTER TABLE `ta_auth_rule`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ta_member`
--
ALTER TABLE `ta_member`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ta_menu`
--
ALTER TABLE `ta_menu`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
