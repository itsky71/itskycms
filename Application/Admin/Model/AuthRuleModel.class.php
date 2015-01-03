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
        array('name','checkName','{%NAMEU}',self::EXISTS_VALIDATE,'callback'),
        array('title','2,20','{%TITLEL}',self::EXISTS_VALIDATE,'length'),
        array('condition','0,100','{%CONDITIONL}',self::EXISTS_VALIDATE,'length')
    );

    //验证名称唯一
    protected function checkName(){
        $map['name'] = I('post.group').'/'.I('post.name');
        if(I('post.id')) $map['id'] = array('neq',I('post.id'));
        $result = $this->where($map)->find();
        return $result ? FALSE : TRUE;
    }
}
