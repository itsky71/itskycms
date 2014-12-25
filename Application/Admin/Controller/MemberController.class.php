<?php
// +----------------------------------------------------------------------
// | ITskyCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.itsky.me All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: itsky <itsky71@foxmail.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
/**
 * Description of MemberController
 * 
 * @author itsky
 */
class MemberController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $this->display();
    }
}
