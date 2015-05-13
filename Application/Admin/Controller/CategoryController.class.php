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
 * Description of CategoryController
 * 栏目管理控制器类
 * @author itsky
 */
class CategoryController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Cat = D('Category');
        if(IS_POST){
            $post = I('post.','','trim');
            $posts = $Cat->create($post);
            if($posts){
                $Module = M('Module');
                $posts['module'] = $Module->getFieldById($post['mid'],'name');
                $posts['dir'] = $posts['dir'] ? $posts['dir'] : $posts['module'];
                $posts['lang'] = LANG_SET;
                $id = $Cat->add($posts);
                if($id){
                    if($posts['module'] == 'Page'){
                        $posts['id'] = $id;
                        if(empty($posts['title'])) $posts['title'] = $posts['name'];
                        $Page = D('Page');
                        if($Page->create($posts)){
                            $Page->add($posts);
                        }
                    }
                    $this->success(L('ADD_OK'),U('Category/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Cat->getError());
            }
        }else{
            $Module = M('Module');
            $modules = $Module->where('status=1 AND type=1')->select();
            $Urlrule = M('Urlrule');
            $rules = $Urlrule->where('ishtml=1')->order('listorder asc')->select();
            if(I('get.lang')){
                $l = I('get.lang');
            }elseif($this->clang){
                $l = $this->clang;
            }else{
                $l = LANG_SET;
            }
            $cats = $Cat->where('status=1 AND lang=\''.$l.'\'')->order('listorder')->select();
            $tree = new \Common\Lib\Tree($cats);
            $str  = "<li data-val='\$id'>\$spacer\$name</li>";
            $this->assign('cats', $tree->get_tree(0, $str));
            $this->assign('modules', $modules);
            $this->assign('urlrules', $rules);
            $this->display('edit');
        }
    }
}
