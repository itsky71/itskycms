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
use Think\Controller;
/**
 * Description of EmptyController
 * 后台空控制器
 * @author itsky
 */
class EmptyController extends Controller{
    protected function _initialize() {
        if(in_array(CONTROLLER_NAME, F('modules'))){
            R('Content/'.ACTION_NAME);
            exit();
        }
    }

    public function _empty(){
        echo CONTROLLER_NAME.'/'.ACTION_NAME.'----empty';
    }

    public function index() {
        echo CONTROLLER_NAME.'/'.ACTION_NAME;
//        $e['message'] = C('ERROR_MESSAGE');
//        $this->assign('e', $e);
//        $this->display('Empty:index');
    }
}
