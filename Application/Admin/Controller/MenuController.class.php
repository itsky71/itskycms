<?php
/**
 * Description of MenuController
 * 后台管理菜单控制器类
 * @author itsky
 */
namespace Admin\Controller;
class MenuController extends AdminController{
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
            import('@.Util.Tree');
            $map = $Menu->where('status=1')->select();
            $this->assign('map', $map);
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
