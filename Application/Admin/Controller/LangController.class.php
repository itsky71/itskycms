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
 * Description of LangController
 * 多语言管理控制器
 * @author itsky
 */
class LangController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Lang = D('Lang');
        if(IS_POST){
            if($Lang->create()){
                if($Lang->add(I('post.'))){
                    $this->success(L('ADD_OK'),U('Lang/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Lang->getError());
            }
        }else{
            $this->display('edit');
        }
    }
}
