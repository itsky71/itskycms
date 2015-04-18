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
        return strtolower($matches[1]);
    }
}
function auto_lang(){
    return cookie('think_language') ? strtolower(cookie('think_language')) : strtolower(accept_lang());
}
/**
 * 表单多行值处理
 * @param string $str 内容值
 * @param string $type 类型
 * @param number $res 结果类型（0 返回 所有键值数组 1 返回默认键 2 返回默认值）
 * @return string|array
 */
function formrows($str,$type,$res=0){
    if($type == 'bool'){
        return $res == 1 ? ($str ? 1 : 0) : ($str ? L('ON') : L('OFF'));
    }
    $typearr = array('select','radio','checkbox');
    if(!in_array($type, $typearr)) return $str;
    $rows = explode(PHP_EOL, $str);
    foreach ($rows as $item){
        if($item){
            $kv = explode('|', $item);
            $kvarr[$kv[1]] = $kv[0];
            if($kv[2] == 'default'){
                $defaultarr[$kv[1]] = $kv[0];
            }
        }
    }
    if($res == 0){
        return $kvarr;
    }elseif($res == 1){
        $resstrk = implode(',', array_keys($defaultarr));
        return $resstrk;
    }elseif($res == 2){
        $resstrv = implode(' / ', $defaultarr);
        return $resstrv ? $resstrv : 'NULL';
    }else{
        return;
    }
}
/**
 * 默认值
 * @param string $var 变量
 * @param string $acq 默认值
 * @return string 若 $var 为空，则返回 $acq ,否则返回 $var
 */
function acq($var,$acq){
    return ($var === '' || $var === NULL) ? $acq : $var;
}
/**
 * 发送电子邮件
 * @param string $tomail 要发送的目标email
 * @param string $subject 主题
 * @param string $body 正文
 * @param string $config 配置
 * @return boolean 若发送成功返回TRUE，否则返回FALSE
 */
function sendmail($tomail,$subject,$body,$config=''){
    if(!$config) $config = F('Config');
    $mail = new Common\Lib\PHPMailer();
    if($config['mail_type'] == 1){
        $mail->isSMTP();
    }elseif($config['mail_type'] == 2){
        $mail->isMail();
    }else{
        $mail->isSendmail();
    }
    if($config['mail_auth']){
        $mail->SMTPAuth = TRUE;
    }else{
        $mail->SMTPAuth = FALSE;
    }
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage(LANG_SET);
    $mail->Debugoutput = 'html';
    $mail->Host = $config['mail_server'];
    $mail->Port = $config['mail_port'];
    $mail->Username = $config['mail_from'];
    $mail->Password = $config['mail_password'];
    $mail->setFrom($config['mail_from'],$config['mail_user']);
    $mail->addReplyTo($config['mail_from'], $config['mail_user']);
    $mail->addAddress($tomail);
    $mail->Subject = $subject;
    $mail->msgHTML($body);
    if(!$mail->send()){
        return $mail->ErrorInfo;
    }else{
        return TRUE;
    }
}
/**
 * 比较两个数组是否相等
 * @param array $array1 数组1
 * @param array $array2 数组2
 * @return boolean
 */
function arrequal($array1,$array2){
    if(!is_array($array1) || !is_array($array2)){
        return FALSE;
    }
    foreach ($array1 as $key=>$value){
        if($array2[$key] !== $value){
            return FALSE;
        }
    }
    foreach ($array2 as $key=>$value){
        if($array1[$key] !== $value){
            return FALSE;
        }
    }
    return TRUE;
}
/**
 * 将文件大小以字节（bytes）格式化，并添加合适的缩写单位。
 *
 * @access  public
 * @param   number   $num        文件大小
 * @param   number   $precision  设置结果的精确度
 * @return  string
 */
function byte_format($num, $precision = 1){
    if ($num >= 1000000000000){
        $num = round($num / 1099511627776, $precision);
        $unit = 'TB';
    }elseif ($num >= 1000000000){
        $num = round($num / 1073741824, $precision);
        $unit = 'GB';
    }elseif ($num >= 1000000){
        $num = round($num / 1048576, $precision);
        $unit = 'MB';
    }elseif ($num >= 1000){
        $num = round($num / 1024, $precision);
        $unit = 'KB';
    }else{
        $unit = 'B';
        return number_format($num).' '.$unit;
    }
    return number_format($num, $precision).' '.$unit;
}
/**
 * 获取目录中的文件信息
 *
 * 获取 $source_dir 目录下的所有文件的文件名，文件大小，
 * 日期，文件权限等，并将这些内容保存到返回的数组中。
 *
 * @access  public
 * @param   string      $source_dir     文件夹路径
 * @param   boolean     $top_level_only
 * @param   boolean     $_recursion    
 * @return  array
 */
function get_dir_file_info($source_dir, $top_level_only = TRUE, $_recursion = FALSE){
    static $_filedata = array();
    $relative_path = $source_dir;
    $fp = opendir($source_dir);
    if ($fp){
        // reset the array and make sure $source_dir has a trailing slash on the initial call
        if ($_recursion === FALSE){
            $_filedata = array();
            $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        }
 
        // foreach (scandir($source_dir, 1) as $file) // In addition to being PHP5+, scandir() is simply not as fast
        while (FALSE !== ($file = readdir($fp))){
            if (is_dir($source_dir.$file) AND strncmp($file, '.', 1) !== 0 AND $top_level_only === FALSE){
                get_dir_file_info($source_dir.$file.DIRECTORY_SEPARATOR, $top_level_only, TRUE);
            }elseif (strncmp($file, '.', 1) !== 0){
                $_filedata[$file] = get_file_info($source_dir.$file);
                $_filedata[$file]['relative_path'] = $relative_path;
            }
        }
        return $_filedata;
    }else{
        return FALSE;
    }
}
/**
* 获取文件信息
*
* 通过给定的路径和文件名，获取到文件 path/to/file 的文件名，文件大小，文件更改日期等。
* 第二个参数允许你说明需要返回的信息，这个参数的选项包括 ‘name’，‘server_path’，‘size’，
* ‘date’，‘readable’，‘writeable’，‘executable’，‘fileperms’。
* 如果文件不存在则返回 FALSE
*
* @access   public
* @param    string  $file               文件路径
* @param    mixed   $returned_values    array or comma separated string of information returned
* @return   array
*/
function get_file_info($file, $returned_values = array('name', 'server_path', 'size', 'date')){
    if (!file_exists($file)){
        return FALSE;
    }
    if (is_string($returned_values)){
        $returned_values = explode(',', $returned_values);
    }
    foreach ($returned_values as $key){
        switch ($key){
            case 'name':
                $fileinfo['name'] = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
                break;
            case 'server_path':
                $fileinfo['server_path'] = $file;
                break;
            case 'size':
                $fileinfo['size'] = filesize($file);
                break;
            case 'date':
                $fileinfo['date'] = filemtime($file);
                break;
            case 'readable':
                $fileinfo['readable'] = is_readable($file);
                break;
            case 'writable':
                // There are known problems using is_weritable on IIS.  It may not be reliable - consider fileperms()
                $fileinfo['writable'] = is_writable($file);
                break;
            case 'executable':
                $fileinfo['executable'] = is_executable($file);
                break;
            case 'fileperms':
                $fileinfo['fileperms'] = fileperms($file);
                break;
        }
    }
    return $fileinfo;
}
/**
 * 将utf8字符串转换成 /U4F60/U597D 形式
 * @param string $name
 * @return string
 */
function utf8_unicode($name){
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len  = strlen($name);
    $str  = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2){
        $c  = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0){//两个字节的文字
            $str .= '\u'.base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
            //$str .= base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
        } else {
            $str .= '\u'.str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
            //$str .= str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
        }
    }
    //$str = strtoupper($str);//转换为大写
    return $str;
}
/**
 * 将 /U4F60/U597D 形式的字符转换成可阅读的字符串
 * @param string $name
 * @return string
 */
function unicode_utf8($name){
    $name = strtolower($name);
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)){
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++){
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0){  
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            } else {
                $name .= $str;
            }
        }
    }
    return $name;
}  