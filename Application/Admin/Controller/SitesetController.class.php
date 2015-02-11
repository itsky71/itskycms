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
 * Description of SitesetController
 * 站点配置控制器
 * @author itsky
 */
class SitesetController extends AdminController{
    //站点设置
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(IS_POST){
            $post = I('post.');
            if($post['varname'] == 'mail_to'){
                $body = '<h2>这是一份系统测试邮件！</h2>';
                $configs = array(
                    'mail_type' => 3,
                    'mail_auth' => TRUE,
                    'mail_server' => 'smtp.qq.com',
                    'mail_port' => 25,
                    'mail_user' => 'itsky71@foxmail.com',
                    'mail_password' => 'jingfing008-',
                    'mail_from' => 'itsky71@foxmail.com',
                    'site_name' => 'ITskyCMS系统'
                );
                $sendres = sendmail($post['value'], '测试邮件', $body, $configs);
                if($sendres === TRUE){
                    $resdata = array(
                        'info' => L('SEND_OK'),
                        'status' => 1,
                        'send' => 1
                    );
                    $this->ajaxReturn($resdata);
                }else{
                    $this->error($sendres);
                }
            }
            $typearr = array('select','radio','checkbox');
            if(in_array($post['type'], $typearr)){
                $find = $Siteset->where('varname=\''.$post['varname'].'\'')->find();
                $rows = explode(PHP_EOL, $find['value']);
                foreach ($rows as $value){
                    $kv = explode('|', $value);
                    if($post['type'] == 'checkbox'){
                        $default = in_array($kv[1], $post['value'][$post['varname']])?'|default':'';
                    }else{
                        $default = $post['value'] == $kv[1] ? '|default' : '';
                    }
                    $kvarr[] = $kv[0].'|'.$kv[1].$default;
                }
                $data['value'] = implode(PHP_EOL, $kvarr);
            }else{
                $data['value'] = $post['value'];
            }
            $result = $Siteset->where('varname=\''.$post['varname'].'\'')->save($data);
            if($result !== FALSE){
                $this->success(L('SAVE_OK'),U('Siteset/'.I('get.action'),$this->vl));
            }else{
                $this->error(L('SAVE_ERROR'));
            }
        }else{
            if(I('get.lang')){
                $l = I('get.lang');
            }elseif($this->clang){
                $l = $this->clang;
            }else{
                $l = LANG_SET;
            }
            $list = $Siteset->where('groupid=1 and lang=\''.$l.'\'')->order(id)->select();
            $this->assign('list', $list);
            $this->display();
        }
    }
    //核心设置
    public function ospro(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(I('get.lang')){
            $l = I('get.lang');
        }elseif($this->clang){
            $l = $this->clang;
        }else{
            $l = LANG_SET;
        }
        $langs = S('langs');
        $where['lang'] = $l;
        $where['varname'] = 'default_lang';
        $varlangs = $Siteset->where($where)->field('value')->find();
        $langa = formrows($varlangs['value'], 'select');
        $default = formrows($varlangs['value'], 'select',1);
        foreach ($langs as $value){
            $langb[$value['value']] = $value['name'];
        }
        if(!arrequal($langa, $langb)){
            foreach ($langb as $key=>$value){
                if($key == $default){
                    $de = '|default';
                    $langsval .= $value.'|'.$key.$de.'PHP_EOL';
                }else{
                    $langsval .= $value.'|'.$key.'PHP_EOL';
                }
            }
            $langval = str_replace('PHP_EOL', PHP_EOL, substr($langsval, 0, -7));
            $Siteset->where($where)->save(array('value'=>$langval));
        }
        $list = $Siteset->where('groupid=2 and lang=\''.$l.'\'')->order(id)->select();
        $this->assign('list', $list);
        $this->display('index');
    }
    //系统邮箱
    public function osemail(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(I('get.lang')){
            $l = I('get.lang');
        }elseif($this->clang){
            $l = $this->clang;
        }else{
            $l = LANG_SET;
        }
        $list = $Siteset->where('groupid=3 and lang=\''.$l.'\'')->order(id)->select();
        $this->assign('list', $list);
        $this->display('index');
    }
    //添加系统变量
    public function addvar(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $Siteset = D('Siteset');
            if($Siteset->create()){
                $data = array(
                    'varname' => I('post.varname'),
                    'info' => I('post.info'),
                    'groupid' => I('post.groupid'),
                    'type' => I('post.type'),
                    'lang' => I('post.lang'),
                    'value' => I('post.value')
                );
                if($Siteset->add($data)){
                    $this->success(L('ADD_SUCCESS'),U('Siteset/addvar',$this->vl));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Siteset->getError());
            }
        }else{
            $Menu = D('Menu');
            $group = $Menu->where('pid=5 and id<>11')->order('listorder,id')->select();
            $this->assign('group', $group);
            $this->display();
        }
    }
    //附件配置
    public function attach(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Siteset = D('Siteset');
        if(I('get.lang')){
            $l = I('get.lang');
        }elseif($this->clang){
            $l = $this->clang;
        }else{
            $l = LANG_SET;
        }
        $list = $Siteset->where('groupid=4 and lang=\''.$l.'\'')->order(id)->select();
        $this->assign('list', $list);
        $this->display('index');
    }
}
