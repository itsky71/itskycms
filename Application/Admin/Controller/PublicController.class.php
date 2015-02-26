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
use Think\Controller;
/**
 * Description of PublicController
 * 后台公共控制器
 * @author itsky
 */
class PublicController extends Controller {
    protected $vl;
    public function _initialize(){
        $this->vl = $vl = LANG_SET == accept_lang() ? '' : C('VAR_LANGUAGE').'='.LANG_SET;
        $this->assign('vl', $vl);
    }
    /* 登入 */
    public function login(){
        if(IS_AJAX){
            if(check_verify(I('post.verify'),1)){
                $Member = M('Member');
                $is_email = $Member->regex(I('post.username'),'email');
                if($is_email){
                    $resuser = $Member->where('email=\''.I('post.username').'\'')->find();
                }else{
                    $resuser = $Member->where('username=\''.I('post.username').'\'')->find();
                }
                if(sys_md5(I('post.password'))==$resuser['password']){
                    if(!$resuser['status']){
                        $this->error(L('USER_STOP'));
                    }
                    $data = array(
                        'login_ip' => get_client_ip(),
                        'last_login_time' => time()
                    );
                    $saveres = $Member->where(array('id'=>$resuser['id']))->save($data);
                    if($saveres){
                        $Member->where(array('id'=>$resuser['id']))->setInc('login_count');
                    }
                    if(I('post.keep')=='on'){
                        $crypt = new \Think\Crypt();
                        $userinfo = array(
                            'username' => $crypt->encrypt($resuser['username'],
                                    sys_md5(C('DATA_AUTH_KEY'), 'isky71'), 3600*24*15),
                            'password' => $crypt->encrypt($resuser['password'],
                                    sys_md5(C('DATA_AUTH_KEY'), 'CMS'), 3600*24*15)
                        );
                        $str = $crypt->encrypt(json_encode($userinfo), C('DATA_AUTH_KEY').$__SERVER["HTTP_USER_AGENT"]);
                        cookie('member', $str,3600*24*15);
                    }
                    session(C('USER_AUTH_KEY'), $resuser['id']);
                    session('uname', $resuser['username']);
                    $this->success(L('LOGIN_SUCCESS'), U('Index/index',$this->vl));
                }  else {
                    $this->error(L('LOGIN_ERROR'));
                }
            }else{
                $this->error(L('VERIFY_ERROR'));
            }
        }else{
            if(session(C('USER_AUTH_KEY'))){
                $this->redirect('Index/index');
            }elseif(cookie('member')){
                $crypt = new \Think\Crypt();
                $userjson = $crypt->decrypt(cookie('member'), C('DATA_AUTH_KEY').$__SERVER["HTTP_USER_AGENT"]);
                $userarr = json_decode($userjson, TRUE);
                foreach ($userarr as $key => $value){
                    if($key == 'username') $uname = $crypt->decrypt($value, sys_md5(C('DATA_AUTH_KEY'), 'isky71'));
                    if($key == 'password') $pwd = $crypt->decrypt($value, sys_md5(C('DATA_AUTH_KEY'), 'CMS'));
                }
                $Member = M('Member');
                $ures = $Member->where('username=\''.$uname.'\'')->find();
                if($ures && $ures['password'] == $pwd){
                    session(C('USER_AUTH_KEY'), $ures['id']);
                    session('uname', $ures['username']);
                    $this->redirect('Index/index');
                }else{
                    cookie(NULL);
                    $this->display();
                }
            }else {
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
            cookie(NULL);
            session('[destroy]');
            $this->redirect('Public/login');
        }else{
            $this->error(L('ALREADY_OUT'));
        }
    }
    /** js语言 **/
    public function langjs(){
        $this->display();
    }
}
