<?php
/**
 * Description of MenuController
 * 后台管理菜单控制器类
 * @author itsky
 */
namespace Admin\Controller;
class MenuController extends AdminController{
        public function add(){
        if(IS_POST){
            $Menu = D('Menu');
            if($Menu->create()){
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => strtoupper(I('post.model')).'_'.strtoupper(I('post.action') ? I('post.action') : 'index'),
                    'model' => ucfirst(I('post.model')),
                    'action' => I('post.action') ? I('post.action') : 'index',
                    'data' => I('post.data'),
                    'remark' => I('post.remark'),
                    'status' => I('post.status') ? 1 : 0,
                    'listorder'=>0
                );
                echo LANG_PATH.'  --  '.LANG_SET;
                print_r($data);
            }else{
                $this->error($Menu->getError());
            }
        }else{
            $this->display('edit');
        }
    }
}
