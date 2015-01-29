<?php
$rpath = MODULE_PATH.'Lang/'.LANG_SET.'/rule_title.php';
if(file_exists($rpath)){
    require_once $rpath;
}else{
    $rule_title = array();
}
$rule = array(
    'ADD'           =>  '添加權限節點',
    'GROUP'         =>  '分組',
    'NAME'          =>  '名稱',
    'TITLE'         =>  '標題',
    'CONDITION'     =>  '規則表達式',
    'GROUPR'        =>  '分組必選！',
    'CONDINFO'      =>  '為空表示存在就驗證， 不為空表示按照條件驗證',
    'NAMEL'         =>  '名稱長度必須為3-20個字符！',
    'NAMEC'         =>  '名稱必須為英文字母！',
    'NAMEU'         =>  '該名稱已存在！',
    'TITLEL'        =>  '標題長度必須為2-20個字符！',
    'CONDITIONL'    =>  '規則表達式長度必須小於100個字符！',
    'ADD_ERROR'     =>  '權限節點添加失敗！',
    'ADD_SUCCESS'   =>  '權限節點添加成功！',
    'DEL_ERROR'     =>  '權限節點刪除失敗！',
    'DEL_OK'        =>  '權限節點刪除成功！',
    'SAVE_ERROR'    =>  '權限節點修改失敗！',
    'SAVE_OK'       =>  '權限節點修改成功！',
    'SELECT'        =>  '請選擇...',
    'ADD_RULE'      =>  '添加權限節點',
    'ORDER'         =>  '排序',
    'MANOPE'        =>  '管理操作'
);
return array_merge($rule, $rule_title);