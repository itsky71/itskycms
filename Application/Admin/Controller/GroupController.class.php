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
 * Description of GroupController
 * 会员组管理控制器
 * @author itsky
 */
class GroupController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Group = D('AuthGroup');
        $groups = $Group->select();
        foreach ($groups as $value){
            $staop = array('id'=>$value['id'],'status'=>$value['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Group/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Group/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $list[] = $value;
        }
        $this->assign('list', $list);
        $this->display();
    }
}
