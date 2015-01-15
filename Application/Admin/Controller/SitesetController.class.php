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
 * Description of SitesetController
 * 站点配置控制器
 * @author itsky
 */
class SitesetController extends AdminController{
    //SEO 配置
    public function index(){
        $Siteset = M('Siteset');
        $list = $Siteset->where('groupid=1')->select();
        $orther = $Siteset->where('groupid>6')->select();
        $this->assign('list', $list);
        $this->assign('orther', $orther);
        $this->display();
    }
}
