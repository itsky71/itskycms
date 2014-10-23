<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台公共控制器
 */
class PublicController extends Controller {
    /* 登录 */
    public function login(){
        if(IS_AJAX){
            if(check_verify(I('post.verify'),1)){
                $User = M('User');
                $is_email = $User->regex(I('post.username'),'email');
                if($is_email){
                    $resuser = $User->where('email=\''.I('post.username').'\'')->find();
                }else{
                    $resuser = $User->where('username=\''.I('post.username').'\'')->find();
                }
                if(sys_md5(I('post.password'))==$resuser['password']){
                    if(I('post.keep')=='on'){
                        $crypt = new \Think\Crypt();
                        $userinfo = 'username='.$resuser['username'].'&password='.$resuser['password'];
                        $str = $crypt->encrypt($userinfo, C('DATA_AUTH_KEY'));
                        cookie('user', $str,3600*24*15);
                    }
                    session('uid', $resuser['id']);
                    $this->success('登录成功！', U('Index/index'));
                }  else {
                    $this->error('用户名或密码错误！');
                }
            }else{
                $this->error('验证码错误！');
            }
        }else{
            if(cookie('user')){
                $this->redirect('Index/index');
            }  else {
                $this->display();
            }
        }
    }
    /*  验证码  */
    public function verify(){
        $config = array(
            'fontSize' => 16,
            'useCurve' => FALSE,
            'useNoise' => FALSE,
            'length' => 4,
            'fontttf' => '4.ttf',
            'imageH' => 33
        );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }
}
