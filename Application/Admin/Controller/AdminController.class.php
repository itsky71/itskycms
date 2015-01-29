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
use Think\Auth;
/**
 * Description of AdminController
 * 后台公用控制器类
 * @author itsky
 */
class AdminController extends Controller{
    protected $vl;
    /**
     * 后台控制器初始化
     */
    protected function _initialize(){
        //检查用户登入
        if(!session('?'.C('USER_AUTH_KEY'))){
            $this->redirect('Public/login');
        }
        //判断是否为超级管理员 若是,则跳过权限检查
        if(session('uname')==C('ADMIN_AUTH_KEY')){
            return TRUE;
        }
        //检查用户权限
        $auth = new Auth();
        $module_name = CONTROLLER_NAME.'/'.ACTION_NAME;
        if(!$auth->check($module_name, session(C('USER_AUTH_KEY')))){
            $this->error(L('_VALID_ACCESS_'));
        }
        $this->vl = $vl = LANG_SET == accept_lang() ? '' : C('VAR_LANGUAGE').'='.LANG_SET;
        $this->assign('vl', $vl);
    }

    /**
     * 列表显示
     */
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $this->display();
    }

    /**
     * 添加
     */
    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $name = M(CONTROLLER_NAME);
            if($name->create()){
                
            }else{
                $this->error($name->getError());
            }
        }else{
            $this->display('edit');
        }
    }
    /**
     * 编辑
     */
    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $name = D(CONTROLLER_NAME);
        if(IS_POST){
            if($name->create()){
                $result = $name->where('id='.I('post.id'))->save(I('post.'));
                if($result !== FALSE){
                    $this->success(L('SAVE_OK'),U(CONTROLLER_NAME.'/index',$this->vl));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($name->getError());
            }
        }else{
            $vo = $name->where('id='.I('get.id'))->find();
            $this->assign('vo', $vo);
            $this->display();
        }
    }

    /**
     * 删除
     */
    public function del(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $name = M(CONTROLLER_NAME);
        if(IS_GET){
            $result = $name->where('id='.I('get.id'))->delete();
        }elseif(IS_POST){
            $map['id'] = array('in',I('post.ids'));
            $result = $name->where($map)->delete();
        }
        if($result !== FALSE){
            $this->success(L('DEL_OK'),U(CONTROLLER_NAME.'/index',$this->vl));
        }else{
            $this->error(L('DEL_ERROR'));
        }
    }
    /**
     * 排序
     */
    public function order(){
        if(IS_AJAX && IS_POST){
            $name = M(CONTROLLER_NAME);
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $name->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'), U(CONTROLLER_NAME.'/index',$this->vl));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /**
     * 状态
     */
    public function status(){
        if(IS_AJAX && IS_GET){
            $name = M(CONTROLLER_NAME);
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $name->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect(CONTROLLER_NAME.'/index',$this->vl);
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
