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
 * Description of MemberController
 * 
 * @author itsky
 */
class MemberController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Member = D('Member');
        $Group = D('AuthGroup');
        $data = $Member->order('id desc')->select();
        foreach ($data as $item){
            $staop = array('id'=>$item['id'],'status'=>$item['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Member/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Member/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $item['status'] = $item['status'] ? $allow.'<i class="hide">1</i>' : $ban.'<i class="hide">0</i>';
            $item['group'] = $Group->getFieldById($item['id'],'title');
            $list[] = $item;
        }
        $this->assign('list', $list);
        $this->display();
    }
}
