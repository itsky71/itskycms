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
 * Description of SitesetController
 * 站点配置控制器
 * @author itsky
 */
class SitesetController extends AdminController{
    //站点设置
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(IS_POST){
            $post = I('post.');
            $typearr = array('select','radio','checkbox');
            if(in_array($post['type'], $typearr)){
                $find = $Siteset->where('varname=\''.$post['varname'].'\'')->find();
                $rows = explode(PHP_EOL, $find['value']);
                foreach ($rows as $value){
                    $kv = explode('|', $value);
                    if($post['type'] == 'checkbox'){
                        $default = in_array($kv[1], $post['value'][$post['varname']])?'|default':'';
                    }else{
                        $default = $post['value'] == $kv[1] ? '|default' : '';
                    }
                    $kvarr[] = $kv[0].'|'.$kv[1].$default;
                }
                $data['value'] = implode(PHP_EOL, $kvarr);
            }else{
                $data['value'] = $post['value'];
            }
            $result = $Siteset->where('varname=\''.$post['varname'].'\'')->save($data);
            if($result !== FALSE){
                $this->success(L('SAVE_OK'),U('Siteset/'.I('get.action'),$this->vl));
            }else{
                $this->error(L('SAVE_ERROR'));
            }
        }else{
            if(I('get.lang')){
                $list = $Siteset->where('groupid=1 and lang=\''.I('get.lang').'\'')->order(id)->select();
            }elseif($this->clang){
                $list = $Siteset->where('groupid=1 and lang=\''.$this->clang.'\'')->order(id)->select();
            }else{
                $list = $Siteset->where('groupid=1 and lang=\''.LANG_SET.'\'')->order(id)->select();
            }
            $this->assign('list', $list);
            $this->display();
        }
    }
    //核心设置
    public function ospro(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(I('get.lang')){
            $list = $Siteset->where('groupid=2 and lang=\''.I('get.lang').'\'')->order(id)->select();
        }elseif($this->clang){
            $list = $Siteset->where('groupid=2 and lang=\''.$this->clang.'\'')->order(id)->select();
        }else{
            $list = $Siteset->where('groupid=2 and lang=\''.LANG_SET.'\'')->order(id)->select();
        }
        $this->assign('list', $list);
        $this->display('index');
    }
    //添加系统变量
    public function addvar(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $Siteset = D('Siteset');
            if($Siteset->create()){
                $data = array(
                    'varname' => I('post.varname'),
                    'info' => I('post.info'),
                    'groupid' => I('post.groupid'),
                    'type' => I('post.type'),
                    'lang' => I('post.lang'),
                    'value' => I('post.value')
                );
                if($Siteset->add($data)){
                    $this->success(L('ADD_SUCCESS'),U('Siteset/addvar',$this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Siteset->getError());
            }
        }else{
            $Menu = D('Menu');
            $group = $Menu->where('pid=5 and id<>11')->order('listorder,id')->select();
            $this->assign('group', $group);
            $this->display();
        }
    }
}
