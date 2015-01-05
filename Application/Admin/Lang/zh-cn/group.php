<?php
$gpath = MODULE_PATH.'Lang/'.LANG_SET.'/group_title.php';
if(file_exists($gpath)){
    require_once $gpath;
}else{
    $group_title = array();
}
$group = array(
    'ADD_GROUP'     =>  '添加会员组',
    'NUMBER'        =>  '编号',
    'NAME'          =>  '名称',
    'REMARK'        =>  '描述',
    'MANOPE'        =>  '管理操作',
    'ACCESS'        =>  '授权',
    'USERLIST'      =>  '用户列表',
    'GROUPNAME'     =>  '用户组名称',
    'TITLEL'        =>  '标题长度必须为2-20个字符！',
    'REMARKL'       =>  '描述长度必须小于100个字符！',
    'ADD_ERROR'     =>  '会员组添加失败！',
    'ADD_SUCCESS'   =>  '会员组添加成功！',
    'SAVE_ERROR'    =>  '会员组修改失败！',
    'SAVE_OK'       =>  '会员组修改成功！'
);
return array_merge($group, $group_title);