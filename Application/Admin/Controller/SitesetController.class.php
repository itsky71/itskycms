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
        $this->display();
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
