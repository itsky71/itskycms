<?php
require_once 'zh-cn/menu_common.php';
$common = array(
    'PRO_NAME'      =>  'ITskyCMS',
    'BACKER_MANAGE' =>  '后台管理',
    'LOGIN_SUCCESS' =>  '登录成功！',
    'LOGIN_ERROR'   =>  '用户名或密码错误！',
    'VERIFY_ERROR'  =>  '验证码错误！',
    'LOGOUT'        =>  '退出',
    'WELCOME'       =>  '欢迎光临',
    'SELECT_SKIN'   =>  '选择皮肤',
    'FIXED_NAVBAR'  =>  '固定导航条',
    'FIXED_SIDEBAR' =>  '固定滚动条',
    'FIXED_BREADCRUMBS'=>   '固定面包屑',
    'SET_RTL'       =>  '切换到左边',
    'SET_CONTAINER' =>  '切换窄屏'
);
return array_merge($common, $menu_common);