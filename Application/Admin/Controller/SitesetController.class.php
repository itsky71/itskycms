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
    //SEO 配置
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        $list = $Siteset->where('groupid=1')->select();
        $this->assign('list', $list);
        $this->display();
    }
    //添加系统变量
    public function addvar(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $Siteset = D('Siteset');
            if($Siteset->create()){
                print_r(I('post.'));
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
