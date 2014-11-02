<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台公共控制器
 */
class PublicController extends Controller {
    /* 登入 */
    public function login(){
        if(IS_AJAX){
            if(check_verify(I('post.verify'),1)){
                $User = M('Member');
                $is_email = $User->regex(I('post.username'),'email');
                if($is_email){
                    $resuser = $User->where('email=\''.I('post.username').'\'')->find();
                }else{
                    $resuser = $User->where('username=\''.I('post.username').'\'')->find();
                }
                if(sys_md5(I('post.password'))==$resuser['password']){
                    if(!$resuser['status']){
                        $this->error(L('USER_STOP'));
                    }
                    $data = array(
                        'login_ip' => get_client_ip(),
                        'last_login_time' => time()
                    );
                    $saveres = $User->where(array('id'=>$resuser['id']))->save($data);
                    if($saveres){
                        $User->where(array('id'=>$resuser['id']))->setInc('login_count');
                    }
                    if(I('post.keep')=='on'){
                        $crypt = new \Think\Crypt();
                        $userinfo = 'username='.$resuser['username'].'&password='.$resuser['password'];
                        $str = $crypt->encrypt($userinfo, C('DATA_AUTH_KEY').$__SERVER["HTTP_USER_AGENT"]);
                        cookie('member', $str,3600*24*15);
                    }
                    session(C('USER_AUTH_KEY'), $resuser['id']);
                    session('uname', $resuser['username']);
                    $this->success(L('LOGIN_SUCCESS'), U('Index/index'));
                }  else {
                    $this->error(L('LOGIN_ERROR'));
                }
            }else{
                $this->error(L('VERIFY_ERROR'));
            }
        }else{
            if(cookie('member') || session(C('USER_AUTH_KEY'))){
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
    /* 登出 */
    public function logout(){
        if(session(C('USER_AUTH_KEY'))){
            session('[destroy]');
            $this->redirect('Public/login');
        }else{
            $this->error(L('ALREADY_OUT'));
        }
    }
}
