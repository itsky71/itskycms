<?php
/**
 * Description of IndexController
 * 后台首页控制器类
 * @author itsky
 */
namespace Admin\Controller;
class IndexController extends AdminController {
//    public function index(){
//        $crypt = new \Think\Crypt();
//        echo $crypt->decrypt(cookie('user'),C('DATA_AUTH_KEY')).'<br/>';
//        echo session('username');
//        $this->display();
//    }
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