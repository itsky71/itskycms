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
use Think\Model\RelationModel;
/**
 * Description of FieldModel
 * 字段管理模型类
 * @author itsky
 */
class FieldModel extends RelationModel{
    protected $_link = array(
        'Module' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Module',
            'foreign_key' => 'mid',
            'mapping_name' => 'module',
            'mapping_fields' => 'name,type'
//            'as_fields' => 'name:module'
        )
    );
    //表单验证
    protected $_validate = array(
        array('type','require','{%TYPER}'),
        array('field','2,20','{%FIELDL}',self::EXISTS_VALIDATE,'length'),
        array('field','english','{%FIELDE}'),
        array('field','checkField','{%FIELDC}',self::EXISTS_VALIDATE,'callback'),
        array('name','2,20','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('setup','checkSetup','{%SETUP}',self::EXISTS_VALIDATE,'callback')
    );
    //验证字段名唯一
    protected function checkField(){
        $data = array(
            'mid' => I('post.mid'),
            'mtype' => I('post.mtype')
        );
        if($data['mtype'] == 1){
            //content
        }elseif($data['mtype'] == 2){
            
        }
        $Module = D('Module');
        $res = $Module->where('id='.$data['mid'])->find();
        return (is_array($res));
    }
    //字段相关设置验证
    protected function checkSetup(){
        return FALSE;
    }

    public function hehe(){
        $res = $this->where('mid='.I('post.mid'))->relation(true)->find(7);
        return $res;
    }
}
