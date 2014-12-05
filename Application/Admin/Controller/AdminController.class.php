<?php
/**
 * Description of AdminController
 * 后台公用控制器类
 * @author itsky
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class AdminController extends Controller{
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
    }

    /**
     * 列表显示
     */
    public function index(){
        $this->display();
    }

    /**
     * 添加
     */
    public function add(){
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
     * 删除
     */
    public function del(){
        if(IS_AJAX && IS_GET){
            $name = M(CONTROLLER_NAME);
            $result = $name->where('id='.I('get.id'))->delete();
            if($result !== FALSE){
                $this->success(L('DEL_OK'),U(CONTROLLER_NAME.'/index'));
            }else{
                $this->error(L('DEL_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
