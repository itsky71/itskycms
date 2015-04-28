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
 * Description of ContentController
 * 
 * @author itsky
 */
class ContentController extends AdminController {
    protected function _initialize() {
        parent::_initialize();
    }

    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $this->display('Content:index');
    }

    public function add(){
        $this->display('Content:edit');
    }
}