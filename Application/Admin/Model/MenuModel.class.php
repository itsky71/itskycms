<?php
/**
 * Description of MenuModel
 * 后台管理菜单模型类
 * @author itsky
 */
namespace Admin\Model;
use Think\Model;
class MenuModel extends Model{
    //表单验证
    protected $_validate = array(
        array('pid','number','{%PIDN}'),
        array('realname','checkRealname','{%RNAMEL}',self::EXISTS_VALIDATE,'callback'),
        array('model','3,20','{%MODELL}',self::EXISTS_VALIDATE,'length'),
        array('action','3,20','{%ACTIONL}',self::VALUE_VALIDATE,'length'),
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
}
