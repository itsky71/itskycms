-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-02-23 09:29:31
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
  `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则","隔开'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ta_auth_group`
--

INSERT INTO `ta_auth_group` (`id`, `title`, `remark`, `status`, `rules`) VALUES
(1, 'A_G_T_1', 'A_G_R_1', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44'),
(2, 'A_G_T_2', 'A_G_R_2', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44'),
(3, 'A_G_T_3', 'A_G_R_3', 0, '');

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
(5, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则表' AUTO_INCREMENT=45 ;

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
(44, 2, 'Urlrule/del', 'R_URLRULE_DEL', 1, 1, 0, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ta_member`
--

INSERT INTO `ta_member` (`id`, `password`, `username`, `realname`, `email`, `question`, `answer`, `status`, `regtime`, `login_ip`, `last_login_time`, `login_count`) VALUES
(1, '30bc103d85df152c8c703bcbbcc7fd4d', 'admin', '你买单我就来', 'itsky71@foxmail.com', '我还会回来的...', '灰太狼？呵呵。。。', 1, 1419068912, '127.0.0.1', 1421732415, 30),
(2, '30bc103d85df152c8c703bcbbcc7fd4d', 'itsky', '你地盘我做主', 'zmh0515005@163.com', '你是谁?', '呵呵...', 1, 1419587881, '127.0.0.1', 1424654930, 144),
(5, '30bc103d85df152c8c703bcbbcc7fd4d', 'zhongchonghua', '111111', 'fireloong@foxmail.com', '', '', 1, 1423140277, '', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单' AUTO_INCREMENT=49 ;

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
(42, 39, '', 'M_SLIDE_INDEX', 'Slide', 'index', '', '', 1, 1, 0),
(43, 38, '', 'M_UPDATE_CACHE', 'Update', 'cache', '', '', 0, 1, 99),
(44, 38, '', 'M_UPDATE_INDEX', 'Update', 'index', '', '', 0, 1, 0),
(45, 38, '', 'M_UPDATE_LANG', 'Update', 'lang', '', '', 0, 1, 99),
(46, 38, '', 'M_UPDATE_COLHTML', 'Update', 'colhtml', '', '', 0, 1, 99),
(47, 38, '', 'M_UPDATE_CONHTML', 'Update', 'conhtml', '', '', 0, 1, 99);

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
-- Indexes for table `ta_siteset`
--
ALTER TABLE `ta_siteset`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_urlrule`
--
ALTER TABLE `ta_urlrule`
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
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `ta_lang`
--
ALTER TABLE `ta_lang`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ta_member`
--
ALTER TABLE `ta_member`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ta_menu`
--
ALTER TABLE `ta_menu`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `ta_siteset`
--
ALTER TABLE `ta_siteset`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `ta_urlrule`
--
ALTER TABLE `ta_urlrule`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
