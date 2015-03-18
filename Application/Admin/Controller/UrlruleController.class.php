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
 * Description of UrlruleController
 * URL规则控制器类
 * @author itsky
 */
class UrlruleController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Urlrule = D('Urlrule');
        $list = $Urlrule->order('listorder,id desc')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(IS_POST){
            $Urlrule = D('Urlrule');
            if($Urlrule->create()){
                if($Urlrule->add(I('post.'))){
                    $this->success(L('ADD_OK'),U('Urlrule/index', $this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Urlrule->getError());
            }
        }else{
            $this->display('edit');
        }
    }
    
    public function edit() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Urlrule = D('Urlrule');
        if(IS_POST){
            if($Urlrule->create()){
                print_r(I('post.'));
            }else{
                $this->error($Urlrule->getError());
            }
        }else{
            $v = $Urlrule->where('id='.I('get.id'))->find();
            $this->assign('v', $v);
            $this->display();
        }
    }
}
