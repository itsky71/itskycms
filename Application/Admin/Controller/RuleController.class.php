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
 * Description of RuleController
 * 权限节点管理控制器
 * @author itsky
 */
class RuleController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Rule = D('AuthRule');
        $rules = $Rule->order('listorder,id')->select();
        foreach ($rules as $value){
            $staop = array('id'=>$value['id'],'status'=>$value['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Rule/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Rule/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $name = explode('/', $value['name']);
            $value['m'] = $name[0];
            $value['a'] = $name[1];
            if($name[1] != 'index'){
                $value['title'] = '&emsp;&emsp;<span class="rico">├─</span> '.$value['title'];
                $rulec[] = $value;
            }else{
                $ruleg[] = $value;
            }
        }
        $this->assign('rulesg', $ruleg);
        $this->assign('rulesc', $rulec);
        $this->display();
    }

    public function order(){
        if(IS_AJAX && IS_POST){
            $Rule = D('AuthRule');
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $Rule->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'), U('Rule/index'));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function status(){
        if(IS_AJAX && IS_GET){
            $Rule = D('AuthRule');
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $Rule->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect('Rule/index');
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
