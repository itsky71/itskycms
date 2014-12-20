<?php
// +----------------------------------------------------------------------
// | ITskyCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.itsky.me All rights reserved.
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
            $item['url'] = U($item['model'].'/'.$item['action']);
            $item['tar'] = $item['id'] == 1 ? 'noa' : 'tarmain';
            $newarr[] = $item;
        }
        $li = array(
            array(
                'folder' => "<a class='dropdown-toggle' href='javascript:;'>\$icon<span class='menu-text'>\$name</span><b class='arrow glyphicon glyphicon-chevron-down'></b></a>",
                'file' => "<a class='\$tar' href='\$url'>\$icon<span class='menu-text'>\$name</span></a>"
            ),
            array(
                'folder' => "<a class='dropdown-toggle' href='javascript:;'><span class='glyphicon glyphicon-chevron-right'></span>\$icon \$name<b class='arrow glyphicon glyphicon-chevron-down'></b></a>",
                'file' => "<a class='tarmain' href='\$url'><span class='glyphicon glyphicon-chevron-right'></span> \$icon \$name</a>"
            ),
            array(
                'folder' => "<a class='dropdown-toggle' href='javascript:;'>\$icon\$name<b class='arrow glyphicon glyphicon-chevron-down'></b></a>",
                'file' => "<a class='tarmain' href='\$url'>\$icon\$name</a>"
            )
        );
        $tree = new \Common\Lib\Tree($newarr);
        $this->assign('indexchild', $indexchild);
        $this->assign('index', $index);
        $this->assign('list', $tree->get_backnav(0,'','nav nav-list',$li));
        $this->display();
    }
    //个人信息
    public function profile(){
        if(IS_POST){
            $Member = D('Member');
            if($Member->create()){
                $Member->save();
                $this->success('修改成功！',U('Index/profile'));
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
    //验证用户名和邮箱的唯一性
    public function check(){
        $Member = D('Member');
        $res = $Member->checkFiledOne(I('post.'));
        if(!$res['res']){
            $data = array('error'=>L($res['vfiled']).'已被占用！');
            $this->ajaxReturn($data);
        }
    }
}