-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-03-31 16:28:43
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
-- 表的结构 `ta_article`
--

CREATE TABLE IF NOT EXISTS `ta_article` (
`id` int(10) unsigned NOT NULL COMMENT '主键',
  `aa` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '松岛枫',
  `title_style` varchar(40) NOT NULL DEFAULT '' COMMENT '样式',
  `thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `catidid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目栏目',
  `djfij` varchar(20) NOT NULL DEFAULT '' COMMENT '的分解',
  `ffegeg` varchar(40) NOT NULL DEFAULT '' COMMENT '但是风格',
  `bb` int(11) unsigned NOT NULL,
  `eeg` decimal(10,3) unsigned NOT NULL DEFAULT '2.000' COMMENT '二哥五个',
  `gehhht` int(10) unsigned NOT NULL DEFAULT '25' COMMENT '飞哥哥'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文章模型' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ta_article`
--

INSERT INTO `ta_article` (`id`, `aa`, `title`, `title_style`, `thumb`, `catidid`, `djfij`, `ffegeg`, `bb`, `eeg`, `gehhht`) VALUES
(1, '', '', '', '', 0, '', '', 0, '2.000', 25);

-- --------------------------------------------------------

--
-- 表的结构 `ta_auth_group`
--

CREATE TABLE IF NOT EXISTS `ta_auth_group` (
`id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  `title` char(255) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `remark` varchar(100) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态',
  `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则","隔开'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ta_auth_group`
--

INSERT INTO `ta_auth_group` (`id`, `title`, `remark`, `status`, `rules`) VALUES
(1, 'A_G_T_1', 'A_G_R_1', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75'),
(2, 'A_G_T_2', 'A_G_R_2', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,82,83,84,85,86,87,88'),
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
(2, 2),
(6, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则表' AUTO_INCREMENT=89 ;

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
(28, 2, 'Siteset/ospro', 'R_SITESET_OSPRO', 1, 1, 0, ''),
(29, 2, 'Siteset/osemail', 'R_SITESET_OSEMAIL', 1, 1, 0, ''),
(30, 2, 'Siteset/attach', 'R_SITESET_ATTACH', 1, 1, 0, ''),
(31, 2, 'Siteset/user', 'R_SITESET_USER', 1, 1, 0, ''),
(32, 2, 'Siteset/addvar', 'R_SITESET_ADDVAR', 1, 1, 0, ''),
(33, 2, 'Lang/index', 'R_LANG_INDEX', 1, 1, 0, ''),
(34, 2, 'Lang/add', 'R_LANG_ADD', 1, 1, 0, ''),
(35, 2, 'Lang/status', 'R_LANG_STATUS', 1, 1, 0, ''),
(36, 2, 'Lang/edit', 'R_LANG_EDIT', 1, 1, 0, ''),
(37, 2, 'Lang/del', 'R_LANG_DEL', 1, 1, 0, ''),
(38, 2, 'Lang/order', 'R_LANG_ORDER', 1, 1, 0, ''),
(39, 2, 'Lang/set', 'R_LANG_SET', 1, 1, 0, ''),
(40, 2, 'Siteset/del', 'R_SITESET_DEL', 1, 1, 0, ''),
(41, 2, 'Urlrule/index', 'R_URLRULE_INDEX', 1, 1, 0, ''),
(42, 2, 'Urlrule/add', 'R_URLRULE_ADD', 1, 1, 0, ''),
(43, 2, 'Urlrule/edit', 'R_URLRULE_EDIT', 1, 1, 0, ''),
(44, 2, 'Urlrule/del', 'R_URLRULE_DEL', 1, 1, 0, ''),
(45, 2, 'Posid/index', 'R_POSID_INDEX', 1, 1, 0, ''),
(46, 2, 'Posid/add', 'R_POSID_ADD', 1, 1, 0, ''),
(47, 2, 'Posid/edit', 'R_POSID_EDIT', 1, 1, 0, ''),
(48, 2, 'Posid/del', 'R_POSID_DEL', 1, 1, 0, ''),
(49, 2, 'Dbsource/index', 'R_DBSOURCE_INDEX', 1, 1, 0, ''),
(50, 2, 'Database/index', 'R_DATABASE_INDEX', 1, 1, 0, ''),
(51, 2, 'Type/index', 'R_TYPE_INDEX', 1, 1, 0, ''),
(52, 2, 'Database/repair', 'R_DATABASE_REPAIR', 1, 1, 0, ''),
(53, 2, 'Database/optimize', 'R_DATABASE_OPTIMIZE', 1, 1, 0, ''),
(54, 2, 'Database/check', 'R_DATABASE_CHECK', 1, 1, 0, ''),
(55, 2, 'Database/analyze', 'R_DATABASE_ANALYZE', 1, 1, 0, ''),
(56, 2, 'Database/structure', 'R_DATABASE_STRUCTURE', 1, 1, 0, ''),
(57, 2, 'Database/backup', 'R_DATABASE_BACKUP', 1, 1, 0, ''),
(58, 2, 'Database/sql', 'R_DATABASE_SQL', 1, 1, 0, ''),
(59, 2, 'Database/recover', 'R_DATABASE_RECOVER', 1, 1, 0, ''),
(60, 2, 'Database/download', 'R_DATABASE_DOWNLOAD', 1, 1, 0, ''),
(61, 2, 'Database/del', 'R_DATABASE_DEL', 1, 1, 0, ''),
(62, 2, 'Database/import', 'R_DATABASE_IMPORT', 1, 1, 0, ''),
(63, 2, 'Dbsource/add', 'R_DBSOURCE_ADD', 1, 1, 0, ''),
(64, 2, 'Dbsource/edit', 'R_DBSOURCE_EDIT', 1, 1, 0, ''),
(65, 2, 'Dbsource/del', 'R_DBSOURCE_DEL', 1, 1, 0, ''),
(66, 2, 'Type/add', 'R_TYPE_ADD', 1, 1, 0, ''),
(67, 2, 'Type/status', 'R_TYPE_STATUS', 1, 1, 0, ''),
(68, 2, 'Type/edit', 'R_TYPE_EDIT', 1, 1, 0, ''),
(69, 2, 'Type/del', 'R_TYPE_DEL', 1, 1, 0, ''),
(70, 2, 'Type/order', 'R_TYPE_ORDER', 1, 1, 0, ''),
(71, 3, 'Category/index', 'R_CATEGORY_INDEX', 1, 1, 0, ''),
(72, 3, 'Category/add', 'R_CATEGORY_ADD', 1, 1, 0, ''),
(73, 3, 'Category/edit', 'R_CATEGORY_EDIT', 1, 1, 0, ''),
(74, 3, 'Category/del', 'R_CATEGORY_DEL', 1, 1, 0, ''),
(75, 3, 'Category/order', 'R_CATEGORY_ORDER', 1, 1, 0, ''),
(76, 3, 'Module/index', 'R_MODULE_INDEX', 1, 1, 0, ''),
(77, 3, 'Module/add', 'R_MODULE_ADD', 1, 1, 0, ''),
(78, 3, 'Module/edit', 'R_MODULE_EDIT', 1, 1, 0, ''),
(79, 3, 'Module/del', 'R_MODULE_DEL', 1, 1, 0, ''),
(80, 4, 'Page/index', 'R_PAGE_INDEX', 1, 1, 0, ''),
(81, 3, 'Article/index', 'R_ARTICLE_INDEX', 1, 1, 0, ''),
(82, 3, 'Module/status', 'R_MODULE_STATUS', 1, 1, 0, ''),
(83, 3, 'Field/index', 'R_FIELD_INDEX', 1, 1, 0, ''),
(84, 3, 'Field/order', 'R_FIELD_ORDER', 1, 1, 0, ''),
(85, 3, 'Field/status', 'R_FIELD_STATUS', 1, 1, 0, ''),
(86, 3, 'Field/add', 'R_FIELD_ADD', 1, 1, 0, ''),
(87, 3, 'Field/del', 'R_FIELD_DEL', 1, 1, 0, ''),
(88, 3, 'Field/edit', 'R_FIELD_EDIT', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `ta_category`
--

CREATE TABLE IF NOT EXISTS `ta_category` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `dir` varchar(30) NOT NULL DEFAULT '' COMMENT '目录',
  `pdir` varchar(50) NOT NULL DEFAULT '' COMMENT '上级目录',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `module` char(24) NOT NULL DEFAULT '' COMMENT '模型',
  `apid` varchar(255) NOT NULL DEFAULT '' COMMENT '所有父级ID',
  `acid` varchar(255) NOT NULL DEFAULT '' COMMENT '所有子级ID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否生成html',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为导航',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有子级',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '外部链接地址',
  `template_list` varchar(20) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_show` varchar(20) NOT NULL DEFAULT '' COMMENT '内容页模板',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '分页条数',
  `readgroup` varchar(100) NOT NULL DEFAULT '' COMMENT '访问权限',
  `listtype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为封面栏目',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '语言',
  `urlruleid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT 'URL规则'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `ta_content`
--

CREATE TABLE IF NOT EXISTS `ta_content` (
`id` int(11) unsigned NOT NULL COMMENT '主键',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `title_style` varchar(40) NOT NULL DEFAULT '' COMMENT '标题样式',
  `keywords` varchar(120) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `posid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '链接',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '语言',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许评论',
  `template` varchar(30) NOT NULL DEFAULT '' COMMENT '模板'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ta_dbsource`
--

CREATE TABLE IF NOT EXISTS `ta_dbsource` (
`id` int(10) unsigned NOT NULL COMMENT '主键',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '数据源名称',
  `host` varchar(20) NOT NULL DEFAULT '' COMMENT '数据库地址',
  `port` int(5) NOT NULL DEFAULT '3306' COMMENT '数据库端口',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '数据库帐号',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '数据库密码',
  `dbname` varchar(50) NOT NULL DEFAULT '' COMMENT '数据库名称',
  `dbtablepre` varchar(30) NOT NULL DEFAULT '' COMMENT '数据库表前缀'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='数据源' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `ta_field`
--

CREATE TABLE IF NOT EXISTS `ta_field` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `field` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '字段别名',
  `tips` varchar(150) NOT NULL DEFAULT '' COMMENT '提示信息',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `minlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '允许最小字符数',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '允许最大字符数',
  `pattern` varchar(20) NOT NULL DEFAULT '' COMMENT '验证规则',
  `regex` varchar(20) NOT NULL DEFAULT '' COMMENT '自定义规则样式',
  `errormsg` varchar(255) NOT NULL DEFAULT '' COMMENT '错误信息',
  `class` varchar(20) NOT NULL DEFAULT '' COMMENT '字段class样式',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '字段类型',
  `setup` mediumtext NOT NULL COMMENT '字段相关设置',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统字段'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='字段' AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `ta_field`
--

INSERT INTO `ta_field` (`id`, `mid`, `field`, `name`, `tips`, `required`, `minlength`, `maxlength`, `pattern`, `regex`, `errormsg`, `class`, `type`, `setup`, `listorder`, `status`, `issystem`) VALUES
(1, 4, 'createtime', 'PAGE_CREATETIME', '', 1, 0, 0, '', '', '', '', 'datetime', '', 0, 1, 1),
(2, 4, 'status', 'PAGE_STATUS', '', 1, 0, 0, '', '', '', '', 'radio', '', 0, 1, 1),
(3, 5, 'catid', 'ARTICLE_CATID', '', 1, 0, 0, '', '', '', '', 'catid', '', 0, 1, 1),
(4, 5, 'typeid', 'ARTICLE_TYPEID', '', 1, 0, 0, '', '', '', '', 'typeid', '', 0, 1, 1),
(5, 5, 'title', 'ARTICLE_TITLE', '', 1, 0, 0, '', '', '', '', 'title', '', 0, 1, 1),
(6, 5, 'keywords', 'ARTICLE_KEYWORDS', '', 0, 0, 0, '', '', '', '', 'text', '', 0, 1, 1),
(7, 5, 'description', 'ARTICLE_DESCRIPTION', '', 1, 0, 0, '', '', '', '', 'textarea', '', 0, 1, 0),
(8, 5, 'createtime', 'ARTICLE_CREATETIME', '', 1, 0, 0, '', '', '', '', 'datetime', '', 0, 0, 1),
(9, 5, 'recommend', 'ARTICLE_RECOMMEND', '', 1, 0, 0, '', '', '', '', 'radio', '', 0, 0, 1),
(10, 5, 'hits', 'ARTICLE_HITS', '', 1, 0, 0, '', '', '', '', 'number', '', 0, 1, 1),
(11, 5, 'posid', 'ARTICLE_POSID', '', 1, 0, 0, '', '', '', '', 'posid', '', 0, 1, 1),
(12, 5, 'template', 'ARTICLE_TEMPLATE', '', 1, 0, 0, '', '', '', '', 'template', '', 0, 1, 1),
(13, 5, 'status', 'ARTICLE_STATUS', '', 1, 0, 0, '', '', '', '', 'radio', '', 0, 1, 1),
(14, 5, 'dge', 'ARTICLE_DGE', 'ARTICLE_TIPS_DGE', 1, 0, 20, 'url', '', '大风暴', 'hfghgf', 'title', '{"thumb":"1","style":"1","size":"200","safefun":"dgh"}', 0, 0, 0),
(15, 5, 'geg', 'ARTICLE_GEG', 'ARTICLE_TIPS_GEG', 1, 2, 20, 'regex', 'dfgege', 'ARTICLE_ERRORMSG_GEG', 'sfgeg', 'title', '{"thumb":"1","style":"1","size":"200","safefun":"dfege"}', 0, 0, 0),
(16, 5, 'egeg', 'ARTICLE_EGEG', 'ARTICLE_TIPS_EGEG', 1, 2, 20, 'regex', 'degegeghrhjr', 'ARTICLE_ERRORMSG_EGEG', 'dsgfeg', 'title', '{"thumb":"1","style":"1","size":"200","safefun":"gfeghege"}', 0, 0, 0),
(17, 5, 'dfeg', 'ARTICLE_DFEG', 'ARTICLE_TIPS_DFEG', 1, 3, 45, 'regex', 'egegegeg', 'ARTICLE_ERRORMSG_DFEG', 'dgrghe', 'title', '{"thumb":"1","style":"1","size":"230","safefun":"feegfhrfh"}', 0, 0, 0),
(18, 5, 'dfdfe', 'ARTICLE_DFDFE', 'ARTICLE_TIPS_DFDFE', 1, 2, 200, 'url', '', 'ARTICLE_ERRORMSG_DFDFE', 'dfgegh', 'title', '{"thumb":"1","style":"1","size":"200","safefun":"dfeg"}', 0, 0, 0),
(19, 5, 'catidid', 'ARTICLE_CATIDID', 'ARTICLE_TIPS_CATIDID', 1, 0, 5, 'digits', '', 'ARTICLE_ERRORMSG_CATIDID', 'dgege', 'catid', '{"safefun":"dsfdfge"}', 0, 0, 0),
(20, 5, 'djfij', 'ARTICLE_DJFIJ', 'ARTICLE_TIPS_DJFIJ', 1, 6, 20, '', '', 'ARTICLE_ERRORMSG_DJFIJ', '', 'text', '{"size":"200","default":"\\u5927\\u98de\\u54e5\\u54e5\\u54e5","ispassword":"1","fieldtype":"varchar","safefun":"dgfeg"}', 0, 0, 0),
(21, 5, 'ffegeg', 'ARTICLE_FFEGEG', 'ARTICLE_TIPS_FFEGEG', 1, 6, 20, 'en_num', '', 'ARTICLE_ERRORMSG_FFEGEG', 'dgrhre', 'text', '{"size":"200","default":"\\u7684\\u98ce\\u683c","ispassword":"1","fieldtype":"varchar","safefun":"dgerh"}', 0, 0, 0),
(22, 5, 'eeg', 'ARTICLE_EEG', 'ARTICLE_TIPS_EEG', 1, 2, 10, 'url', '', 'ARTICLE_ERRORMSG_EEG', 'sdfwgf', 'number', '{"size":"200","numbertype":"1","decimaldigits":"5","default":"2","safefun":"sdgedgegwe"}', 0, 0, 0),
(24, 5, 'gehhht', 'ARTICLE_GEHHHT', '', 1, 0, 0, '', '', 'ARTICLE_ERRORMSG_GEHHHT', 'ddfefg', 'number', '{"size":"200","numbertype":"1","decimaldigits":"0","default":"25","safefun":""}', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ta_lang`
--

CREATE TABLE IF NOT EXISTS `ta_lang` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `name` varchar(20) NOT NULL COMMENT '语言名称',
  `value` varchar(5) NOT NULL COMMENT '语言简写值',
  `flag` varchar(30) NOT NULL DEFAULT '' COMMENT '国旗',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `listorder` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='多语言' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ta_lang`
--

INSERT INTO `ta_lang` (`id`, `name`, `value`, `flag`, `status`, `listorder`) VALUES
(1, '简体中文', 'zh-cn', '0px 0px', 1, 0),
(2, '繁體中文', 'zh-tw', '0px -12px', 1, 0),
(3, 'English', 'en-us', '0px -24px', 1, 0),
(4, '日本語', 'ja', '0px -48px', 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ta_member`
--

INSERT INTO `ta_member` (`id`, `password`, `username`, `realname`, `email`, `question`, `answer`, `status`, `regtime`, `login_ip`, `last_login_time`, `login_count`) VALUES
(1, '30bc103d85df152c8c703bcbbcc7fd4d', 'admin', '你买单我就来', 'itsky71@foxmail.com', '我还会回来的...', '灰太狼？呵呵。。。', 1, 1419068912, '127.0.0.1', 1425907232, 33),
(2, '30bc103d85df152c8c703bcbbcc7fd4d', 'itsky', '你地盘我做主', 'zmh0515005@163.com', '你是谁?', '呵呵...', 1, 1419587881, '127.0.0.1', 1427768982, 191),
(6, '30bc103d85df152c8c703bcbbcc7fd4d', 'yourphp', '111111', 'zmh0515005@163.me', '', '', 0, 1424952659, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ta_menu`
--

CREATE TABLE IF NOT EXISTS `ta_menu` (
`id` smallint(5) unsigned NOT NULL,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT '图标',
  `name` varchar(100) NOT NULL COMMENT '语言标识',
  `model` varchar(20) NOT NULL COMMENT '模块',
  `action` varchar(20) NOT NULL COMMENT '方法',
  `data` varchar(50) NOT NULL COMMENT '参数',
  `remark` varchar(100) NOT NULL COMMENT '备注',
  `isos` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '99' COMMENT '排序'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单' AUTO_INCREMENT=52 ;

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
(10, 5, 'glyphicon glyphicon-user', 'M_SITESET_USER', 'Siteset', 'user', '', '', 1, 1, 0),
(11, 5, 'glyphicon glyphicon-plus-sign', 'M_SITESET_ADDVAR', 'Siteset', 'addvar', '', '', 1, 1, 0),
(12, 4, '', 'M_POSID_INDEX', 'Posid', 'index', '', '', 1, 1, 0),
(13, 4, '', 'M_URLRULE_INDEX', 'Urlrule', 'index', '', '', 1, 1, 0),
(14, 4, '', 'M_DBSOURCE_INDEX', 'Dbsource', 'index', '', '', 1, 1, 99),
(15, 4, '', 'M_LANG_INDEX', 'Lang', 'index', '', '', 1, 1, 99),
(16, 4, '', 'M_TYPE_INDEX', 'Type', 'index', '', '', 1, 1, 99),
(17, 4, '', 'M_MENU_INDEX', 'Menu', 'index', '', '', 1, 1, 99),
(18, 0, 'glyphicon glyphicon-list-alt', 'M_CONTENT_INDEX', 'Content', 'index', '', '', 1, 1, 0),
(19, 18, '', 'M_CATEGORY_INDEX', 'Category', 'index', '', '', 1, 1, 0),
(20, 18, '', 'M_ARTICLE_INDEX', 'Article', 'index', '', '', 1, 1, 0),
(21, 18, '', 'M_PRODUCT_INDEX', 'Product', 'index', '', '', 1, 1, 0),
(22, 18, '', 'M_PICTURE_INDEX', 'Picture', 'index', '', '', 1, 1, 0),
(23, 18, '', 'M_DOWNLOAD_INDEX', 'Download', 'index', '', '', 1, 1, 0),
(24, 18, '', 'M_MODULE_INDEX_TYPE=1', 'Module', 'index', 'type=1', '', 1, 1, 99),
(25, 0, 'glyphicon glyphicon-th-large', 'M_MODULES_INDEX', 'Modules', 'index', '', '', 1, 1, 0),
(26, 25, '', 'M_MODULE_INDEX_TYPE=2', 'Module', 'index', 'type=2', '', 1, 1, 0),
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
(42, 39, '', 'M_SLIDE_INDEX', 'Slide', 'index', '', '', 1, 1, 0),
(43, 38, '', 'M_UPDATE_CACHE', 'Update', 'cache', '', '', 0, 1, 99),
(44, 38, '', 'M_UPDATE_INDEX', 'Update', 'index', '', '', 0, 1, 0),
(45, 38, '', 'M_UPDATE_LANG', 'Update', 'lang', '', '', 0, 1, 99),
(46, 38, '', 'M_UPDATE_COLHTML', 'Update', 'colhtml', '', '', 0, 1, 99),
(47, 38, '', 'M_UPDATE_CONHTML', 'Update', 'conhtml', '', '', 0, 1, 99),
(49, 4, '', 'M_DATABASE_INDEX', 'Database', 'index', '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ta_module`
--

CREATE TABLE IF NOT EXISTS `ta_module` (
`id` tinyint(3) unsigned NOT NULL COMMENT '主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统模型',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模型' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ta_module`
--

INSERT INTO `ta_module` (`id`, `title`, `name`, `description`, `type`, `issystem`, `status`) VALUES
(4, 'PAGE_TITLE', 'Page', 'PAGE_DESCRIPTION', 2, 1, 1),
(5, 'ARTICLE_TITLE', 'Article', 'ARTICLE_DESCRIPTION', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ta_page`
--

CREATE TABLE IF NOT EXISTS `ta_page` (
`id` int(10) unsigned NOT NULL COMMENT '主键',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `url` varchar(60) NOT NULL DEFAULT '' COMMENT '链接',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '语言'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='單頁模型' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ta_posid`
--

CREATE TABLE IF NOT EXISTS `ta_posid` (
`id` tinyint(2) unsigned NOT NULL COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `listorder` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `lang` varchar(10) NOT NULL COMMENT '语言'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='推荐位' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ta_posid`
--

INSERT INTO `ta_posid` (`id`, `name`, `listorder`, `lang`) VALUES
(1, '首页推荐', 0, 'zh-cn'),
(2, '首页幻灯片', 0, 'zh-cn'),
(3, '推荐产品', 0, 'zh-cn'),
(4, '促销产品', 0, 'zh-cn');

-- --------------------------------------------------------

--
-- 表的结构 `ta_siteset`
--

CREATE TABLE IF NOT EXISTS `ta_siteset` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `varname` varchar(20) NOT NULL DEFAULT '' COMMENT '变量名',
  `info` varchar(50) NOT NULL DEFAULT '' COMMENT '说明',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '分组ID',
  `type` varchar(10) NOT NULL DEFAULT 'string' COMMENT '类型',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '语言',
  `value` text NOT NULL COMMENT '变量值',
  `sys` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统变量'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统参数' AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `ta_siteset`
--

INSERT INTO `ta_siteset` (`id`, `varname`, `info`, `groupid`, `type`, `lang`, `value`, `sys`) VALUES
(1, 'webname', '网站名称', 1, 'string', 'zh-cn', 'ITskyCMS内容管理系统', 1),
(2, 'weburl', '站点根网址', 1, 'string', 'zh-cn', 'http://www.itsky71.net', 1),
(4, 'powerby', '网站版权信息', 1, 'text', 'zh-cn', 'Copyright © 2014-2015 &lt;a href=&quot;#&quot; target=&quot;_blank&quot;&gt;ITskyCMS&lt;/a&gt;. &lt;a href=&quot;#&quot; target=&quot;_blank&quot;&gt;itsky71&lt;/a&gt; 版权所有', 1),
(5, 'default_theme', '模板默认风格', 1, 'string', 'zh-cn', 'default', 1),
(6, 'keywords', '站点默认关键字', 1, 'string', 'zh-cn', 'ITskyCMS', 1),
(7, 'description', '站点描述', 1, 'text', 'zh-cn', 'ITskyCMS 内容管理系统', 1),
(8, 'record', '网站备案号', 1, 'string', 'zh-cn', '', 1),
(3, 'indexurl', '网页主页链接', 1, 'string', 'zh-cn', '/', 1),
(9, 'page_rows', '列表分页数', 2, 'number', 'zh-cn', '15', 1),
(10, 'url_model', 'URL访问模式', 2, 'select', 'zh-cn', '普通模式|0|default\r\nPATHINFO 模式|1\r\nREWRITE  模式|2\r\n兼容模式|3', 1),
(11, 'url_rule', 'URL规则', 2, 'select', 'zh-cn', '1', 1),
(12, 'url_html_suffix', 'URL伪静态后缀', 2, 'string', 'zh-cn', 'html', 1),
(13, 'tmpl_cache_on', '模板编译缓存', 2, 'bool', 'zh-cn', '1', 1),
(14, 'tmpl_cache_time', '模板缓存有效期', 2, 'number', 'zh-cn', '0', 1),
(15, 'html_cache_on', '静态缓存', 2, 'bool', 'zh-cn', '1', 1),
(16, 'html_cache_time', '缓存有效期', 2, 'number', 'zh-cn', '3600', 1),
(17, 'html_file_suffix', '静态文件后缀', 2, 'string', 'zh-cn', '.html', 1),
(18, 'cookie_domain', '跨域共享cookie的域名(例如: .itsky.net)', 2, 'string', 'zh-cn', '', 1),
(19, 'cookie_path', 'cookie路径', 2, 'string', 'zh-cn', '', 1),
(21, 'default_lang', '默认语言', 2, 'select', 'zh-cn', '简体中文|zh-cn|default\r\n繁體中文|zh-tw\r\nEnglish|en-us\r\n日本語|ja', 1),
(20, 'cookie_encode', 'cookie加密码', 2, 'string', 'zh-cn', 'KxZ06ual', 1),
(22, 'mail_type', '邮件发送模式', 3, 'radio', 'zh-cn', 'SMTP 函数发送|1|default\r\nmail 模块发送|2\r\nsendmail|3', 1),
(23, 'mail_server', '邮件服务器', 3, 'string', 'zh-cn', 'smtp.qq.com', 1),
(24, 'mail_port', '邮件发送端口', 3, 'number', 'zh-cn', '25', 1),
(25, 'mail_from', '发件人地址', 3, 'string', 'zh-cn', 'itsky71@foxmail.com', 1),
(26, 'mail_auth', 'AUTH 验证', 3, 'bool', 'zh-cn', '1', 1),
(27, 'mail_user', '发件人用户名', 3, 'string', 'zh-cn', 'ITskyCMS', 1),
(28, 'mail_password', '发件箱密码', 3, 'string', 'zh-cn', 'jingfing008-', 1),
(29, 'mail_to', '邮件设置测试', 3, 'string', 'zh-cn', '', 1),
(30, 'attach_maxsize', '允许上传附件大小', 4, 'number', 'zh-cn', '2048', 1),
(32, 'watermark_type', '水印类型', 4, 'select', 'zh-cn', '无水印|0|default\r\n图片水印|1\r\n文字水印|2', 1),
(31, 'attach_allowext', '允许上传附件类型', 4, 'string', 'zh-cn', 'jpg,jpeg,gif,png,doc,docx,rar,zip,swf,php', 1),
(38, 'watermark_img', '水印图片', 4, 'string', 'zh-cn', '/Public/img/mark.png', 1),
(39, 'watermark_pct', '水印透明度', 4, 'number', 'zh-cn', '80', 1),
(40, 'watermark_quality', '水印质量', 4, 'number', 'zh-cn', '100', 1),
(41, 'watermark_pospad', '水印边距', 4, 'number', 'zh-cn', '10', 1),
(42, 'watermark_pos', '水印位置', 4, 'radio', 'zh-cn', '随机位置|0\r\n顶部居左|1\r\n顶部居中|2\r\n顶部居右|3\r\n左部居左|4\r\n左部居中|5\r\n左部居右|6\r\n底部居左|7\r\n底部居中|8\r\n底部居右|9|default', 1),
(33, 'watemard_text', '水印文字内容', 4, 'string', 'zh-cn', 'ITskyCMS', 1),
(34, 'watemard_text_size', '文字大小', 4, 'string', 'zh-cn', '20', 1),
(35, 'watemard_text_color', '文字颜色', 4, 'string', 'zh-cn', '#FFFFFF', 1),
(36, 'watemard_text_face', '字体', 4, 'string', 'zh-cn', 'elephant.ttf', 1),
(37, 'watermark_min', '水印添加条件', 4, 'string', 'zh-cn', '300,300', 1),
(43, 'user_register', '新会员注册', 5, 'bool', 'zh-cn', '1', 1),
(44, 'member_emailcheck', '新会员注册邮件验证', 5, 'bool', 'zh-cn', '1', 1),
(45, 'member_registecheck', '新会员注册审核', 5, 'bool', 'zh-cn', '1', 1),
(46, 'member_login_verify', '注册登陆验证码', 5, 'bool', 'zh-cn', '1', 1),
(47, 'member_emailchecktpl', '邮件认证模板', 5, 'text', 'zh-cn', '欢迎您注册成为yourphp用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}\r\n或者将网址复制到浏览器：{url}', 1),
(48, 'member_getpwdemaitpl', '密码找回邮件模板', 5, 'text', 'zh-cn', '尊敬的用户{username}，请点击进入&lt;a href=&quot;{url}&quot;&gt;重置密码&lt;/a&gt;,\r\n或者将网址复制到浏览器：{url}（链接3天内有效）。&lt;br&gt;\r\n感谢您对本站的支持。&lt;br&gt;{sitename}&lt;br&gt;\r\n此邮件为系统自动邮件，无需回复。', 1),
(49, 'isuserbuy', '游客购物', 5, 'bool', 'zh-cn', '0', 1),
(50, 'use_address', '订单收货人地址必填', 5, 'bool', 'zh-cn', '1', 1),
(51, 'credit_exchange', '积分兑换', 5, 'number', 'zh-cn', '10', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ta_type`
--

CREATE TABLE IF NOT EXISTS `ta_type` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '简介',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `keyid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '顶级id',
  `lang` varchar(10) NOT NULL COMMENT '语言'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类别' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ta_type`
--

INSERT INTO `ta_type` (`id`, `pid`, `name`, `description`, `status`, `listorder`, `keyid`, `lang`) VALUES
(1, 0, '友情链接', '友情链接分类', 1, 0, 1, 'zh-cn'),
(2, 0, '反馈类别', '信息反馈类别', 1, 0, 2, 'zh-cn'),
(3, 1, '默认分类', '默认分类', 1, 0, 1, 'zh-cn'),
(4, 1, '合作伙伴', '合作伙伴', 1, 0, 1, 'zh-cn');

-- --------------------------------------------------------

--
-- 表的结构 `ta_urlrule`
--

CREATE TABLE IF NOT EXISTS `ta_urlrule` (
`id` smallint(5) unsigned NOT NULL COMMENT '主键',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否生成静态',
  `showurlrule` varchar(255) NOT NULL DEFAULT '' COMMENT '內容頁URL規則',
  `showexample` varchar(255) NOT NULL DEFAULT '' COMMENT '內容頁URL示例',
  `listurlrule` varchar(255) NOT NULL DEFAULT '' COMMENT '列表頁URL規則',
  `listexample` varchar(255) NOT NULL DEFAULT '' COMMENT '列表頁URL示例',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='URL规则' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ta_urlrule`
--

INSERT INTO `ta_urlrule` (`id`, `ishtml`, `showurlrule`, `showexample`, `listurlrule`, `listexample`, `listorder`) VALUES
(1, 1, '{$catdir}/show/{$id}.html|{$catdir}/show/{$id}_{$p}.html', 'news/show/1.html|news/show/1_1.html', '{$catdir}/|{$catdir}/{$p}.html', 'news/|news/1.html', 0),
(2, 0, 'show-{$catid}-{$id}.html|show-{$catid}-{$id}-{$p}.html', 'show-1-1.html|show-1-1-1.html', 'list-{$catid}.html|list-{$catid}-{$p}.html', 'list-1.html|list-1-1.html', 0),
(3, 0, '{$module}/show/{$id}.html|{$module}/show/{$id}-{$p}.html', 'Article/show/1.html|Article/show/1-1.html', '{$module}/list/{$catid}.html|{$module}/list/{$catid}-{$p}.html', 'Article/list/1.html|Article/list/1-1.html', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_article`
--
ALTER TABLE `ta_article`
 ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ta_category`
--
ALTER TABLE `ta_category`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`), ADD KEY `listorder` (`listorder`);

--
-- Indexes for table `ta_content`
--
ALTER TABLE `ta_content`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_dbsource`
--
ALTER TABLE `ta_dbsource`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_field`
--
ALTER TABLE `ta_field`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_lang`
--
ALTER TABLE `ta_lang`
 ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ta_module`
--
ALTER TABLE `ta_module`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_page`
--
ALTER TABLE `ta_page`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_posid`
--
ALTER TABLE `ta_posid`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_siteset`
--
ALTER TABLE `ta_siteset`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_type`
--
ALTER TABLE `ta_type`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`,`listorder`);

--
-- Indexes for table `ta_urlrule`
--
ALTER TABLE `ta_urlrule`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_article`
--
ALTER TABLE `ta_article`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ta_auth_group`
--
ALTER TABLE `ta_auth_group`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ta_auth_rule`
--
ALTER TABLE `ta_auth_rule`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `ta_category`
--
ALTER TABLE `ta_category`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ta_content`
--
ALTER TABLE `ta_content`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- AUTO_INCREMENT for table `ta_dbsource`
--
ALTER TABLE `ta_dbsource`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ta_field`
--
ALTER TABLE `ta_field`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `ta_lang`
--
ALTER TABLE `ta_lang`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ta_member`
--
ALTER TABLE `ta_member`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ta_menu`
--
ALTER TABLE `ta_menu`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `ta_module`
--
ALTER TABLE `ta_module`
MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ta_page`
--
ALTER TABLE `ta_page`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- AUTO_INCREMENT for table `ta_posid`
--
ALTER TABLE `ta_posid`
MODIFY `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ta_siteset`
--
ALTER TABLE `ta_siteset`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `ta_type`
--
ALTER TABLE `ta_type`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ta_urlrule`
--
ALTER TABLE `ta_urlrule`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
