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
 * Description of CategoryController
 * 栏目管理控制器类
 * @author itsky
 */
class CategoryController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(IS_POST){
            $Cat = D('Category');
            if($Cat->create(I('post.','','trim'))){
                print_r(I('post.'));
            }else{
                $this->error($Cat->getError());
            }
        }else{
            $Module = M('Module');
            $modules = $Module->where('status=1 AND type=1')->select();
            $this->assign('modules', $modules);
            $this->display('edit');
        }
    }
}
