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
 * Description of UpdateController
 * 更新网站控制器类
 * @author itsky
 */
class UpdateController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(IS_POST){
            if(I('showmod')){
                $module = C('DEFAULT_MODULE');
                $conpath = APP_PATH.$module.'/Conf/config'.CONF_EXT;
                if(is_file($conpath)){
                    $config = include_once $conpath;
                    C($config);
                }
                $hf = explode('.', I('htmlfile'));
                $this->buildHtml('index','./',$module.'@'.$hf[0]);
                $this->success(L('UPDATE_OK'));
            }else{
                if(is_file('./index.html')){
                    $isdel = unlink('./index.html');
                if($isdel){
                    $this->success(L('UPDATE_OK'));
                }else{
                    $this->error(L('UPDATE_ERROR'));
                }
                }else{
                    $this->success(L('UPDATE_OK'));
                }
            }
        }elseif(I('get.preview')){
            $hf = explode('.', I('get.preview'));
            echo U('Home/'.str_replace('_', '/', $hf[0]));
        }else{
            $this->display();
        }
    }

    //更新缓存
    
}
