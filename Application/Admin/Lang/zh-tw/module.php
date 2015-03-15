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
    
    
    'ADD_1'             =>  '添加模型',
    'TITLE_1'           =>  '模型名稱',
    'NAME_1'            =>  '模型表名',
    'DESCRIPTION_1'     =>  '模型簡介',
    'ADD_ERROR_1'       =>  '模型添加失敗！',
    'ADD_OK_1'          =>  '模型添加成功！',
    
    
    'ADD_2'             =>  '添加模塊',
    'TITLE_2'           =>  '模塊名稱',
    'NAME_2'            =>  '模塊表名',
    'DESCRIPTION_2'     =>  '模塊簡介',
    'ADD_ERROR_2'       =>  '模塊添加失敗！',
    'ADD_OK_2'          =>  '模塊添加成功！',
    
    'TITLEL'            =>  '名稱長度必須為2-30個字符！',
    'NAMEL'             =>  '表名長度必須為2-30個字符！',
    'TITLEF'            =>  '名稱只能包含中文、英文字母、數字和下劃線！',
    'NAMEF'             =>  '表名只能包含英文字母！',
    'NAMEU'             =>  '表名已存在！',
);
return array_merge($module, $module_info);