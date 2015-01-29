<?php
$spath = MODULE_PATH.'Lang/'.LANG_SET.'/siteset_info.php';
if(file_exists($spath)){
    require_once $spath;
}else{
    $siteset_info = array();
}
$siteset = array(
    'VARINFO'       =>  '參數說明',
    'VARNAME'       =>  '變量名',
    'VARVAL'        =>  '參數值',
    'VARTYPE'       =>  '變量類型',
    'STRING'        =>  '字符串',
    'NUMBER'        =>  '數字',
    'BOOL'          =>  '布爾(Y/N)',
    'TEXT'          =>  '多行文本',
    'GROUP'         =>  '所屬組',
    'SELECT_INFO'   =>  '請選擇一項...',
    'VNL'           =>  '變量名長度必須為3-20個字符！',
    'VNU'           =>  '變量名已存在！',
    'INFOL'         =>  '參數說明長度必須為2-50個字符！',
    'GROUPIDR'      =>  '所屬組為必選！',
    'ADD_ERROR'     =>  '系統變量添加失敗！',
    'ADD_SUCCESS'   =>  '系統變量添加成功！'
);
return array_merge($siteset, $siteset_info);