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
        array('name','7,50','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('name','checkName','{%NAMEC}',self::EXISTS_VALIDATE,'callback')
    );
    //名称验证
    protected function checkName(){
        $name = I('post.name');
        $maarr = explode('/', $name);
        if(count($maarr) != 2) return FALSE;
        if(strlen($maarr[0]) < 3 || preg_match('/^[A-Za-z]+$/',$maarr[0])) return FALSE;
        return TRUE;
    }
}
