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
 * Description of ModuleController
 * 模型控制器类
 * @author itsky
 */
class ModuleController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
//        $db = \Think\Db::getInstance();
//        $tables = $db->getTables();
//        dump($tables);
        $Module = D('Module');
        $list = $Module->where('type='.I('get.type'))->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        if(IS_POST){
            $Module = D('Module');
            if($Module->create()){
                $data = array(
                    'type' => I('post.type'),
                    'issystem' => I('post.issystem') ? 1 : 0,
                    'title' => strtoupper(I('post.name')).'_TITLE',
                    'name'  =>  ucfirst(I('post.name')),
                    'description' => strtoupper(I('post.name')).'_DESCRIPTION',
                    'lang' => I('post.lang')
                );
                $moduleid = $Module->add($data);
                if($moduleid){
                    $arrlang = array(
                        $data['title'] => I('post.title'),
                        $data['description'] => I('post.description')
                    );
                    write_lang($arrlang,'module_info');
                    $db = new \Think\Model();
                    $tablename = C('DB_PREFIX').strtolower($data['name']);
                    if($data['issystem']){
                        $sql = 'CREATE TABLE `'.$tablename.'` (';
                        $sql .= '`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'主键\',';
                        $sql .= 'PRIMARY KEY (`id`)';
                        $sql .= ') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=\''.$arrlang[$data['title']].'\';';
                        $db->execute($sql);
                        $ftable = C('DB_PREFIX').'field';
                        $langvar = strtoupper($data['name']).'_';
                        $insertsql = "INSERT INTO `".$ftable."` VALUES ";
                        $db->execute($insertsql."('',".$moduleid.",'catid','".$langvar."CATID','',1,0,0,'','','','catid','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'typeid','".$langvar."TYPEID','',1,0,0,'','','','typeid','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'title','".$langvar."TITLE','',1,0,0,'','','','title','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'keywords','".$langvar."KEYWORDS','',1,0,0,'','','','text','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'description','".$langvar."DESCRIPTION','',1,0,0,'','','','textarea','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'createtime','".$langvar."CREATETIME','',1,0,0,'','','','datetime','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'recommend','".$langvar."RECOMMEND','',1,0,0,'','','','radio','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'hits','".$langvar."HITS','',1,0,0,'','','','number','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'posid','".$langvar."POSID','',1,0,0,'','','','posid','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'template','".$langvar."TEMPLATE','',1,0,0,'','','','template','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'status','".$langvar."STATUS','',1,0,0,'','','','radio','',0,1,1);");
                    }else{
                        $sql = 'CREATE TABLE `'.$tablename.'` (';
                        $sql .= '`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'主键\',';
                        $sql .= '`status` tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'状态\',';
                        $sql .= '`userid` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'用户ID\',';
                        $sql .= '`url` varchar(60) NOT NULL DEFAULT \'\' COMMENT \'链接\',';
                        $sql .= '`listorder` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序\',';
                        $sql .= '`createtime` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'创建时间\',';
                        $sql .= '`updatetime` int(10) unsigned NOT NULL DEFAULT \'0\' COMMENT \'更新时间\',';
                        $sql .= '`lang` varchar(10) NOT NULL DEFAULT \'\' COMMENT \'语言\',';
                        $sql .= 'PRIMARY KEY (`id`)';
                        $sql .= ') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=\''.$arrlang[$data['title']].'\';';
                        $db->execute($sql);
                        $ftable = C('DB_PREFIX').'field';
                        $langvar = strtoupper($data['name']).'_';
                        $insertsql = "INSERT INTO `".$ftable."` VALUES ";
                        $db->execute($insertsql."('',".$moduleid.",'createtime','".$langvar."CREATETIME','',1,0,0,'','','','datetime','',0,1,1);");
                        $db->execute($insertsql."('',".$moduleid.",'status','".$langvar."STATUS','',1,0,0,'','','','radio','',0,1,1);");
                    }
                    $Menu = D('Menu');
                    $menudata = array(
                        'pid' => $data['type'] == 2 ? 25 : 18,
                        'model' => $data['name'],
                        'action' => 'index',
                        'status' => 1,
                        'name' => 'M_'.strtoupper($data['name']).'_INDEX',
                        'listorder' => 9
                    );
                    if($Menu->add($menudata)){
                        $menulang = array($menudata['name'] => $arrlang[$data['title']]);
                        write_lang($menulang,'menu_common');
                        $Rule = D('AuthRule');
                        $ruledata = array(
                            'tid' => $data['type'] == 2 ? 4 : 3,
                            'name' => $menudata['model'].'/index',
                            'title' => 'R_'.strtoupper($data['name']).'_INDEX',
                            'status' => 1
                        );
                        if($Rule->add($ruledata)){
                            $rulelang = array($ruledata['title']=>$arrlang[$data['title']]);
                            write_lang($rulelang,'rule_title');
                            $this->success(L('ADD_OK_'.$data['type']),U('Module/index','type='.$data['type'].'&'.$this->vl));
                        }else{
                            $this->error($Rule->getDbError());
                        }
                    }else{
                        $this->error($Menu->getDbError());
                    }
                }else{
                    $this->error(L('ADD_ERROR_'.$data['type']));
                }
            }else{
                $this->error($Module->getError());
            }
        }else{
            $this->display('edit');
        }
    }

    public function edit() {
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Module = D('Module');
        if(IS_POST){
            
        }else{
            $vo = $Module->where('id='.I('get.id'))->find();
            $this->assign('vo', $vo);
            $this->display();
        }
    }

    public function status(){
        if(IS_AJAX && IS_GET){
            $Module = D('Module');
            $data['status'] = I('get.status') ? 0 : 1;
            $result = $Module->where('id='.I('get.id'))->save($data);
            if($result !== FALSE){
                $this->redirect('Module/index','type='.I('get.type').'&'.$this->vl);
            }else{
                $this->error(L('STATUS_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }

    public function del(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $id = I('get.id');
        $Module = D('Module');
        $modata = $Module->where('id='.$id)->find();
        $delmo = $Module->where('id='.$id)->delete();
        if($delmo === FALSE) $this->error($Module->getDbError());
        $tablename = C('DB_PREFIX').$modata['name'];
        $db = new \Think\Model();
        $db->execute('DROP TABLE IF EXISTS `'.$tablename.'`;');
        M('Menu')->where('model=\''.ucfirst($modata['name']).'\'')->delete();
        M('Field')->where('mid='.$modata['id'])->delete();
        M('Content')->where('mid='.$modata['id'])->delete();
        $map['name'] = array('like',ucfirst($modata['name']).'%');
        M('AuthRule')->where($map)->select();
        $this->success(L('DEL_OK'),U('Module/index','type='.$modata['type'].'&'.$this->vl));
    }
}
