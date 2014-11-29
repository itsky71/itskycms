<?php

namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function index(){
        $this->display('Empty:index');
    }
    
    public function page(){
        $this->assign('code', I('get.code'));
        $this->display('Empty:page');
    }
}
