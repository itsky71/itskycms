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
 * Description of UrlruleModel
 * URL规则模型类
 * @author itsky
 */
class UrlruleModel extends Model{
    //表单自动验证
    protected $_validate = array(
        array('showexample','2,200','{%SHOW_EXAMPLE_L}',self::EXISTS_VALIDATE,'length'),
        array('showurlrule','2,200','{%SHOW_URL_RULE_L}',self::EXISTS_VALIDATE,'length'),
        array('listexample','2,200','{%LIST_EXAMPLE_L}',self::EXISTS_VALIDATE,'length'),
        array('listurlrule','2,200','{%LIST_URL_RULE_L}',self::EXISTS_VALIDATE,'length')
    );
}
