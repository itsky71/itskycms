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
 * Description of MenuModel
 * 后台管理菜单模型类
 * @author itsky
 */
class MenuModel extends Model{
    //表单验证
    protected $_validate = array(
        array('pid','number','{%PIDN}'),
        array('realname','checkRealname','{%RNAMEL}',self::EXISTS_VALIDATE,'callback'),
        array('model','3,20','{%MODELL}',self::EXISTS_VALIDATE,'length'),
        array('action','3,20','{%ACTIONL}',self::VALUE_VALIDATE,'length'),
        array('action','checkAction','{%ACTIONU}',self::EXISTS_VALIDATE,'callback'),
        array('data','3,50','{%DATAL}',self::VALUE_VALIDATE,'length'),
        array('remark','0,100','{%REMARKL}',self::EXISTS_VALIDATE,'length')
    );

    //验证名称
    protected function checkRealname(){
        $rname = I('post.realname');
        foreach ($rname as $value){
            $length  =  mb_strlen($value,'utf-8');
            return $length>=2 && $length<=20;
        }
    }
    
    //验证方法唯一
    protected function checkAction(){
        $map = array(
            'model' => ucfirst(I('post.model')),
            'action' => I('post.action') ? strtolower(I('post.action')) : 'index'
        );
        if(I('post.id')){
            $map['id'] = array('neq',I('post.id'));
        }
        $result = $this->where($map)->find();
        return $result ? FALSE : TRUE;
    }
}
