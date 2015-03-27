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
        )
    );
    //表单验证
    protected $_validate = array(
        array('type','require','{%TYPER}'),
        array('field','2,20','{%FIELDL}',self::EXISTS_VALIDATE,'length'),
        array('field','english','{%FIELDE}'),
        array('field','checkField','{%FIELDC}',self::EXISTS_VALIDATE,'callback'),
        array('name','2,20','{%NAMEL}',self::EXISTS_VALIDATE,'length'),
        array('setup','checkSetup','{%SETUPALL}',self::EXISTS_VALIDATE,'callback'),
        array('class','2,20','{%CLASSL}',self::VALUE_VALIDATE,'length'),
        array('class','/^[A-Za-z0-9_\-]+$/','{%CLASSC}',self::VALUE_VALIDATE,'regex'),
        array('minlength','0,10','{%MINLENGTHL}',self::VALUE_VALIDATE,'length'),
        array('minlength','number','{%MINLENGTHN}',self::VALUE_VALIDATE),
        array('maxlength','0,10','{%MAXLENGTHL}',self::VALUE_VALIDATE,'length'),
        array('maxlength','number','{%MAXLENGTHN}',self::VALUE_VALIDATE),
        array('maxlength','checkMaxleng','{%MAXLENGTHC}',self::EXISTS_VALIDATE,'callback'),
        array('errormsg','2,250','{%ERRORMSGL}',self::VALUE_VALIDATE,'length')
    );
    //验证字段名唯一
    protected function checkField(){
        $data = array(
            'mid' => I('post.mid'),
            'mtype' => I('post.mtype'),
            'field' => I('post.field')
        );
        if($data['mtype'] == 1){
            $Content = M('Content');
            $fields = $Content->getDbFields();
            if(in_array($data['field'], $fields)){
                return FALSE;
            }
        }
        $Module = D('Module');
        $res = $Module->where('id='.$data['mid'])->find();
        $Table = M($res['name']);
        $tablefields = $Table->getDbFields();
        if(in_array($data['field'], $tablefields)){
            return FALSE;
        }
        return TRUE;
    }
    //比较数值大小
    protected function checkMaxleng(){
        $data = array(
            'min' => I('post.minlength'),
            'max' => I('post.maxlength')
        );
        if(empty($data['min']) && empty($data['max'])){
            return TRUE;
        }else{
            settype($data['min'], 'integer');
            settype($data['max'], 'integer');
            return !($data['min'] > $data['max']);
        }
    }
    //字段相关设置验证
    protected function checkSetup(){
        $type = I('post.type');
        $setup = I('post.setup');
        $res = array();
        switch ($type) {
            case 'title':
                if(!empty($setup['size'])){
                    $res[] = $this->check($setup['size'], 'number');
                    $res[] = $this->check($setup['size'],'2,4','length');
                }
                break;
            case 'typeid':
                if(!empty($setup['default'])) $res[] = $this->check($setup['default'],'2,20','length');
                break;
            case 'text':
                if(!empty($setup['size'])){
                    $res[] = $this->check($setup['size'], 'number');
                    $res[] = $this->check($setup['size'],'2,4','length');
                }
                break;
            case 'textarea':
                if(!empty($setup['height'])){
                    $res[] = $this->check($setup['height'], 'number');
                    $res[] = $this->check($setup['height'],'2,4','length');
                }
                if(!empty($setup['width'])){
                    $res[] = $this->check($setup['width'], 'number');
                    $res[] = $this->check($setup['width'],'2,4','length');
                }
                break;
            case 'editor':
                if(!empty($setup['height'])){
                    $res[] = $this->check($setup['height'], 'number');
                    $res[] = $this->check($setup['height'], '2,4','length');
                }
                if(!empty($setup['alowuploadexts'])){
                    $res[] = $this->check($setup['alowuploadexts'], '/^[A-Za-z,]+$/');
                    $res[] = $this->check($setup['alowuploadexts'], '2,200','length');
                }
                break;
            case 'select':
                $res[] = $this->check($setup['options'],'require');
                $options = explode(PHP_EOL,$setup['options']);
                if (count($options) < 2) $res[] = FALSE;
                foreach ($options as $item){
                    if((!empty(trim($item))) && strpos('|',trim($item))){
                        $res[] = FALSE;
                    }
                }
                break;
            default:
                break;
        }
        foreach ($res as $value){
            if(!$value) return FALSE;
        }
        if(!empty($setup['safefun'])){
            return preg_match('/^[A-Za-z0-9_]+$/', $setup['safefun'])==1;
        }
        return TRUE;
    }
    public function test(){
//        $type = I('post.type');
        $setup = I('post.setup');
        $res[] = $this->check($setup['options'],'require');
        $options = explode(PHP_EOL,$setup['options']);
        if (count($options) < 2) $res[] = 'FALSE';
        foreach ($options as $item){
            if(!empty(trim($item)) && strpos('|',trim($item))){
                $res[] = FALSE;
            }
        }
        return $res;
    }
}
