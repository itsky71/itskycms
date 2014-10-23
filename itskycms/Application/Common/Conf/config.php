<?php
return array(
    //'配置项'=>'配置值'
    'TMPL_FILE_DEPR' => '_',    //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
    'LAYOUT_ON' => TRUE,    // 是否启用布局
    'MODULE_ALLOW_LIST' => array('Admin','Home'), // 允许的模块列表
    'DEFAULT_MODULE' => 'Home', // 默认模块
    'URL_MODEL' => 2,    // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'DATA_AUTH_KEY' => '1(EX=hyCHfVIE*;xMQZI2VW^Ec4>sz^F', //默认数据加密KEY
    'COOKIE_PREFIX' => 'tadmin_',   //cookie 前缀
    /* 数据库配置 */
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'tadmin', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'ta_', // 数据库表前缀
    //权限管理配置
    'USER_AUTH_ON'      =>  TRUE,   //是否需要认证
    'USER_AUTH_TYPE'    =>  2,      // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'     =>  'authId',   //用户认证SESSION标记
    'USER_AUTH_MODEL'   =>  'User',     //默认验证数据表模型
    'ADMIN_AUTH_KEY'    =>  'administrator',//管理员认证SESSION标记
    'REQUIRE_AUTH_MODULE'   =>  '',     //默认需要认证模块
    'NOT_AUTH_MODULE'       =>  'Public',     //默认无需认证模块
    'REQUIRE_AUTH_ACTION'   =>  '',     //默认需要认证操作
    'GUEST_AUTH_ON'         =>  FALSE,  //是否开启游客授权访问
    'GUEST_AUTH_ID'         =>  0,      //游客的用户ID
    'USER_AUTH_GATEWAY'     =>  '/Public/login',    //认证网关
    'RBAC_DB_DSN'           =>  '',     //数据库连接DSN 为空则是配置信息中的数据库配置
    'RBAC_ROLE_TABLE'       =>  'ta_role',  //角色表名称
    'RBAC_USER_TABLE'       =>  'ta_role_user', //用户表名称
    'RBAC_ACCESS_TABLE'     =>  'ta_access',    //权限表名称
    'RBAC_NODE_TABLE'       =>  'ta_node'       //节点表名称
);