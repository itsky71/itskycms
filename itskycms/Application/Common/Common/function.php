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

