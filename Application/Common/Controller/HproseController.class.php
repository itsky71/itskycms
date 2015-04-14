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
namespace Common\Controller;
/**
 * Description of HproseController
 * Hprose 控制器类
 * @author itsky
 */
class HproseController {
    protected $allowMethodList  =   array();
    protected $crossDomain      =   false;
    protected $P3P              =   false;
    protected $get              =   true;
    protected $debug            =   false;
    /**
     * 架构函数
     */
    public function __construct() {
        //控制器初始化
        if(method_exists($this, '_initialize')){
            $this->_initialize();
        }
        //导入类库
        vendor('Hprose.Hprose',COMMON_PATH.'Vendor/');
        //实例化HproseHttpServer
        $server = new \HproseHttpServer();
        if(empty($this->allowMethodList)){
            $methods = get_class_methods($this);
            $methods = array_diff($methods, array('__construct','__call','_initialize'));
        }else{
            $methods = $this->allowMethodList;
        }
        $server->addMethods($methods, $this);
        if(APP_DEBUG || $this->debug){
            $server->setDebugEnabled(TRUE);
        }
        //Hprose设置
        $server->setCrossDomainEnabled($this->crossDomain);
        $server->setP3PEnabled($this->P3P);
        $server->setGetEnabled($this->get);
        //启动server
        $server->start();
    }
    public function __call($method, $args) {}
}