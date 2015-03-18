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
 * Description of LangController
 * 多语言管理控制器
 * @author itsky
 */
class LangController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Lang = D('Lang');
        $lists = $Lang->order('listorder,id')->select();
        foreach ($lists as $value){
            $staop = $this->vl.'&status='.$value['status'].'&id='.$value['id'];
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Lang/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Lang/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $list[] = $value;
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Lang = D('Lang');
        if(IS_POST){
            if($Lang->create()){
                if($Lang->add(I('post.'))){
                    $this->success(L('ADD_OK'),U('Lang/index',$this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Lang->getError());
            }
        }else{
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Lang = D('Lang');
        if(IS_POST){
            if($Lang->create()){
                $data = array(
                    'name' => I('post.name'),
                    'value' => I('post.value'),
                    'flag' => I('post.flag'),
                    'status' => I('post.status') ? 1 : 0
                );
                $result = $Lang->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $this->success(L('SAVE_OK'),U('Lang/index',$this->vl));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Lang->getError());
            }
        }else{
            $vo = $Lang->where('id='.I('get.id'))->find();
            $this->assign('vo', $vo);
            $this->display();
        }
    }
}
