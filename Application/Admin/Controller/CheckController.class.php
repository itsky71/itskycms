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
use Think\Controller;
/**
 * Description of CheckController
 * 验证字段控制器类
 * @author itsky
 */
class CheckController extends Controller{
    /** 验证菜单名称 */
    public function action(){
        if(IS_AJAX && IS_POST){
            $Menu = D('Menu');
            $map = array(
                'model' => ucfirst(I('post.model')),
                'action' => I('post.action') ? strtolower(I('post.action')) : 'index'
            );
            if(I('post.id')){
                $map['id'] = array('neq',I('post.id'));
            }
            $res = $Menu->where($map)->find();
            if($res){
                echo json_encode(array('error'=>L('ACTIONU')));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /** 验证权限节点名称 */
    public function name(){
        if(IS_AJAX && IS_POST){
            $Rule = D('AuthRule');
            $map['name'] = I('post.group').'/'.I('post.name');
            if(I('post.id')) $map['id'] = array('neq',I('post.id'));
            $res = $Rule->where($map)->find();
            if($res) echo json_encode(array('error'=>L('NAMEU')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /** 验证用户名 */
    public function username(){
        if(IS_AJAX && IS_POST){
            $Member = D('Member');
            $map['username'] = I('post.username');
            if(I('post.id')) $map['id'] = array('neq',I('post.id'));
            $res = $Member->where($map)->find();
            if($res) echo json_encode(array('error'=>L('USERNAMEU')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /** 验证邮箱 */
    public function email(){
        if(IS_AJAX && IS_POST){
            $Member = D('Member');
            $map['email'] = I('post.email');
            if(I('post.id')) $map['id'] = array('neq',I('post.id'));
            $res = $Member->where($map)->find();
            if($res) echo json_encode(array('error'=>L('EMAILU')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /** 验证多语言名称 */
    public function langname(){
        if(IS_AJAX && IS_POST){
            $Lang = D('Lang');
            $map['name'] = I('post.name');
            if(I('post.id')) $map['id'] = array('neq',I('post.id'));
            $res = $Lang->where($map)->find();
            if($res) echo json_encode(array('error'=>L('LANG_NAMEU')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /** 验证多语言名称 */
    public function langval(){
        if(IS_AJAX && IS_POST){
            $Lang = D('Lang');
            $map['value'] = I('post.value');
            if(I('post.id')) $map['id'] = array('neq',I('post.id'));
            $res = $Lang->where($map)->find();
            if($res) echo json_encode(array('error'=>L('LANG_VALUEU')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    /** 通用验证唯一 */
    public function unique(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Name = M(ucfirst(I('get.model')));
        $fields = I('post.');
        $keys = array_keys($fields);
        $map[$keys[0]] = $fields[$keys[0]];
        if($fields['id']) $map['id'] = array('neq',$fields['id']);
        $res = $Name->where($map)->find();
        if($res) echo json_encode(array('error'=>L('UNIQUE')));
    }
}
