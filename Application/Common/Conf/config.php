<?php
return array(
    //'配置项'=>'配置值'
    'TMPL_FILE_DEPR'    => '_',    //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
    'MODULE_ALLOW_LIST' => array('Admin','Home','Error'), // 允许的模块列表
//    'URL_MODULE_MAP'  => array('test'=>'admin'), //模块映射
//    'MODULE_DENY_LIST'=> array('ThinkPHP'),
    'DEFAULT_MODULE'    => 'Home', // 默认模块
    'TAGLIB_PRE_LOAD'   =>  'Common\Lib\Sky',
    'LANG_SWITCH_ON'    => TRUE,   // 开启语言包功能
    'LANG_AUTO_DETECT'  => TRUE, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'         => 'zh-cn,zh-tw,en-us', // 允许切换的语言列表 用逗号分隔
    'DEFAULT_LANG'      =>  'zh-cn',//默认语言
    'VAR_LANGUAGE'      => 'l', // 默认语言切换变量
    'URL_MODEL'         => 2,    // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'DATA_AUTH_KEY'     => '1(EX=hyCHfVIE*;xMQZI2VW^Ec4>sz^F', //默认数据加密KEY
    'COOKIE_PREFIX'     => 'itsky_',   //cookie 前缀
    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'tadmin', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'ta_', // 数据库表前缀
    'DB_CHARSET'=>  'utf8' //数据库编码
);