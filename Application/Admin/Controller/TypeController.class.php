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
        $pid = I('get.pid') ? I('get.pid') : 0;
        if(I('get.lang')){
            $l = I('get.lang');
        }elseif($this->clang){
            $l = $this->clang;
        }else{
            $l = LANG_SET;
        }
        $list = $Type->where('pid='.$pid.' and lang=\''.$l.'\'')->order('listorder asc,id desc')->select();
        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->display();
    }
    
    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Type = M('Type');
        $list = $Type->field('id,pid,name')->where('status=1')->select();
        $tree = new \Common\Lib\Tree($list);
        if(IS_POST){
            if($Type->create()){
                $Model = new \Think\Model();
                $query = $Model->query("SHOW TABLE STATUS LIKE '__TYPE__'");
                $nextid = $query[0]['auto_increment'];
                $top = I('post.pid') == 0 ? $nextid : $tree->get_top(I('post.pid'));
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => I('post.name'),
                    'description' => I('post.description'),
                    'status' => I('post.status') ? 1 : 0,
                    'keyid' => $top['id'],
                    'lang'  =>  I('post.lang')
                );
                if($Type->add($data)){
                    $this->success(L('ADD_OK'),U('Type/index',$this->vl.'&pid='.$data['pid']));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Type->getError());
            }
        }else{
            $str = "<li data-val='\$id'>\$spacer\$name</li>";
            if(I('get.pid')) $this->assign('pid', I('get.pid'));
            $this->assign('pids', $tree->get_tree(0, $str));
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Type = M('Type');
        $list = $Type->field('id,pid,name')->where('status=1')->select();
        $tree = new \Common\Lib\Tree($list);
        if(IS_POST){
            if($Type->create()){
                $Model = new \Think\Model();
                $query = $Model->query("SHOW TABLE STATUS LIKE '__TYPE__'");
                $nextid = $query[0]['auto_increment'];
                $top = I('post.pid') == 0 ? $nextid : $tree->get_top(I('post.pid'));
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => I('post.name'),
                    'description' => I('post.description'),
                    'status' => I('post.status') ? 1 : 0,
                    'keyid' => $top['id'],
                    'lang'  =>  I('post.lang')
                );
                $result = $Type->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $this->success(L('SAVE_OK'),U('Type/index',$this->vl.'&pid='.$data['pid']));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Type->getError());
            }
        }else{
            $str = "<li data-val='\$id'>\$spacer\$name</li>";
            $vo  = $Type->where('id='.I('get.id'))->find();
            $this->assign('pids', $tree->get_tree(0, $str));
            $this->assign('vo', $vo);
            $this->display();
        }
    }

    public function order(){
        if(IS_AJAX && IS_POST){
            $Type = M('Type');
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $Type->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'),U('Type/index',$this->vl.'&pid='.I('get.pid')));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
