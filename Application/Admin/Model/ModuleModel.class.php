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
 * Description of ModuleModel
 * 模型/模块模型类
 * @author itsky
 */
class ModuleModel extends Model{
    //表单验证
    protected $_validate = array(
        array('title','2,30','{%TITLEL}',self::EXISTS_VALIDATE,'length'),
        array('title','/^[\x80-\xff_a-zA-Z0-9]+$/','{%TITLEF}',self::EXISTS_VALIDATE),
        array('name','2,30','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('name','english','{%NAMEF}',self::EXISTS_VALIDATE),
        array('name','checkName','{%NAMEU}',self::EXISTS_VALIDATE,'callback')
    );
    //验证表名
    protected function checkName(){
        $table = C('DB_PREFIX').I('post.name');
        $tables = $this->db->getTables();
        $result = in_array($table, $tables);
        return $result ? FALSE : TRUE;
    }
}
