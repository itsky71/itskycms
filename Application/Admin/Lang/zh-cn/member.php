<?php
$gpath = MODULE_PATH.'Lang/'.LANG_SET.'/group_title.php';
if(file_exists($gpath)){
    require_once $gpath;
}else{
    $group_title = array();
}
$member = array(
    'LENGTHMENU'    =>  '每页 _MENU_ 条记录',
    'ZEROREC'       =>  '没有找到记录',
    'INFO'          =>  '第 _PAGE_/_PAGES_ 页 ( 共 _TOTAL_ 条记录 )',
    'INFOEMPTY'     =>  '无记录',
    'INFOFILT'      =>  '(从 _MAX_ 条记录过滤)',
    'SEARCH'        =>  '搜索',
    'NUMBER'        =>  '编号',
    'USERNAME'      =>  '用户名',
    'USERGROUP'     =>  '用户组',
    'EMAIL'         =>  '邮箱',
    'REGTIME'       =>  '注册时间',
    'MANOPE'        =>  '管理操作',
    'ADD_USER'      =>  '添加会员',
    'DEL_USERS'     =>  '删除所选',
    'USERNAME'      =>  '用户名',
    'PASSWORD'      =>  '密码',
    'REALNAME'      =>  '昵称',
    'QUESTION'      =>  '安全问题',
    'ANSWER'        =>  '答案',
    'SELECT'        =>  '请选择...',
    'YZUNL'         =>  '用户名长度必须为3-20个字符！',
    'YZUNU'         =>  '用户名已被占用!',
    'PWDL'          =>  '密码长度必须为6-20个字符！',
    'YZEF'          =>  '邮箱格式不正确!',
    'YZEU'          =>  '邮箱已被占用！',
    'YZRNL'         =>  '昵称长度必须为2-20个字符！',
    'YZRNI'         =>  '昵称只能包含中文、英文、下划线、数字组成的字符！',
    'YZQL'          =>  '安全问题长度为3-30个字符！',
    'YZAL'          =>  '答案长度不能超过30个字符！',
    'GROUPR'        =>  '用户组必须选择！',
    'ADD_ERROR'     =>  '会员添加失败！',
    'ADD_SUCCESS'   =>  '会员添加成功！',
    'SAVE_ERROR'    =>  '会员修改失败！',
    'SAVE_OK'       =>  '会员修改成功！'
);
return array_merge($member, $group_title);