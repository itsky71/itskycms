<?php
/**
 * 检测验证码
 * @param string $code 要验证的代码
 * @param number $id 验证ID
 * @return bool
 */
function check_verify($code,$id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
/**
 * 数据加密
 * @param string $str 加密字符串
 * @param string $key 加密密钥
 * @return string
 */
function sys_md5($str,$key=''){
    $key = $key.C('DATA_AUTH_KEY');
    return md5(sha1($str).$key);
}
/**
 * 写入文件
 * @param string $path 文件路径
 * @param string $data 文件数据
 * @param string $mode 模式
 * @return boolean
 */
function write_file($path,$data,$mode = 'wb'){
    if(!$fp = fopen($path, $mode)){
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $data);
    flock($fp, LOCK_UN);
    fclose($fp);
    return TRUE;
}
/**
 * 读取文件
 * @param string $file 文件路径
 * @return boolean
 */
function read_file($file){
    if(!file_exists($file)){
        return FALSE;
    }
    if(function_exists('file_get_contents')){
        return file_get_contents($file);
    }
    if(!$fp = fopen($file,'rb')){
        return FALSE;
    }
    flock($fp, LOCK_SH);
    $data = '';
    if(filesize($file)>0){
        $data = &fread($fp, filesize($file));
    }
    flock($fp, LOCK_UN);
    fclose($fp);
    return $data;
}
/**
 * 转换语言标识符
 * @param string $lang 系统语言标识符
 * @return string
 */
function lang($lang){
    $larr = explode('-', $lang);
    if(count($larr) == 2){
        $lstr = $larr[0].'_'.strtoupper($larr[1]);
    }else{
        $lstr = $lang;
    }
    return $lstr;
}
/**
 * 删除文件
 *
 * 删除所有提供在目录路径的包含的文件。
 * 要被删除的文件必须是当前系统用于所有或者是当前用户对之具有写权限。
 * 如果第二个参数设为 true，则所有在 path 下的文件夹也会被删除掉。
 *
 * @access  public
 * @param   string  $path       文件路径
 * @param   boolean    $del_dir    是否删除子文件夹
 * @param   number  $level      控制递归的深度（0 = 递归全部，1 = 当前目录，等）
 * @return  boolean
 */
function delete_files($path, $del_dir = FALSE, $level = 0){
    // Trim the trailing slash
    $path = rtrim($path, DIRECTORY_SEPARATOR);
 
    if ( ! $current_dir = @opendir($path)){
        return FALSE;
    }
 
    while (FALSE !== ($filename = @readdir($current_dir))){
        if ($filename != "." and $filename != ".."){
            if (is_dir($path.DIRECTORY_SEPARATOR.$filename)){
                // 忽略空文件夹
                if (substr($filename, 0, 1) != '.'){
                    delete_files($path.DIRECTORY_SEPARATOR.$filename, $del_dir, $level + 1);
                }
            }else{
                unlink($path.DIRECTORY_SEPARATOR.$filename);
            }
        }
    }
    @closedir($current_dir);
    if ($del_dir == TRUE AND $level > 0){
        return @rmdir($path);
    }
    return TRUE;
}
/**
 * 编写语言文件
 * @param array $lang 语言数组
 * @param string $file 语言文件名
 * @return boolean
 */
function write_lang($lang,$file){
    if(!is_array($lang)){
        return FALSE;
    }
    $path = MODULE_PATH.'Lang/'.LANG_SET.'/'.$file.'.php';
    $phpstar = '<?php'.PHP_EOL;
    $langdata = $phpstar;
    $langdata .= '$'.$file.' = array('.PHP_EOL;
    $$file = array();
    eval(str_replace($phpstar,'', read_file($path)));
    $arrdata = array_merge($$file, $lang);
    foreach ($arrdata as $key => $value){
        $langdata .= "    '$key' => '".addcslashes(stripslashes($value),'\'\\')."',".PHP_EOL;
    }
    $langdata .= ');';
    return write_file($path,$langdata);
}
/**
 * URL处理
 * @param string $add 添加参数
 * @return string
 */
function urlh($add){
    parse_str($add,$arrget);
    $res = array_merge($_GET,$arrget);
    return U(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$res);
}
/**
 * 自动侦测浏览器语言
 * @return string
 */
function accept_lang(){
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        preg_match('/^([a-z\d\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
        return $matches[1];
    }
}
/**
 * 表单多行值处理
 * @param string $str 内容值
 * @param string $type 类型
 * @param number $res 结果类型（0 返回 所有键值数组 1 返回默认键 2 返回默认值）
 * @return string|array
 */
function formrows($str,$type,$res=0){
    $typearr = array('select','radio','checkbox');
    if(!in_array($type, $typearr)) return $str;
    $rows = explode(PHP_EOL, $str);
    foreach ($rows as $item){
        $kv = explode('|', $item);
        $kvarr[$kv[1]] = $kv[0];
        if($kv[2] == 'default'){
            $defaultarr[$kv[1]] = $kv[0];
        }
    }
    if($res == 0){
        return $kvarr;
    }elseif($res == 1){
        return implode('|', array_keys($defaultarr));
    }elseif($res == 2){
        return implode(' ; ', $defaultarr);
    }else{
        return;
    }
}