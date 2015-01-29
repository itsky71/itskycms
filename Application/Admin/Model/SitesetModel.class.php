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
 * Description of SitesetModel
 * 系统参数模型类
 * @author itsky
 */
class SitesetModel extends Model{
    //表单验证
    protected $_validate = array(
        array('varname','3,20','{%VNL}',self::EXISTS_VALIDATE,'length'),
        array('varname,lang','','{%VNU}',self::MUST_VALIDATE,'unique',self::MODEL_INSERT),
        array('info','2,50','{%INFOL}',self::EXISTS_VALIDATE,'length'),
        array('groupid','require','{%GROUPIDR}')
    );
}
