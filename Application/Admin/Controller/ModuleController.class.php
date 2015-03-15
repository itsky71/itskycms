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
        $db = \Think\Db::getInstance();
        $tables = $db->getTables();
        dump($tables);
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
                    'description' => strtoupper(I('post.name')).'_DESCRIPTION'
                );
                if($Module->add($data)){
                    $arrlang = array(
                        $data['title'] => I('post.title'),
                        $data['description'] => I('post.description')
                    );
                    write_lang($arrlang,'module_info');
                    $db = new \Think\Model();
                    if($data['issystem']){
                        $sql = 'CREATE TABLE `'.C('DB_PREFIX').strtolower($data['name']).'` (';
                        $sql .= '`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'主键\',';
                        $sql .= 'PRIMARY KEY (`id`)';
                        $sql .= ') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=\''.$arrlang[$data['title']].'\';';
                        $db->execute($sql);
                    }else{
                        
                    }
                    $this->success(L('ADD_OK_'.$data['type']),U('Module/index','type='.$data['type'].'&'.$this->vl));
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
}
