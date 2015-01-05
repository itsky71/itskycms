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
 * Description of AuthGroupModel
 * 用户组模型类
 * @author itsky
 */
class AuthGroupModel extends Model{
    //表单验证
    protected $_validate = array(
        array('title','2,20','{%TITLEL}',self::EXISTS_VALIDATE,'length'),
        array('remark','0,100','{%REMARKL}',self::EXISTS_VALIDATE,'length')
    );
}
