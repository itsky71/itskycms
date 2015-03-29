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
namespace Admin\Controller;
/**
 * Description of FieldController
 * 模型字段管理控制器类
 * @author itsky
 */
class FieldController extends AdminController{
    public function _initialize(){
        parent::_initialize();
        $field_patten = array(
            'email'     =>  L('PATTERN_EMAIL'),
            'url'       =>  L('PATTERN_URL'),
            'date'      =>  L('PATTERN_DATE'),
            'number'    =>  L('PATTERN_NUMBER'),
            'digits'    =>  L('PATTERN_DIGITS'),
            'creditcard'=>  L('PATTERN_CREDITCARD'),
            'equalto'   =>  L('PATTERN_EQUALTO'),
            'ip4'       =>  L('PATTERN_IP4'),
            'mobile'    =>  L('PATTERN_MOBILE'),
            'tel'       =>  L('PATTERN_TEL'),
            'zipcode'   =>  L('PATTERN_ZIPCODE'),
            'qq'        =>  L('PATTERN_QQ'),
            'idcard'    =>  L('PATTERN_IDCARD'),
            'chinese'   =>  L('PATTERN_CHINESE'),
            'cn_username'=> L('PATTERN_CN_USERNAME'),
            'english'   =>  L('PATTERN_ENGLISH'),
            'en_num'    =>  L('PATTERN_EN_NUM'),
            'regex'     =>  L('PATTERN_REGEX')
        );
        $this->assign('field_pattern',$field_patten);
    }

    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(I('get.isajax')){
            $this->assign(I('get.'));
            $this->assign(I('post.'));
            $this->display('type');
        }else{
            $Field = D('Field');
            $list = $Field->where('mid='.I('get.mid'))->order('listorder,id ASC')->select();
            $this->assign('list', $list);
            $this->display();
        }
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(IS_POST){
            $Field = D('Field');
            $mid = I('post.mid');
            settype($mid, 'integer');
            $module = M('Module')->getFieldById($mid,'name');
            if($Field->create()){
                $data = array(
                    'mid' => $mid,
                    'field' => I('post.field'),
                    'name' => strtoupper($module).'_'.strtoupper(I('post.field')),
                    'tips' => empty(trim(I('post.tips'))) ? '' : strtoupper($module).'_TIPS_'.strtoupper(I('post.field')),
                    'required' => empty(I('post.required')) ? 0 : 1,
                    'minlength' => I('post.minlength'),
                    'maxlength' => I('post.maxlength'),
                    'pattern' => I('post.pattern'),
                    'regex' => trim(I('post.regex')),
                    'errormsg' => strtoupper($module).'_ERRORMSG_'.strtoupper(I('post.field')),
                    'class' => I('post.class'),
                    'type' => I('post.type'),
                    'setup' => json_encode(I('post.setup'))
                );
                if($Field->add($data)){
                    $langs = array(
                        $data['name'] => trim(I('post.name')),
                        $data['tips'] => trim(I('post.tips')),
                        $data['errormsg'] => trim(I('post.errormsg'))
                    );
                    write_lang($langs, 'field_common');
                    $addFieldSql = $test = $this->execute_sql(I('post.'),'add');
                    $model = new \Think\Model();
                    if(is_array($addFieldSql)){
                        foreach ($addFieldSql as $sql){
                            $model->execute($sql);
                        }
                    }else{
                        if($addFieldSql) $model->execute ($addFieldSql);
                    }
                    $this->success(L('ADD_OK'),U('Field/index',$this->vl.'&type='.I('post.mtype').'&mid='.$mid));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Field->getError());
            }
        }else{
            $this->display('edit');
        }
    }

    public function order(){
        if(IS_AJAX && IS_POST){
            $Field = D('Field');
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $Field->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'),U('Field/index',$this->vl.'&type='.I('post.type').'&mid='.I('post.mid')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function status(){
        if(IS_AJAX && IS_GET){
            $Field = D('Field');
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $Field->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect('Field/index',$this->vl.'&type='.I('get.type').'&mid='.I('get.mid'));
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    private function execute_sql($info,$doing){
        $fieldtype = $info['type'];
        if($info['setup']['fieldtype']){
            $fieldtype = $info['setup']['fieldtype'];
        }
        $moduleid = $info['mid'];
        $default = $info['setup']['default'];
        $field = $info['field'];
        $comment = $info['name'];
        $tablename = C('DB_PREFIX').strtolower(M('Module')->getFieldById($moduleid,'name'));
        $minlength = intval($info['minlength']);
        $maxlength = intval($info['maxlength']);
        $numbertype = $info['setup']['numbertype'];
        $oldfield = $info['oldfield'];
        $do = $doing == 'add' ? ' ADD ' : ' CHANGE `'.$oldfield.'` ';

        switch($fieldtype){
            case 'varchar':
                
                break;
            case 'title':
                if(!$maxlength) $maxlength = 255;
                $maxlength = min($maxlength,255);
                $sql[] = 'ALTER TABLE `'.$tablename.'`'.$do.'`title` VARCHAR('.$maxlength.') NOT NULL DEFAULT \'\' COMMENT \''.$comment.'\' ;';
                $sql[] = 'ALTER TABLE `'.$tablename.'`'.$do.'`title_style` VARCHAR(40) NOT NULL DEFAULT \'\' COMMENT \'样式\' ;';
                $sql[] = 'ALTER TABLE `'.$tablename.'`'.$do.'`thumb` VARCHAR(100) NOT NULL DEFAULT \'\' COMMENT \'缩略图\' ;';
                break;
            case 'catid':
                $sql = 'ALTER TABLE `'.$tablename.'`'.$do.'`'.$field.'` SMALLINT(5) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \''.$comment.'\' ;';
                break;
            default:
                break;
        }
        return $sql;
    }
}
