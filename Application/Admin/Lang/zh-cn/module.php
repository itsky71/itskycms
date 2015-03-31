<?php
$mopath = MODULE_PATH.'Lang/'.LANG_SET.'/module_info.php';
if(file_exists($mopath)){
    require_once $mopath;
}else{
    $module_info = array();
}
$module = array(
    'ADD_'              =>  '添加',
    'TITLE_'            =>  '名称',
    'NAME_'             =>  '表名',
    'DESCRIPTION_'      =>  '简介',
    'ADD_ERROR_'        =>  '添加失败！',
    'ADD_OK_'           =>  '添加成功！',
    'SAVE_ERROR_'       =>  '保存失败！',
    'MODULE_FIELD_'     =>  '字段管理',

    'ADD_1'             =>  '添加模型',
    'TITLE_1'           =>  '模型名称',
    'NAME_1'            =>  '模型表名',
    'DESCRIPTION_1'     =>  '模块简介',
    'ADD_ERROR_1'       =>  '模型添加失败！',
    'ADD_OK_1'          =>  '模型添加成功！',
    'SAVE_ERROR_1'      =>  '模型保存失败！',
    'MODULE_FIELD_1'    =>  '模型字段',

    'ADD_2'             =>  '添加模块',
    'TITLE_2'           =>  '模块名称',
    'NAME_2'            =>  '模块表名',
    'DESCRIPTION_2'     =>  '模块简介',
    'ADD_ERROR_2'       =>  '模块添加失败！',
    'ADD_OK_2'          =>  '模块添加成功！',
    'SAVE_ERROR_2'      =>  '模块保存失败！',
    'MODULE_FIELD_2'    =>  '模块字段',

    'NUMBER'            =>  '编号',
    'MANOPE'            =>  '管理操作',
    'TITLEL'            =>  '名称长度必须为2-30个字符！',
    'NAMEL'             =>  '表名长度必须为2-30个字符！',
    'TITLEF'            =>  '名称只能包含中文、英文字母、数字和下划线！',
    'NAMEF'             =>  '表名只能为英文字母！',
    'NAMEU'             =>  '表名已存在！',
    'RULE_ADD_ERROR'    =>  '权限节点添加失败！',
    'RULE_EDIT_ERROR'   =>  '权限节点编辑失败！',
    'MENU_ADD_ERROR'    =>  '菜单添加失败！',
    'MENU_EDIT_ERROR'   =>  '菜单编辑失败！'
);
return array_merge($module, $module_info);