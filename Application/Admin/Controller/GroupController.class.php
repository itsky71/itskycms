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
 * Description of GroupController
 * 会员组管理控制器
 * @author itsky
 */
class GroupController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Group = D('AuthGroup');
        $groups = $Group->select();
        foreach ($groups as $value){
            $staop = array('id'=>$value['id'],'status'=>$value['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Group/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Group/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $list[] = $value;
        }
        $this->assign('list', $list);
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        if(IS_POST){
            $Group = D('AuthGroup');
            if($Group->create()){
                $Model = new \Think\Model();
                $query = $Model->query("SHOW TABLE STATUS LIKE '__AUTH_GROUP__'");
                $nextid = $query[0]['auto_increment'];
                $data = array(
                    'title' => 'A_G_T_'.$nextid,
                    'remark' => 'A_G_R_'.$nextid,
                    'status' => I('post.status') ? 1 : 0
                );
                if($Group->add($data)){
                    $info[$data['title']] = I('post.title');
                    $info[$data['remark']] = addcslashes(I('post.remark','',NULL),'\'\\');
                    $this->_write_lang($info);
                    $this->success(L('ADD_SUCCESS'),U('Group/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Group->getError());
            }
        }else{
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Group = D('AuthGroup');
        if(IS_POST){
            if($Group->create()){
                $data = array(
                    'title' => 'A_G_T_'.I('post.id'),
                    'remark' => 'A_G_R_'.I('post.id'),
                    'status' => I('post.status') ? 1 : 0
                );
                $result = $Group->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $info[$data['title']] = I('post.title');
                    $info[$data['remark']] = addcslashes(I('post.remark','',NULL),'\'\\');
                    $this->_write_lang($info);
                    $this->success(L('SAVE_OK'),U('Group/index'));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Group->getError());
            }
        }else{
            $v = $Group->where('id='.I('get.id'))->find();
            $this->assign('v', $v);
            $this->display();
        }
    }

    public function del(){
        if(IS_AJAX && IS_GET){
           $Group = D('AuthGroup');
           $result = $Group->where('id='.I('get.id'))->delete();
           if($result !== FALSE){
                $this->success(L('DEL_OK'),U('Group/index'));
            }else{
                $this->error(L('DEL_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function status() {
        if(IS_AJAX && IS_GET){
            $Group = D('AuthGroup');
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $Group->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect('Group/index');
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function access(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Group = D('AuthGroup');
        if(IS_POST){
            $rules = I('post.id') ? I('post.id') : array();
            sort($rules,SORT_NUMERIC);
            $data['rules'] = implode(',', $rules);
            $result = $Group->where('id='.I('post.gid'))->save($data);
            if($result !== FALSE){
                $this->success(L('ACCESS_OK'),U('Group/index'));
            }else{
                $this->error(L('ACCESS_ERROR'));
            }
        }else{
            $v = $Group->where('id='.I('get.id'))->find();
            $rules = explode(',', $v['rules']);
            $Menu = D('Menu');
            $top = $Menu->where('pid=0')->field('name')->select();
            $Rule = D('AuthRule');
            $rlist = $Rule->where('status=1')->order('listorder,id')->select();
            $this->assign('v', $v);
            $this->assign('rules', $rules);
            $this->assign('top', $top);
            $this->assign('rlist', $rlist);
            $this->display();
        }
    }

    /**
     * 编写语言文件
     * @param array $lang 语言数组
     * @param string $langpath 语言文件路径
     * @return boolean
     */
    private function _write_lang($lang,$langpath = ''){
        if(!is_array($lang)){
            return FALSE;
        }
        $path = $langpath == '' ? MODULE_PATH.'Lang/'.LANG_SET.'/group_title.php' : $langpath;
        $phpstar = '<?php'.PHP_EOL;
        $langdata = $phpstar;
        $langdata .= '$group_title = array('.PHP_EOL;
        $group_title = array();
        eval(str_replace($phpstar,'', read_file($path)));
        $arrdata = array_merge($group_title, $lang);
        foreach ($arrdata as $key => $value){
            $langdata .= "    '$key' => '".addcslashes(stripslashes($value),'\'\\')."',".PHP_EOL;
        }
        $langdata .= ');';
        return write_file($path,$langdata);
    }
}
