<?php
namespace Admin\Controller;
//use Admin\AdminController;
class IndexController extends AdminController {
    public function index(){
//        $crypt = new \Think\Crypt();
//        echo $crypt->decrypt(cookie('user'),C('DATA_AUTH_KEY')).'<br/>';
//        echo session('username');
        $this->display();
    }
}