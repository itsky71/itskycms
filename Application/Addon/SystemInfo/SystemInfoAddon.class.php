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
namespace Addon\SystemInfo;
use Common\Controller\Addon;
/**
 * Description of InfoController
 * 系统环境信息插件
 * @author itsky
 */
class InfoController extends Addon{
    public $info = array(
        'name' => 'SystemInfo',
        'title' => '系统环境信息',
        'description' => '用于一些服务器的信息',
        'status' => 1,
        'author' => 'itsky',
        'version' => '1.0'
    );
    public function AdminIndex(){
        echo 'Addon SystemInfosss';
    }
}
