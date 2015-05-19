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
 * Description of CategoryController
 * 栏目管理控制器类
 * @author itsky
 */
class CategoryController extends AdminController{
    public function index(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Cat = M('Category');
        $cats = $Cat->order('listorder,id')->select();
        $show = '<span class="green">'.L('SHOW').'</span>';
        $no_show = '<span class="red">'.L('NO_SHOW').'</span>';
        foreach ($cats as $value){
            $value['model'] = $value['module'] ? L($value['module'].'_TITLE') : L('OURL');
            $value['show'] = $value['isnav'] ? $show : $no_show;
            $url = $value['type'] == 1 ? $value['url'] : U('/'.$value['module'].'/index','id='.$value['id']);
            $value['visit'] = '<a href="'.$url.'" target="_blank">'.L('VISIT').'</a>';
            if($value['module'] == 'Page'){
                $value['monope'] = '<a class="btn btn-info btn-minier" ';
                $value['monope'] .= 'href="'.U($value['module'].'/edit',$this->vl.'&id='.$value['id']).'" ';
                $value['monope'] .= 'title="'.L('EDIT_CONTENT').'" onclick="load(event,this)">';
                $value['monope'] .= '<span class="glyphicon glyphicon-pencil"></span></a> ';
            }elseif($value['type'] == 1){
                $value['monope'] = '';
            }else{
                $value['monope'] = '<a class="btn btn-info btn-minier" ';
                $value['monope'] .= 'href="'.U($value['module'].'/add',$this->vl.'&id='.$value['id']).'" ';
                $value['monope'] .= 'title="'.L('ADD_CONTENT').'" onclick="load(event,this)">';
                $value['monope'] .= '<span class="glyphicon glyphicon-plus"></span></a> ';
            }
            $value['monope'] .= '<a class="btn btn-primary btn-minier" ';
            $value['monope'] .= 'href="'.U('Category/add',$this->vl.'&pid='.$value['id'].'&type='.$value['type']).'"';
            $value['monope'] .= ' title="'.L('ADD_CHILDREN').'" onclick="load(event,this)">';
            $value['monope'] .= '<span class="glyphicon glyphicon-plus-sign"></span></a> ';
            $value['monope'] .= '<a class="btn btn-success btn-minier" ';
            $value['monope'] .= 'href="'.U('Category/edit',$this->vl.'&id='.$value['id'].'&type='.$value['type']).'"';
            $value['monope'] .= ' title="'.L('EDIT').'" onclick="load(event,this)">';
            $value['monope'] .= '<span class="glyphicon glyphicon-edit"></span></a> ';
            $value['monope'] .= '<a class="btn btn-danger btn-minier" ';
            $value['monope'] .= 'href="'.U('Category/del',$this->vl.'&id='.$value['id']).'" ';
            $value['monope'] .= 'title="'.L('DELETE').'" onclick="del(event,this,\'p\')">';
            $value['monope'] .= '<span class="glyphicon glyphicon-trash"></span></a>';
            $narr[] = $value;
        }
        $tree = new \Common\Lib\Tree($narr);
        $tree->icon = array(
            '<span class="text-muted">&ensp;│&ensp;</span>',
            '<span class="text-muted">&ensp;├─</span>',
            '<span class="text-muted">&ensp;└─</span>'
        );
        $str = "<tr>";
        $str .= "<td class='center'>";
        $str .= "<input type='text' maxlength='3' name='listorder[\$id]' value='\$listorder' data-rule='integer[+0]'/>";
        $str .= "</td>";
        $str .= "<td class='center'>\$id</td>";
        $str .= "<td>\$spacer \$name</td>";
        $str .= "<td class='center'>\$model</td>";
        $str .= "<td class='center'>\$show</td>";
        $str .= "<td class='center'>\$visit</td>";
        $str .= "<td class='center'>\$monope</td>";
        $str .= "</tr>";
        $this->assign('cats', $tree->get_tree(0, $str));
        $this->display();
    }

    public function add(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Cat = D('Category');
        if(IS_POST){
            $post = I('post.','','trim');
            $posts = $Cat->create($post);
            if($posts){
                $Module = M('Module');
                $posts['module'] = $Module->getFieldById($post['mid'],'name');
                $posts['dir'] = $posts['dir'] ? $posts['dir'] : $posts['module'];
                $posts['lang'] = LANG_SET;
                $id = $Cat->add($posts);
                if($id){
                    if($posts['module'] == 'Page'){
                        $posts['id'] = $id;
                        if(empty($posts['title'])) $posts['title'] = $posts['name'];
                        $Page = D('Page');
                        if($Page->create($posts)){
                            $Page->add($posts);
                        }
                    }
                    $data['apid'] = $this->get_apid($id);
                    $data['acid'] = $id;
                    $Cat->where('id='.$id)->save($data);
                    $pids = explode(',', $data['apid']);
                    foreach ($pids as $pid){
                        $cids['acid'] = $this->get_acid($pid);
                        $Cat->where('id='.$pid)->save($cids);
                    }
                    $this->success(L('ADD_OK'),U('Category/index'));
                }else{
                    $this->error(L('ADD_ERROR'));
                }
            }else{
                $this->error($Cat->getError());
            }
        }else{
            $Module = M('Module');
            $modules = $Module->where('status=1 AND type=1')->select();
            $Urlrule = M('Urlrule');
            $rules = $Urlrule->where('ishtml=1')->order('listorder asc')->select();
            if(I('get.lang')){
                $l = I('get.lang');
            }elseif($this->clang){
                $l = $this->clang;
            }else{
                $l = LANG_SET;
            }
            $cats = $Cat->where('status=1 AND lang=\''.$l.'\'')->order('listorder')->select();
            $tree = new \Common\Lib\Tree($cats);
            $tree->icon = array(
                '<span class="text-muted">&ensp;│</span>',
                '<span class="text-muted">&ensp;├─</span>',
                '<span class="text-muted">&ensp;└─</span>'
            );
            $str  = "<li data-val='\$id'>\$spacer\$name</li>";
            $this->assign('cats', $tree->get_tree(0, $str));
            $this->assign('modules', $modules);
            $this->assign('urlrules', $rules);
            $this->display('edit');
        }
    }

    public function edit(){
        if(!IS_AJAX) $this->error(L('_ERROR_ACTION_'));
        $Cat = D('Category');
        if(IS_POST){
            print_r(I('post.'));
        }else{
            if(I('get.lang')){
                $l = I('get.lang');
            }elseif($this->clang){
                $l = $this->clang;
            }else{
                $l = LANG_SET;
            }
            $cats = $Cat->where('status=1 AND lang=\''.$l.'\'')->order('listorder')->select();
            $tree = new \Common\Lib\Tree($cats);
            $tree->icon = array(
                '<span class="text-muted">&ensp;│</span>',
                '<span class="text-muted">&ensp;├─</span>',
                '<span class="text-muted">&ensp;└─</span>'
            );
            $str  = "<li data-val='\$id'>\$spacer\$name</li>";
            $Module = M('Module');
            $modules = $Module->where('status=1 AND type=1')->select();
            $vo = $Cat->where('id='.I('get.id'))->find();
            $Urlrule = M('Urlrule');
            $rules = $Urlrule->where('ishtml=1')->order('listorder asc')->select();
            $this->assign('modules', $modules);
            $this->assign('cats', $tree->get_tree(0, $str));
            $this->assign('urlrules', $rules);
            $this->assign('vo', $vo);
            $this->display();
        }
    }

    private function get_apid($id,$apid = ''){
        $Cat = M('Category');
        $pid = $Cat->getFieldById($id,'pid');
        if($pid == 0){
            $apid = $apid ? $apid : $pid;
        }else{
            $apid = $apid ? $pid.','.$apid : $pid;
        }
        if($pid){
            $apid = $this->get_apid($pid, $apid);
        }
        return $apid;
    }

    private function get_acid($id){
        $acid = $id;
        $Cat = M('Category');
        $cats = $Cat->select();
        foreach ($cats as $catone){
            if($catone['pid'] && $id != $catone['id']){
                $apids = explode(',', $catone['apid']);
                if(in_array($id, $apids)) $acid .= ','.$catone['id'];
            }
        }
        return $acid;
    }
}
