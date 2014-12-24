<?php
// +----------------------------------------------------------------------
// | ITskyCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.itsky.me All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: itsky <itsky71@foxmail.com>
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
/**
 * Description of AuthRuleModel
 * 权限节点管理模型类
 * @author itsky
 */
class AuthRuleModel extends Model{
    //表单验证
    protected $_validate = array(
        array('group','require','{%GROUPR}'),
        array('name','3,20','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('name','english','{%NAMEC}'),
        array('name','','{%NAMEU}',self::EXISTS_VALIDATE,'unique'),
        array('title','2,20','{%TITLEL}',self::EXISTS_VALIDATE,'length'),
        array('condition','0,100','{%CONDITIONL}',self::EXISTS_VALIDATE,'length')
    );
}
