<?php
$mpath = MODULE_PATH.'Lang/'.LANG_SET.'/menu_common.php';
if(file_exists($mpath)){
    require_once $mpath;
}else{
    $menu_common = array();
}
$common = array(
    'PRO_NAME'          =>  'ITskyCMS',
    'BACKER_MANAGE'     =>  '後台管理',
    'LOGIN_SUCCESS'     =>  '登入成功！',
    'LOGIN_ERROR'       =>  '用戶名或密碼錯誤！',
    'VERIFY_ERROR'      =>  '驗證碼錯誤！',
    'LOGOUT'            =>  '退出',
    'WELCOME'           =>  '歡迎光臨',
    'SELECT_SKIN'       =>  '選擇皮膚',
    'FIXED_NAVBAR'      =>  '固定導航條',
    'FIXED_SIDEBAR'     =>  '固定滾動條',
    'FIXED_BREADCRUMBS' =>   '固定麵包屑',
    'SET_RTL'           =>  '切換到左邊',
    'SET_CONTAINER'     =>  '切換窄屏',
    'HOME_INDEX'        =>  '首頁',
    'MENU_LOOK'         =>  '查看',
    'SUBMIT'            =>  '保存',
    'RESET'             =>  '重置',
    'DEFAULT'           =>  '默認',
    'SUCH'              =>  '例',
    'INDEX'             =>  '查看',
    'EDIT'              =>  '編輯',
    'DELETE'            =>  '刪除',
    'DEL_OK'            =>  '刪除成功！',
    'DEL_ERROR'         =>  '刪除失敗！',
    'ORDER_OK'          =>  '排序成功！',
    'STATUS_ERROR'      =>  '狀態設置失敗！',
    'ADD'               =>  '添加',
    'STATUS'            =>  '狀態',
    'SAVE_ERROR'        =>  '保存失敗！',
    'SAVE_OK'           =>  '保存成功！',
    'ON'                =>  '開啟',
    'OFF'               =>  '關閉',
    'YES'               =>  '是',
    'NO'                =>  '否',
    'FONT_INDEX'        =>  '前台主頁',
    'ADD_ERROR'         =>  '數據添加失敗！',
    'ADD_OK'            =>  '數據添加成功！',


    'DOWNLOAD_FILE_NOT_EXIST'   =>  '下載文件不存在！'
);
return array_merge($common, $menu_common);