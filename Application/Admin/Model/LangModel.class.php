<?php
// +----------------------------------------------------------------------
// | ITskyCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.itsky71.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: itsky <itsky71@foxmail.com>
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
/**
 * Description of LangModel
 * 语言模型类
 * @author itsky
 */
class LangModel extends Model{
    //表单验证
    protected $_validate = array(
        array('name','2,20','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('name','','{%NAMEU}',self::EXISTS_VALIDATE,'unique'),
        array('value','2,5','{%VALUEL}',self::EXISTS_VALIDATE,'length'),
        array('value','','{%VALUEU}',self::EXISTS_VALIDATE,'unique')
    );
}
