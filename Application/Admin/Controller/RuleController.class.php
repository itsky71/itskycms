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
 * Description of RuleController
 * 权限节点管理控制器
 * @author itsky
 */
class RuleController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Rule = D('AuthRule');
        $rules = $Rule->order('listorder,id')->select();
        foreach ($rules as $value){
            $staop = array('id'=>$value['id'],'status'=>$value['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Rule/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Rule/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $name = explode('/', $value['name']);
            $value['m'] = $name[0];
            $value['a'] = $name[1];
            if($name[1] != 'index'){
                $value['title'] = '&emsp;&emsp;<span class="rico">├─</span> '.L($value['title']);
                $rulec[] = $value;
            }else{
                $value['title'] = L($value['title']);
                $ruleg[] = $value;
            }
        }
        $this->assign('rulesg', $ruleg);
        $this->assign('rulesc', $rulec);
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Rule = D('AuthRule');
        if(IS_POST){
            if($Rule->create()){
                $data = array(
                    'name' => I('post.group').'/'.I('post.name'),
                    'title' => 'R_'.  strtoupper(I('post.group').'_'.I('post.name')),
                    'condition' => $_POST['condition'],
                    'status' => I('post.status') ? 1 : 0
                );
                if($Rule->add($data)){
                    $this->_write_lang(array($data['title']=>I('post.title')));
                    $this->success(L('ADD_SUCCESS'),U('Rule/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Rule->getError());
            }
        }else{
            $map['name'] = array('like','%/index');
            $group = $Rule->where($map)->order('listorder,id')->select();
            $this->assign('group', $group);
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Rule = D('AuthRule');
        if(IS_GET){
            $map['name'] = array('like','%/index');
            $group = $Rule->where($map)->select();
            $v = $Rule->where('id='.I('get.id'))->find();
            $groupname = explode('/', $v['name']);
            $v['group'] = $groupname[0];
            $v['name'] = $groupname[1];
            $this->assign('group', $group);
            $this->assign('v', $v);
            $this->display('edit');
        }elseif(IS_POST){
            if($Rule->create()){
                $data = array(
                    'name' => I('post.group').'/'.I('post.name'),
                    'title' => 'R_'.  strtoupper(I('post.group').'_'.I('post.name')),
                    'condition' => $_POST['condition'],
                    'status' => I('post.status') ? 1 : 0
                );
                $result = $Rule->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $this->_write_lang(array($data['title']=>I('post.title')));
                    $this->success(L('SAVE_OK'),U('Rule/index'));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Rule->getError());
            }
        }
    }

    public function del() {
        if(IS_AJAX && IS_GET){
            $Rule = D('AuthRule');
            $name = $Rule->getFieldById(I('get.id'),'name');
            if(substr($name, -6)=='/index'){
                $map['name'] = array('like',substr($name, 0, -6).'%');
                $result = $Rule->where($map)->delete();
            }else{
                $result = $Rule->where('id='.I('get.id'))->delete();
            }
            if($result !== FALSE){
                $this->success(L('DEL_OK'),U('Rule/index'));
            }else{
                $this->error(L('DEL_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function order(){
        if(IS_AJAX && IS_POST){
            $Rule = D('AuthRule');
            foreach (I('post.listorder') as $key => $value){
                $data['listorder'] = $value;
                $Rule->where('id='.$key)->save($data);
            }
            $this->success(L('ORDER_OK'), U('Rule/index'));
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function status(){
        if(IS_AJAX && IS_GET){
            $Rule = D('AuthRule');
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $Rule->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect('Rule/index');
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    /**
     * 编写语言文件
     * @param array $lang 语言数组
     * @param string $langpath 语言文件路径
     * @return boolean
     */
    private function _write_lang($lang,$langpath = ''){
        if(!is_array($lang)) return FALSE;
        $path = $langpath == '' ? MODULE_PATH.'Lang/'.LANG_SET.'/rule_title.php' : $langpath;
        $phpstar = '<?php'.PHP_EOL;
        $langdata = $phpstar;
        $langdata .= '$rule_title = array('.PHP_EOL;
        $rule_title = array();
        eval(str_replace($phpstar,'', read_file($path)));
        $arrdata = array_merge($rule_title, $lang);
        foreach ($arrdata as $key => $value){
            $langdata .= "    '$key' => '$value',".PHP_EOL;
        }
        $langdata .= ');';
        return write_file($path,$langdata);
    }
}
