<?php
$rpath = MODULE_PATH.'Lang/'.LANG_SET.'/rule_title.php';
if(file_exists($rpath)){
    require_once $rpath;
}else{
    $rule_title = array();
}
$rule = array(
    'ADD'           =>  '添加权限节点',
    'GROUP'         =>  '分组',
    'NAME'          =>  '名称',
    'TITLE'         =>  '标题',
    'CONDITION'     =>  '规则表达式',
    'GROUPR'        =>  '分组为必选！',
    'CONDINFO'      =>  '为空表示存在就验证， 不为空表示按照条件验证',
    'NAMEL'         =>  '名称长度必须为3-20个字符！',
    'NAMEC'         =>  '名称必须为英文字母！',
    'NAMEU'         =>  '该名称已存在！',
    'TITLEL'        =>  '标题长度必须为2-20个字符！',
    'CONDITIONL'    =>  '规则表达式长度必须小于100个字符！',
    'ADD_ERROR'     =>  '权限节点添加失败！',
    'ADD_SUCCESS'   =>  '权限节点添加成功！',
    'DEL_ERROR'     =>  '权限节点删除失败！',
    'DEL_OK'        =>  '权限节点删除成功！',
    'SAVE_ERROR'    =>  '权限节点修改失败！',
    'SAVE_OK'       =>  '权限节点修改成功！',
    'SELECT'        =>  '请选择',
    'ADD_RULE'      =>  '添加权限节点',
    'ORDER'         =>  '排序',
    'MANOPE'        =>  '管理操作'
);
return array_merge($rule, $rule_title);