<?php
return array(
    'URL_MODEL' => 2,    // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_HTML_SUFFIX' => '',
    //auth权限管理配置
    'AUTH_CONFIG'=> array(
        'AUTH_ON'           => true,                      // 认证开关
        'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP'        => 'auth_group',        // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE'         => 'auth_rule',         // 权限规则表
        'AUTH_USER'         => 'member'             // 用户信息表
    ),
    'USER_AUTH_KEY'     =>  'authId',   //用户认证SESSION标记
    'ADMIN_AUTH_KEY'    =>  'admin',    //管理员认证SESSION标记
);