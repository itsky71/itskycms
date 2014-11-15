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
