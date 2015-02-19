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
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $this->display();
    }

    public function add(){
        $this->display('edit');
    }
}
