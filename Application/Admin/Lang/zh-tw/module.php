<?php
$mopath = MODULE_PATH.'Lang/'.LANG_SET.'/module_info.php';
if(file_exists($mopath)){
    require_once $mopath;
}else{
    $module_info = array();
}
$module = array(
    'ADD_'              =>  '添加',
    'TITLE_'            =>  '名稱',
    'NAME_'             =>  '表名',
    'DESCRIPTION_'      =>  '簡介',
    'ADD_ERROR_'        =>  '添加失敗！',
    'ADD_OK_'           =>  '添加成功！',
    'SAVE_ERROR_'       =>  '保存失败！',
    'MODULE_FIELD_'     =>  '字段管理',

    'ADD_1'             =>  '添加模型',
    'TITLE_1'           =>  '模型名稱',
    'NAME_1'            =>  '模型表名',
    'DESCRIPTION_1'     =>  '模型簡介',
    'ADD_ERROR_1'       =>  '模型添加失敗！',
    'ADD_OK_1'          =>  '模型添加成功！',
    'SAVE_ERROR_1'      =>  '模型保存失敗！',
    'MODULE_FIELD_1'    =>  '模型字段',

    'ADD_2'             =>  '添加模塊',
    'TITLE_2'           =>  '模塊名稱',
    'NAME_2'            =>  '模塊表名',
    'DESCRIPTION_2'     =>  '模塊簡介',
    'ADD_ERROR_2'       =>  '模塊添加失敗！',
    'ADD_OK_2'          =>  '模塊添加成功！',
    'SAVE_ERROR_2'      =>  '模塊保存失敗！',
    'MODULE_FIELD_2'    =>  '模塊字段',

    'NUMBER'            =>  '編號',
    'MANOPE'            =>  '管理操作',
    'TITLEL'            =>  '名稱長度必須為2-30個字符！',
    'NAMEL'             =>  '表名長度必須為2-30個字符！',
    'TITLEF'            =>  '名稱只能包含中文、英文字母、數字和下劃線！',
    'NAMEF'             =>  '表名只能包含英文字母！',
    'NAMEU'             =>  '表名已存在！',
    'RULE_ADD_ERROR'    =>  '權限節點添加失敗！',
    'RULE_EDIT_ERROR'   =>  '權限節點編輯失敗！',
    'MENU_ADD_ERROR'    =>  '菜單添加失敗！',
    'MENU_EDIT_ERROR'   =>  '菜單編輯失敗！'
);
return array_merge($module, $module_info);