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
 * Description of EmptyController
 * 后台空控制器
 * @author itsky
 */
class EmptyController extends AdminController{
    public function index() {
        $e['message'] = C('ERROR_MESSAGE');
        $this->assign('e', $e);
        $this->display('Empty:index');
    }
}
