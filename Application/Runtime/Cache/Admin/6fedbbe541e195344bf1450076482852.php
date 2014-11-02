<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo L('PRO_NAME');?>-<?php echo L('BACKER_MANAGE');?></title>
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="/itskycms/Public/bootstrap/css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/bootstrap/css/bootstrap-theme.min.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/css/ace.min.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/css/ace-rtl.min.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/css/ace-skins.min.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/validator/jquery.validator.css" /><link rel="stylesheet" type="text/css" href="/itskycms/Public/css/admin_all.css" />
<script type="text/javascript" src="/itskycms/Public/js/jquery.min.js"></script><script type="text/javascript" src="/itskycms/Public/bootstrap/js/bootstrap.min.js"></script><script type="text/javascript" src="/itskycms/Public/js/ace.min.js"></script><script type="text/javascript" src="/itskycms/Public/js/ace-elements.min.js"></script><script type="text/javascript" src="/itskycms/Public/js/ace-extra.min.js"></script><script type="text/javascript" src="/itskycms/Public/validator/jquery.validator.js"></script><script type="text/javascript" src="/itskycms/Public/validator/local/<?php echo (LANG_SET); ?>.js"></script><script type="text/javascript" src="/itskycms/Public/js/admin_all.js"></script>

<script type="text/javascript">
    var ThinkPHP = {
        'ROOT' : '/itskycms',    //网站根目录地址
        'APP' : '/itskycms',  //当前应用（入口文件）地址
        'SELF' : '/itskycms/Admin/Index/index.html',    //当前URL地址
        'PUBLIC' : '/itskycms/Public',    //项目公共目录地址
        'MODULE' : '<?php echo (MODULE_NAME); ?>',  //当前模块名
        'CONTROLLER' : '<?php echo (CONTROLLER_NAME); ?>',  //当前控制器名
        'ACTION' : '<?php echo (ACTION_NAME); ?>'   //当前操作名
    };
</script>
</head>
<body id="<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>">


<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed');}catch(e){}
    </script>
    <div id="navbar-container" class="navbar-container">
        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="<?php echo U('Index/index');?>">
                <small><span class="glyphicon glyphicon-leaf"></span> <?php echo L('PRO_NAME'); echo L('BACKER_MANAGE');?></small>
            </a>
        </div>
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
<!--                <li class="grey">
                    <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-tasks"></span>
                        <span class="badge badge-grey">4</span>
                    </a>
                    <ul class="dropdown-navbar dropdown-menu dropdown-caret dropdown-close pull-right">
                        <li class="dropdown-header">
                            <span class="glyphicon glyphicon-ok"></span>
                            还有4个任务完成
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">软件更新</span>
                                    <span class="pull-right">60%</span>
                                </div>
                                <div class="progress progress-mini">
                                    <div class="progress-bar" style="width: 60%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">硬件更新</span>
                                    <span class="pull-right">35%</span>
                                </div>
                                <div class="progress progress-mini">
                                    <div class="progress-bar progress-bar-danger" style="width: 35%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">单元测试</span>
                                    <span class="pull-right">15%</span>
                                </div>
                                <div class="progress progress-mini">
                                    <div class="progress-bar progress-bar-warning" style="width: 15%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">错误修复</span>
                                    <span class="pull-right">90%</span>
                                </div>
                                <div class="progress progress-mini progress-striped active">
                                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                查看任务详情
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="purple">
                    <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-bell"></span>
                        <span class="badge badge-important">8</span>
                    </a>
                    <ul class="dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close pull-right">
                        <li class="dropdown-header">
                            <span class="glyphicon glyphicon-warning-sign"></span>
                            8条通知
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <span class="btn btn-xs no-hover btn-pink glyphicon glyphicon-comment"></span>
                                        新闻评论
                                    </span>
                                    <span class="badge badge-info pull-right">+12</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="btn btn-xs btn-primary glyphicon glyphicon-user"></span>
                                切换为编辑登录..
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <span class="btn btn-xs no-hover btn-success glyphicon glyphicon-shopping-cart"></span>
                                        新订单
                                    </span>
                                    <span class="badge badge-success pull-right">+8</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <span class="btn btn-xs no-hover btn-info glyphicon glyphicon-send"></span>
                                        粉丝
                                    </span>
                                    <span class="badge badge-info pull-right">+8</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                查看所有通知
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="green">
                    <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-envelope"></span>
                        <span class="badge badge-success">5</span>
                    </a>
                    <ul class="dropdown-navbar dropdown-menu dropdown-caret dropdown-close pull-right">
                        <li class="dropdown-header">
                            <span class="glyphicon glyphicon-envelope"></span>
                            5条消息
                        </li>
                        <li>
                            <a href="#">
                                <img class="msg-photo" alt="Alex's Avatar" src="/itskycms/Public/img/avatars/avatar.png"/>
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Alex:</span>
                                        不知道写些啥...
                                    </span>
                                    <span class="msg-time">
                                        <span class="glyphicon glyphicon-time"></span>
                                        <span>1分钟以前</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img class="msg-photo" alt="Alex's Avatar" src="/itskycms/Public/img/avatars/avatar1.png"/>
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Alex:</span>
                                        不知道写些啥...
                                    </span>
                                    <span class="msg-time">
                                        <span class="glyphicon glyphicon-time"></span>
                                        <span>20分钟以前</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img class="msg-photo" alt="Alex's Avatar" src="/itskycms/Public/img/avatars/avatar3.png"/>
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Alex:</span>
                                        不知道写些啥...
                                    </span>
                                    <span class="msg-time">
                                        <span class="glyphicon glyphicon-time"></span>
                                        <span>1小时以前</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                查看所有消息
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <li class="light-blue">
                    <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        <img class="nav-user-photo" alt="Jason's Photo" src="/itskycms/Public/img/avatars/user.jpg"/>
                        <span class="user-info">
                            <small><?php echo L('WELCOME');?>,</small><?php echo (session('uname')); ?>
                        </span>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-cog"></span><?php echo L('SET');?>
                            </a>
                        </li>
                        <li>
                            <a class="tarmain" href="<?php echo U('Index/profile');?>">
                                <span class="glyphicon glyphicon-user"></span><?php echo L('PROFILE');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo U('Public/logout');?>">
                                <span class="glyphicon glyphicon-off"></span><?php echo L('LOGOUT');?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="main-container" class="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed');}catch(e){}
    </script>
    <div class="main-container-inner">
        <a id="menu-toggler" class="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div id="sidebar" class="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed');}catch(e){}
            </script>
            <div id="sidebar-shortcuts" class="sidebar-shortcuts">
                <div id="sidebar-shortcuts-large" class="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <span class="glyphicon glyphicon-signal"></span>
                    </button>
                    <button class="btn btn-info">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-warning">
                        <span class="glyphicon glyphicon-tower"></span>
                    </button>
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-cog"></span>
                    </button>
                </div>
                <div id="sidebar-shortcuts-mini" class="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>
                    <span class="btn btn-info"></span>
                    <span class="btn btn-warning"></span>
                    <span class="btn btn-danger"></span>
                </div>
            </div>
            <ul class="nav nav-list">
                
                <li class="active">
                    <a class="noa" href="<?php echo U('Index/index');?>">
                        <span class="glyphicon glyphicon-dashboard"></span>
                        <span class="menu-text"><?php echo L('MENU_DASHBOARD');?></span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-toggle" href="javascript:;">
                        <span class="glyphicon glyphicon-cog"></span>
                        <span class="menu-text">系统设置</span>
                        <b class="arrow glyphicon glyphicon-chevron-down"></b>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="dropdown-toggle" href="javascript:;">
                                <span class="glyphicon glyphicon-chevron-right"></span> 站点配置
                                <b class="arrow glyphicon glyphicon-chevron-down"></b>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        SEO配置
                                    </a>
                                </li>
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-hdd"></span>
                                        系统参数
                                    </a>
                                </li>
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                        系统邮箱
                                    </a>
                                </li>
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-floppy-open"></span>
                                        附件配置
                                    </a>
                                </li>
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-user"></span>
                                        用户中心设置
                                    </a>
                                </li>
                                <li>
                                    <a class="tarmain" href="#">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                        添加系统变量
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 推荐位管理
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 数据库管理
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> URL规则
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> DB数据源
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 多语言管理
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 类别管理
                            </a>
                        </li>
                        <li>
                            <a class="tarmain" href="<?php echo U('Menu/index');?>">
                                <span class="glyphicon glyphicon-chevron-right"></span> 后台管理菜单
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle" href="javascript:;">
                        <span class="glyphicon glyphicon-magnet"></span>
                        <span class="menu-text">UI 组件</span>
                        <b class="arrow glyphicon glyphicon-chevron-down"></b>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 组件
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 按钮 & 图表
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-chevron-right"></span> 树菜单
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="javascript:;">
                                <span class="glyphicon glyphicon-chevron-right"></span> 三级列表
                                <b class="arrow glyphicon glyphicon-chevron-down"></b>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-leaf"></span> 第一级
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-adjust"></span> 第二级
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <span class="menu-text">
                            日历
                            <span class="badge badge-transparent tooltip-error" title="2个重要事件">
                                <span class="red bigger-130 glyphicon glyphicon-warning-sign"></span>
                            </span>
                        </span>
                    </a>
                </li>
                
            </ul>
            <div id="sidebar-collapse" class="sidebar-collapse">
                <span class="glyphicon glyphicon-backward" data-icon2="glyphicon glyphicon-forward" data-icon1="glyphicon glyphicon-backward"></span>
            </div>
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed');}catch(e){}
            </script>
        </div>
        <div class="main-content">
            <div id="breadcrumbs" class="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed');}catch(e){}
                </script>
                <ul class="breadcrumb">
                    <li>
                        <span class="glyphicon glyphicon-home"></span>
                        <a href="<?php echo U('Index/index');?>"><?php echo L('MENU_INDEX');?></a>
                    </li>
                    <li class="active"><?php echo L('MENU_DASHBOARD');?></li>
                </ul>
                <div id="nav-search" class="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input id="nav-search-input" class="nav-search-input" type="text" autocomplete="off" placeholder="Search ..."/>
                            <span class="glyphicon glyphicon-search nav-search-icon"></span>
                        </span>
                    </form>
                </div>
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1><?php echo L('MENU_DASHBOARD');?><small class="glyphicon glyphicon-chevron-right"> <?php echo L('MENU_LOOK');?></small></h1>
                </div>
                <div class="row">
                    <div id="new_content" class="col-xs-12">
                        
    <div class="row">
        <div class="col-sm-7 infobox-container">
            <div class="infobox infobox-green">
                <div class="infobox-icon"><span class="glyphicon glyphicon-file"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">3</span>
                    <div class="infobox-content">单页模型</div>
                </div>
            </div>
            <div class="infobox infobox-blue">
                <div class="infobox-icon"><span class="glyphicon glyphicon-list-alt"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">32</span>
                    <div class="infobox-content">文章模型</div>
                </div>
            </div>
            <div class="infobox infobox-pink">
                <div class="infobox-icon"><span class="glyphicon glyphicon-gift"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">17</span>
                    <div class="infobox-content">产品模型</div>
                </div>
            </div>
            <div class="infobox infobox-red">
                <div class="infobox-icon"><span class="glyphicon glyphicon-picture"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">56</span>
                    <div class="infobox-content">图片模型</div>
                </div>
            </div>
            <div class="infobox infobox-orange">
                <div class="infobox-icon"><span class="glyphicon glyphicon-download-alt"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">44</span>
                    <div class="infobox-content">下载模型</div>
                </div>
            </div>
            <div class="infobox infobox-grey">
                <div class="infobox-icon"><span class="glyphicon glyphicon-info-sign"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">89</span>
                    <div class="infobox-content">信息反馈</div>
                </div>
            </div>
            <div class="infobox infobox-purple">
                <div class="infobox-icon"><span class="glyphicon glyphicon-comment"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">289</span>
                    <div class="infobox-content">评论留言</div>
                </div>
            </div>
            <div class="infobox infobox-orange2">
                <div class="infobox-icon"><span class="glyphicon glyphicon-user"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">289</span>
                    <div class="infobox-content">注册会员</div>
                </div>
            </div>
            <div class="infobox infobox-blue3">
                <div class="infobox-icon"><span class="glyphicon glyphicon-list"></span></div>
                <div class="infobox-data">
                    <span class="infobox-data-number">45</span>
                    <div class="infobox-content">栏目总数</div>
                </div>
            </div>
        </div>
    </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="ace-settings-container" class="ace-settings-container">
            <div id="ace-settings-btn" class="btn btn-app btn-xs btn-warning ace-settings-btn">
                <span class="glyphicon glyphicon-cog bigger-150"></span>
            </div>
            <div id="ace-settings-box" class="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="default" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&ensp;<?php echo L('SELECT_SKIN');?></span>
                </div>
                <div>
                    <input id="ace-settings-navbar" class="ace ace-checkbox-2" type="checkbox"/>
                    <label class="lbl" for="ace-settings-navbar">&ensp;<?php echo L('FIXED_NAVBAR');?></label>
                </div>
                <div>
                    <input id="ace-settings-sidebar" class="ace ace-checkbox-2" type="checkbox"/>
                    <label class="lbl" for="ace-settings-sidebar">&ensp;<?php echo L('FIXED_SIDEBAR');?></label>
                </div>
                <div>
                    <input id="ace-settings-breadcrumbs" class="ace ace-checkbox-2" type="checkbox"/>
                    <label class="lbl" for="ace-settings-breadcrumbs">&ensp;<?php echo L('FIXED_BREADCRUMBS');?></label>
                </div>
                <div>
                    <input id="ace-settings-rtl" class="ace ace-checkbox-2" type="checkbox"/>
                    <label class="lbl" for="ace-settings-rtl">&ensp;<?php echo L('SET_RTL');?></label>
                </div>
                <div>
                    <input id="ace-settings-add-container" class="ace ace-checkbox-2" type="checkbox"/>
                    <label class="lbl" for="ace-settings-add-container">&ensp;<?php echo L('SET_CONTAINER');?><b></b></label>
                </div>
            </div>
        </div>
    </div>
    <a id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse" href="javascript:;">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
</div>

<div id="msg_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="alert" role="alert">
            <span class="glyphicon"></span>
            <span class="info"></span>
        </div>
    </div>
  </div>
</div>
</body>
</html>