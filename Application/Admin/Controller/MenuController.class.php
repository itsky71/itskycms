<?php
/**
 * Description of MenuController
 * 后台管理菜单控制器类
 * @author itsky
 */
namespace Admin\Controller;
class MenuController extends AdminController{
    public function index() {
        $Menu = D('Menu');
        $allmenu = $Menu->order('listorder')->select();
        foreach ($allmenu as $item){
            $pcount = $Menu->where('pid='.$item['id'])->count();
            $cmenu = $Menu->where('pid='.$item['id'])->order('listorder')->select();
            if($pcount > 0){
                $treestr .= '<div class="tree-folder"> <div class="tree-folder-header"> ';
                $treestr .= '<i class="glyphicon glyphicon-chevron-right"></i> ';
                $treestr .= '<div class="tree-folder-name"> ';
                $treestr .= L($item['name']).'</div></div><div class="tree-folder-content hide">';
                foreach ($cmenu as $val){
                    $treestr .= '<div class="tree-item"><div class="tree-item-name">'.L($val['name']).'</div></div>';
                }
                $treestr .= '</div></div>';
            }elseif($pcount == 0 && $item['pid']==0){
                $treestr .= '<div class="tree-item"><div class="tree-item-name">'.L($item['name']).'</div></div>';
            }
        }
        $this->assign('mtree', $treestr);
        $this->display();
    }

    public function add(){
        $Menu = D('Menu');
        if(IS_POST){
            if($Menu->create()){
                $data = array(
                    'pid' => I('post.pid'),
                    'name' => 'M_'.strtoupper(I('post.model')).'_'.strtoupper(I('post.action') ? I('post.action') : 'index'),
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
            $map = $Menu->where('status=1')->select();
            foreach ($map as $r){
                $r['name'] = L($r['name']);
                $newmap[] = $r;
            }
            $tree = new \Common\Lib\Tree($newmap);
            $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";
            $this->assign('map', $tree->get_tree(0, $str));
            $this->display('edit');
        }
    }
    /**
     * 验证菜单
     */
    public function checkAction(){
        if(IS_POST){
            $Menu = D('Menu');
            $map = array(
                'model' => ucfirst(I('post.model')),
                'action' => I('post.action') ? strtolower(I('post.action')) : 'index'
            );
            $res = $Menu->where($map)->find();
            if($res){
                echo json_encode(array('error'=>L('ACTIONU')));
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
