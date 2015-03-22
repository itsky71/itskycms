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
namespace Home\Controller;
use Think\Controller\HproseController;
/**
 * Description of ServerController
 * 
 * @author itsky
 */
class ServerController extends HproseController{
    protected $crossDomain  = TRUE;
    protected $p3p          = TRUE;
    protected $get          = TRUE;
    protected $debug        = TRUE;
    public function testa($aa=''){
        return md5($aa);
    }
    public function testb(){
        return 'testb';
    }
}
