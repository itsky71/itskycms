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
 * Description of CategoryModel
 * 栏目管理模型类
 * @author itsky
 */
class CategoryModel extends Model{
    //字段映射
    protected $_map = array(
        'listtpl' => 'template_list',
        'contenttpl' => 'template_show'
    );
    //表单自动验证
    protected $_validate = array(
        array('type','require','{%TYPER}'),
        array('name','2,20','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('dir','3,20','{%DIRL}',self::VALUE_VALIDATE,'length'),
        array('dir','/^[A-Za-z0-9_&\+\- ]+$/','{%DIRR}',self::VALUE_VALIDATE,'regex'),
        array('url','checkRequireUrl','{%URLR}',self::EXISTS_VALIDATE,'callback'),
        array('url','checkUrlUrl','{%URLU}',self::EXISTS_VALIDATE,'callback'),
        array('urlruleid','checkUrlRule','{%URLRULEIDC}',self::EXISTS_VALIDATE,'callback'),
        array('pagesize','number','{%PAGESIZEN}',self::VALUE_VALIDATE)
    );

    protected function checkRequireUrl(){
        if(I('post.mid') === '0' && empty(I('post.url'))){
            return FALSE;
        }
    }

    protected function checkUrlUrl(){
        if(I('post.mid') === '0' && I('post.url')){
            return $this->regex(I('post.url'), 'url');
        }
    }

    protected function checkUrlRule(){
        if(I('post.ishtml') && empty(I('post.urlruleid'))){
            return FALSE;
        }
    }
}