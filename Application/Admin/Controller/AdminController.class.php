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
use Think\Auth;
use Think\Model;
/**
 * Description of AdminController
 * 后台公用控制器类
 * @author itsky
 */
class AdminController extends Controller{
    protected $vl,$clang;
    /**
     * 后台控制器初始化
     */
    protected function _initialize(){
        //检查用户登入
        if(!session('?'.C('USER_AUTH_KEY'))){
            $this->redirect('Public/login');
        }
        //判断是否为超级管理员 若是,则跳过权限检查
        if(session('uname')==C('ADMIN_AUTH_KEY')){
            return TRUE;
        }
        //检查用户权限
        $auth = new Auth();
        $module_name = CONTROLLER_NAME.'/'.ACTION_NAME;
        if(!$auth->check($module_name, session(C('USER_AUTH_KEY')))){
            $this->error(L('_VALID_ACCESS_'));
        }
        // url 语言参数
        $this->vl = $vl = LANG_SET == accept_lang() ? '' : C('VAR_LANGUAGE').'='.LANG_SET;
        $this->assign('vl', $vl);
        //多语言操作html
        $this->clang = $clang = cookie('lang');
        $langs = '<div id="lang"><div class="btn btn-app btn-xs btn-purple ace-settings-btn">';
        $langs .= '<span class="glyphicon glyphicon-globe"></span></div><div class="lang-list">';
        foreach (S('langs') as $value){
            if(I('get.lang')){
                $btncolor = I('get.lang') == $value['value'] ? 'btn-primary' : 'btn-light';
            }else{
                if($clang){
                    $btncolor = $value['value'] == $clang ? 'btn-primary' : 'btn-light';
                }else{
                    $btncolor = $value['value'] == LANG_SET ? 'btn-primary' : 'btn-light';
                }
            }
            $langs .= '<a class="btn btn-xs '.$btncolor.' mr5 mb5" href="'.urlh($vl.'&lang='.$value['value']).'" ';
            $langs .= 'onclick="load(event,this)">'.$value['name'].'</a>';
        }
        $langs .= '</div></div>';
        $this->assign('langs', S('langs')?$langs:'');
        //多语言操作cookie
        if(array_key_exists('lang', I('get.'))){
            cookie('lang', I('get.lang'));
        }
        $this->assign('clang', $clang);
    }

    /**
     * 列表显示
     */
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Model = new Model();
        $islang = $Model->query('Describe __'.strtoupper(CONTROLLER_NAME).'__ lang');
        if($islang[0]['field'] == 'lang'){
            if(I('get.lang')){
                $wl = 'lang=\''.I('get.lang').'\'';
            }elseif($this->clang){
                $wl = 'lang=\''.$this->clang.'\'';
            }else{
                $wl = 'lang=\''.LANG_SET.'\'';
            }
        }else{
            $wl = '1';
        }
        $isorder = $Model->query('Describe __'.strtoupper(CONTROLLER_NAME).'__ listorder');
        $ol = $isorder == 'listorder' ? 'listorder,' : '';
        $name = M(CONTROLLER_NAME);
        $list = $name->where($wl)->order($ol,'id')->select();
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 添加
     */
    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $name = M(CONTROLLER_NAME);
            if($name->create()){
                if($name->add(I('post.'))){
                    $this->success(L('ADD_OK'),U(CONTROLLER_NAME.'/index',  $this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($name->getError());
            }
        }else{
            $this->display('edit');
        }
    }
    /**
     * 编辑
     */
    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $name = D(CONTROLLER_NAME);
        if(IS_POST){
            if($name->create()){
                $result = $name->where('id='.I('post.id'))->save(I('post.'));
                if($result !== FALSE){
                    $this->success(L('SAVE_OK'),U(CONTROLLER_NAME.'/index',$this->vl));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($name->getError());
            }
        }else{
            $vo = $name->where('id='.I('get.id'))->find();
            $this->assign('vo', $vo);
            $this->display();
        }
    }

    /**
     * 删除
     */
    public function del(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $name = M(CONTROLLER_NAME);
        if(IS_GET){
            $result = $name->where('id='.I('get.id'))->delete();
        }elseif(IS_POST){
            $map['id'] = array('in',I('post.ids'));
            $result = $name->where($map)->delete();
        }
        if($result !== FALSE){
            $this->success(L('DEL_OK'),U(CONTROLLER_NAME.'/index',$this->vl));
        }else{
            $this->error(L('DEL_ERROR'));
        }
    }
    /**
     * 排序
     */
    public function order(){
        if(IS_AJAX && IS_POST){
            $name = M(CONTROLLER_NAME);
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $name->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'), U(CONTROLLER_NAME.'/index',$this->vl));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
    /**
     * 状态
     */
    public function status(){
        if(IS_AJAX && IS_GET){
            $name = M(CONTROLLER_NAME);
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $name->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect(CONTROLLER_NAME.'/index',$this->vl);
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
