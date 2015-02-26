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
 * Description of MemberController
 * 会员资料管理控制器
 * @author itsky
 */
class MemberController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Member = D('Member');
        $Group = D('AuthGroup');
        if(I('get.groupid')){
            $data = $Member->join('__AUTH_GROUP_ACCESS__ ON __MEMBER__.id = __AUTH_GROUP_ACCESS__.uid')
                    ->where('group_id='.I('get.groupid'))->order('id desc')->select();
        }else{
            $data = $Member->join('__AUTH_GROUP_ACCESS__ ON __MEMBER__.id = __AUTH_GROUP_ACCESS__.uid')
                    ->order('id desc')->select();
        }
        foreach ($data as $item){
            if($item['username'] == C('ADMIN_AUTH_KEY') || $item['id'] == session(C('USER_AUTH_KEY'))){
                $disabled = ' disabled="disabled"';
            }else{
                $disabled = '';
            }
            $staop = $this->vl.'&status='.$item['status'].'&id='.$item['id'];
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Member/status',$staop).'" ';
            $allow .= 'onclick="load(event,this)"'.$disabled.'><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Member/status',$staop).'" ';
            $ban .= 'onclick="load(event,this)"'.$disabled.'><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $item['status'] = $item['status'] ? $allow.'<i class="hide">1</i>' : $ban.'<i class="hide">0</i>';
            $title = $Group->getFieldById($item['group_id'],'title');
            $item['group'] = L($title);
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
                    $this->success(L('ADD_SUCCESS'),U('Member/index',$this->vl));
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

    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Member = D('Member');
        if(IS_POST){
            if($Member->create()){
                $data = array(
                    'username' => I('post.username'),
                    'realname' => I('post.realname'),
                    'email' => I('post.email'),
                    'question' => I('post.question'),
                    'answer' => I('post.answer'),
                    'status' => I('post.status') ? 1 : 0
                );
                if(I('post.password')) $data['password'] = sys_md5(I('post.password'));
                $result = $Member->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $aga = array('group_id'=>I('post.group'));
                    M('AuthGroupAccess')->where('uid='.I('post.id'))->save($aga);
                    $this->success(L('SAVE_OK'),U('Member/index',$this->vl));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Member->getError());
            }
        }elseif(IS_GET){
            $v = $Member->where('id='.I('get.id'))->find();
            $Group = D('AuthGroup');
            $glist = $Group->where('status=1')->select();
            $vdata = $Member->where('id='.I('get.id'))
                    ->join('__AUTH_GROUP_ACCESS__ ON __MEMBER__.id = __AUTH_GROUP_ACCESS__.uid')->find();
            $this->assign('glist', $glist);
            $this->assign('gid', $vdata['group_id']);
            $this->assign('v', $v);
            $this->display();
        }
    }

    public function del(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Member = D('Member');
        $AuthGroupAccess = M('AuthGroupAccess');
        if(IS_GET){
            $result = $Member->where('id='.I('get.id'))->delete();
            $AuthGroupAccess->where('uid='.I('get.id'))->delete();
        }elseif(IS_POST){
            $map['id'] = $map2['uid'] = array('in',I('post.ids'));
            $result = $Member->where($map)->delete();
            $AuthGroupAccess->where($map2)->delete();
        }
        if($result !== FALSE){
            $this->success(L('DEL_OK'),U('Member/index',$this->vl));
        }else{
            $this->error(L('DEL_ERROR'));
        }
    }
}
