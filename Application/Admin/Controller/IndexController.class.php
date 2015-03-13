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
 * Description of IndexController
 * 后台首页控制器类
 * @author itsky
 */
class IndexController extends AdminController {
    public function index(){
        $Menu = M('Menu');
        $indexchild = $Menu->where('pid=1')->order('listorder,id')->select();
        $index = $Menu->where('id=1')->find();
        $list = $Menu->where('pid<>1 AND status=1')->order('listorder,id')->select();
        foreach ($list as $item){
            $item['name'] = L($item['name']);
            $item['icon'] = $item['icon'] ? '<span class="'.$item['icon'].'"></span>':'';
            $item['url'] = U($item['model'].'/'.$item['action'],$item['data'].'&'.$this->vl);
            $item['tar'] = $item['id'] == 1 ? 'noa' : 'tarmain';
            $newarr[] = $item;
        }
        $atag = "<a class='dropdown-toggle' href='javascript:;'>";
        $icon = "<span class='glyphicon glyphicon-menu-right'></span>";
        $icon2 = "<b class='arrow glyphicon glyphicon-menu-down'></b>";
        $li = array(
            array(
                'folder' => $atag."\$icon<span class='menu-text'>\$name</span>".$icon2."</a>",
                'file' => "<a class='\$tar' href='\$url'>\$icon<span class='menu-text'>\$name</span></a>"
            ),
            array(
                'folder' => $atag.$icon."\$icon \$name<b class='arrow glyphicon glyphicon-menu-down'></b></a>",
                'file' => "<a class='tarmain' href='\$url'>".$icon." \$icon \$name</a>"
            ),
            array(
                'folder' => $atag."\$icon\$name<b class='arrow glyphicon glyphicon-menu-down'></b></a>",
                'file' => "<a class='tarmain' href='\$url'>\$icon\$name</a>"
            )
        );
        $tree = new \Common\Lib\Tree($newarr);
        $Lang = D('Lang');
        if(!S('langs')){
            $langs = $Lang->where('status=1')->order('listorder,id')->select();
            S('langs',$langs);
        }
        $tlang = $Lang->where('value=\''.LANG_SET.'\'')->find();
        $this->assign('tlang', $tlang);
        $this->assign('mlang', S('langs'));
        $this->assign('indexchild', $indexchild);
        $this->assign('index', $index);
        $this->assign('list', $tree->get_backnav(0,'','nav nav-list',$li));
        $this->display();
    }
    //个人信息
    public function profile(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $Member = D('Member');
            if($Member->create()){
                $Member->save();
                $this->success(L('EDIT_OK'),U('Index/profile',  $this->vl));
            }else{
                $this->error($Member->getError());
            }
        }else{
            $Member = M('Member');
            $vo = $Member->getById(session(C('USER_AUTH_KEY')));
            $this->assign('vo', $vo);
            $this->display();
        }
    }
}