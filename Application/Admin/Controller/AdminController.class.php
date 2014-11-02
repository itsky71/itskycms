<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
/**
 * 后台首页控制器
 */
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
        
        /*if(C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))){
            if(!Rbac::AccessDecision()){
                //检查认证识别号
                if(!session(C('USER_AUTH_KEY'))){
                    $this->redirect(MODULE_NAME.C('USER_AUTH_GATEWAY'));
                }
                //没有权限 抛出错误
                if(C('RBAC_ERROR_PAGE')){
                    //定义权限错误页面
                    $this->redirect(C('RBAC_ERROR_PAGE'));
                }  else {
                    if(C('GUEST_AUTH_ON')){
                        $this->assign('jumpUrl', MODULE_NAME.C('USER_AUTH_GATEWAY'));
                    }
                    //提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }*/
    }
    
    public function index(){
        $this->display();
    }
}
