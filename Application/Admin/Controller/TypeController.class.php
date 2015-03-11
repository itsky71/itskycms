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
 * Description of TypeController
 * 类别管理控制器类
 * @author itsky
 */
class TypeController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Type = M('Type');
        $list = $Type->where('pid=0')->order('listorder asc,id desc')->select();
        $this->assign('list', $list);
        $this->display();
    }
    
    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Type = M('Type');
        $list = $Type->field('id,pid,name')->where('status=1')->select();
        $tree = new \Common\Lib\Tree($list);
        if(IS_POST){
            if($Type->create()){
                $top = $tree->get_top(I('post.pid'));
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => I('post.name'),
                    'description' => I('post.description'),
                    'status' => I('post.status') ? 1 : 0,
                    'keyid' => $top['id']
                );
                if($Type->add($data)){
                    $this->success(L('ADD_OK'),U('Type/index',$this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Type->getError());
            }
        }else{
            $str = "<li data-val='\$id'>\$spacer\$name</li>";
            $this->assign('pids', $tree->get_tree(0, $str));
            $this->display('edit');
        }
    }
}
