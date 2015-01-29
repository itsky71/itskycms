<?php
$gpath = MODULE_PATH.'Lang/'.LANG_SET.'/group_title.php';
if(file_exists($gpath)){
    require_once $gpath;
}else{
    $group_title = array();
}
$rpath = MODULE_PATH.'Lang/'.LANG_SET.'/rule_title.php';
if(file_exists($rpath)){
    require_once $rpath;
}else{
    $rule_title = array();
}
$group = array(
    'ADD_GROUP'     =>  '添加會員組',
    'NUMBER'        =>  '編號',
    'NAME'          =>  '名稱',
    'REMARK'        =>  '描述',
    'MANOPE'        =>  '管理操作',
    'ACCESS'        =>  '授權',
    'USERLIST'      =>  '會員列表',
    'GROUPNAME'     =>  '會員組名稱',
    'TITLEL'        =>  '標題長度必須為2-20個字符！',
    'REMARKL'       =>  '描述長度必須小於100個字符！',
    'ADD_ERROR'     =>  '會員組添加失敗！',
    'ADD_SUCCESS'   =>  '會員組添加成功！',
    'SAVE_ERROR'    =>  '會員組修改失敗！',
    'SAVE_OK'       =>  '會員組修改成功！',
    'ALL_SELECT'    =>  '全選',
    'SAVE'          =>  '保存',
    'ACCESS_OK'     =>  '授權成功！',
    'ACCESS_ERROR'  =>  '授權失敗！',
    'JS_INPUT_INFO' =>  '請輸入中文、字母、下劃線、空格'
);
return array_merge($group, $group_title, $rule_title);