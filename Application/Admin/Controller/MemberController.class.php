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
        $data = $Member->join('__AUTH_GROUP_ACCESS__ ON __MEMBER__.id = __AUTH_GROUP_ACCESS__.uid')->order('id desc')->select();
        foreach ($data as $item){
            $staop = array('id'=>$item['id'],'status'=>$item['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Member/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Member/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $item['status'] = $item['status'] ? $allow.'<i class="hide">1</i>' : $ban.'<i class="hide">0</i>';
            $item['group'] = $Group->getFieldById($item['group_id'],'title');
            $list[] = $item;
        }
        $this->assign('list', $list);
        $this->display();
    }
    
    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Member = D('Member');
        if(IS_POST){
            if($Member->create()){
                $data = array(
                    'username' => I('post.username'),
                    'password' => sys_md5(I('post.password')),
                    'realname' => I('post.realname'),
                    'email' => I('post.email'),
                    'question' => I('post.question'),
                    'answer' => I('post.answer'),
                    'status' => I('post.status') ? 1 : 0,
                    'regtime' => time()
                );
                $insertId = $Member->add($data);
                if($insertId){
                    $aga = array('uid'=>$insertId,'group_id'=>I('post.group'));
                    M('AuthGroupAccess')->add($aga);
                    $this->success(L('ADD_SUCCESS'),U('Member/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Member->getError());
            }
        }else{
            $Group = D('AuthGroup');
            $glist = $Group->where('status=1')->select();
            $this->assign('glist', $glist);
            $this->display('edit');
        }
    }
}
