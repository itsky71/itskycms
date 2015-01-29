<?php
$gpath = MODULE_PATH.'Lang/'.LANG_SET.'/group_title.php';
if(file_exists($gpath)){
    require_once $gpath;
}else{
    $group_title = array();
}
$member = array(
        'LENGTHMENU'    =>  '每頁 _MENU_ 條記錄',
    'ZEROREC'       =>  '沒有找到記錄',
    'INFO'          =>  '第 _PAGE_/_PAGES_ 頁 ( 共 _TOTAL_ 條記錄 )',
    'INFOEMPTY'     =>  '無記錄',
    'INFOFILT'      =>  '(從 _MAX_ 條記錄過濾)',
    'SEARCH'        =>  '搜索',
    'NUMBER'        =>  '編號',
    'USERNAME'      =>  '用戶名',
    'USERGROUP'     =>  '用戶組',
    'EMAIL'         =>  '邮箱',
    'REGTIME'       =>  '註冊時間',
    'MANOPE'        =>  '管理操作',
    'ADD_USER'      =>  '添加會員',
    'DEL_USERS'     =>  '刪除所選',
    'USERNAME'      =>  '用戶名',
    'PASSWORD'      =>  '密碼',
    'REALNAME'      =>  '暱稱',
    'QUESTION'      =>  '安全問題',
    'ANSWER'        =>  '答案',
    'SELECT'        =>  '請選擇...',
    'YZUNL'         =>  '用戶名長度必須為3-20個字符！',
    'YZUNU'         =>  '用戶名已被佔用!',
    'PWDL'          =>  '密碼長度必須為6-20個字符！',
    'YZEF'          =>  '郵箱格式不正確!',
    'YZEU'          =>  '郵箱已被佔用！',
    'YZRNL'         =>  '暱稱長度必須為2-20個字符！',
    'YZRNI'         =>  '暱稱只能包含中文、英文、下劃線、數字組成的字符！',
    'YZQL'          =>  '安全問題長度必須為3-30個字符！',
    'YZAL'          =>  '答案長度不能超過30個字符！',
    'GROUPR'        =>  '用戶組必須選擇！',
    'ADD_ERROR'     =>  '會員添加失敗！',
    'ADD_SUCCESS'   =>  '會員添加成功！',
    'SAVE_ERROR'    =>  '會員修改失敗！',
    'SAVE_OK'       =>  '會員修改成功！'
);
return array_merge($member, $group_title);