<?php
/**
 * Description of MenuController
 * 后台管理菜单控制器类
 * @author itsky
 */
namespace Admin\Controller;
class MenuController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Menu = D('Menu');
        $allmenu = $Menu->order('listorder,id')->select();
        foreach ($allmenu as $value){
            $value['status'] = $value['status'] ? '<span class="green">启用</span>' : '<span class="red">禁用</span>';
            $value['name'] = $value['icon'] ? '<span class="'.$value['icon'].'"></span> '.L($value['name']) : L($value['name']);
            $value['oper'] = '<a class="btn btn-primary btn-minier" href="'.U('Menu/add',array('id'=>$value['id'])).'" onclick="load(event,this)"><span class="glyphicon glyphicon-plus"></span></a> ';
            $value['oper'] .= '<a class="btn btn-success btn-minier" href="'.U('Menu/edit',array('id'=>$value['id'])).'" onclick="load(event,this)"><span class="glyphicon glyphicon-edit"></span></a> ';
            $value['oper'] .= '<a class="btn btn-danger btn-minier" href="'.U('Menu/del',array('id'=>$value['id'])).'" onclick="del(event,this,\'p\')"> <span class="glyphicon glyphicon-trash"></span> </a> ';
            $narr[] = $value;
        }
        $tree = new \Common\Lib\Tree($narr);
        $str = "<tr><td class='center'><input type='text' maxlength='3' name='listorder[\$id]' value='\$listorder'/></td>";
        $str .= "<td class='center'>\$id</td><td>\$spacer \$name</td><td>\$model</td><td>\$action</td>";
        $str .= "<td class='center'>\$status</td><td class='center'>\$oper</td></tr>";
        $this->assign('mtree', $tree->get_tree(0, $str));
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Menu = D('Menu');
        if(IS_POST){
            if($Menu->create()){
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => 'M_'.strtoupper(I('post.model')).'_'.strtoupper(I('post.action') ? I('post.action') : 'index'),
                    'icon' => I('post.icon'),
                    'model' => ucfirst(I('post.model')),
                    'action' => I('post.action') ? strtolower(I('post.action')) : 'index',
                    'data' => I('post.data'),
                    'remark' => I('post.remark'),
                    'status' => I('post.status') ? 1 : 0,
                    'listorder' => 0
                );
                if($Menu->add($data)){
                    $rname = I('post.realname');
                    $this->_write_lang(array($data['name']=>$rname[LANG_SET]));
                    $this->success(L('ADD_SUCCESS'),U('Menu/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Menu->getError());
            }
        }else{
            $map = $Menu->where('status=1')->order('listorder,id')->select();
            foreach ($map as $r){
                $r['name'] = L($r['name']);
                $newmap[] = $r;
            }
            $tree = new \Common\Lib\Tree($newmap);
            $str  = "<option value='\$id' \$selected>\$spacer\$name</option>";
            $this->assign('map', $tree->get_tree(0, $str));
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Menu = D('Menu');
        if(IS_GET){
            $vo = $Menu->where('id='.I('get.id'))->find();
            $map = $Menu->where('status=1')->select();
            foreach ($map as $r){
                $r['name'] = L($r['name']);
                $newmap[] = $r;
            }
            $tree = new \Common\Lib\Tree($newmap);
            $str  = "<option value='\$id' \$selected>\$spacer\$name</option>";
            $this->assign('map', $tree->get_tree(0, $str, $vo['pid']));
            $this->assign('vo', $vo);
            $this->display();
        }elseif(IS_POST){
            if($Menu->create()){
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => 'M_'.strtoupper(I('post.model')).'_'.strtoupper(I('post.action') ? I('post.action') : 'index'),
                    'icon' => I('post.icon'),
                    'model' => ucfirst(I('post.model')),
                    'action' => I('post.action') ? strtolower(I('post.action')) : 'index',
                    'data' => I('post.data'),
                    'remark' => I('post.remark'),
                    'status' => I('post.status') ? 1 : 0,
                    'listorder' => 0
                );
                $result = $Menu->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $rname = I('post.realname');
                    $this->_write_lang(array($data['name']=>$rname[LANG_SET]));
                    $this->success(L('SAVE_OK'),U('Menu/index'));
                }else{
                    $this->error(L('SAVE_ERROR'));
                }
            }else{
                $this->error($Menu->getError());
            }
        }
    }

    public function del(){
        if(IS_AJAX && IS_GET){
            $Menu = D('Menu');
            $alldata = $Menu->order('listorder,id')->select();
            $allmenu = new \Common\Lib\Tree($alldata);
            print_r($allmenu->get_all_childids(I('get.id')));exit;
            $result = $Menu->where('id='.I('get.id'))->delete();
            if($result !== FALSE){
                $this->success(L('DEL_OK'),U('Menu/index'));
            }else{
                $this->error(L('DEL_ERROR'));
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
    private function _write_lang($lang,$del = FALSE,$langpath = ''){
        if(!is_array($lang)){
            return FALSE;
        }
        $path = $langpath == '' ? MODULE_PATH.'Lang/'.LANG_SET.'/menu_common.php' : $langpath;
        $phpstar = '<?php'.PHP_EOL;
        $langdata = $phpstar;
        $langdata .= '$menu_common = array('.PHP_EOL;
        $menu_common = array();
        eval(str_replace($phpstar,'', read_file($path)));
        $arrdata = array_merge($menu_common, $lang);
        foreach ($arrdata as $key => $value){
            $langdata .= "    '$key' => '$value',".PHP_EOL;
        }
        $langdata .= ');';
        return write_file($path,$langdata);
    }
}
