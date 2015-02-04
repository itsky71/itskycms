<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign('home', 'http://www.baidu.com');
        $this->display();
    }
}