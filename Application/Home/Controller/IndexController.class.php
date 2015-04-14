<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        vendor('Hprose.Hprose',COMMON_PATH.'Vendor/');
        $server = new \HproseHttpServer();
        $server->addFunction('md5');
        $server->start();
//        echo ' a';
//        $model = new \Think\Model();
//        $sql = 'ALTER TABLE `ta_article` ADD `bbc` TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\' ;';
//        $res = $model->execute($sql);
//        if(FALSE === $res){
//            $this->error($model->getDbError());
//        }
        //$this->assign('home', 'http://www.baidu.com');
        //$this->display();
    }
}