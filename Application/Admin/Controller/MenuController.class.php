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
 * Description of MenuController
 * 后台管理菜单控制器类
 * @author itsky
 */
class MenuController extends AdminController{
    public function index() {
        if(!IS_AJAX) $this->error (L('_ERROR_ACTION_'));
        $Menu = D('Menu');
        $allmenu = $Menu->order('listorder,id')->select();
        foreach ($allmenu as $value){
            $staop = array('id'=>$value['id'],'status'=>$value['status']);
            $allow = '<a class="btn btn-success btn-minier" href="'.U('Menu/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ok"></span></a>';
            $ban = '<a class="btn btn-danger btn-minier" href="'.U('Menu/status',$staop).'" onclick="load(event,this)"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            $value['status'] = $value['status'] ? $allow : $ban;
            $value['name'] = $value['icon'] ? '<span class="'.$value['icon'].'"></span> '.L($value['name']) : L($value['name']);
            $value['oper'] = '<a class="btn btn-primary btn-minier" href="'.U('Menu/add',array('id'=>$value['id'])).'" onclick="load(event,this)"><span class="glyphicon glyphicon-plus"></span></a> ';
            $value['oper'] .= '<a class="btn btn-success btn-minier" href="'.U('Menu/edit',array('id'=>$value['id'])).'" onclick="load(event,this)"><span class="glyphicon glyphicon-edit"></span></a> ';
            $value['oper'] .= '<a class="btn btn-danger btn-minier" href="'.U('Menu/del',array('id'=>$value['id'])).'" onclick="del(event,this,\'p\')"> <span class="glyphicon glyphicon-trash"></span> </a> ';
            $narr[] = $value;
        }
        $tree = new \Common\Lib\Tree($narr);
        $str = "<tr><td class='center'><input type='text' maxlength='3' name='listorder[\$id]' value='\$listorder' data-rule='integer[+0]'/></td>";
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
                    'listorder' => 99
                );
                if($Menu->add($data)){
                    $rname = I('post.realname');
                    write_lang(array($data['name']=>$rname[LANG_SET]),'menu_common');
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
            $str  = "<li data-val='\$id'>\$spacer\$name</li>";
            $pid = I('get.id') ? I('get.id') : 0;
            $this->assign('pid', $pid);
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
            $str  = "<li data-val='\$id'>\$spacer\$name</li>";
            $this->assign('pid', $vo['pid']);
            $this->assign('map', $tree->get_tree(0, $str));
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
                    'listorder' => I('post.listorder')
                );
                $result = $Menu->where('id='.I('post.id'))->save($data);
                if($result !== FALSE){
                    $rname = I('post.realname');
                    write_lang(array($data['name']=>$rname[LANG_SET]),'menu_common');
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
            $cids = $allmenu->get_all_childids(I('get.id'));
            if($cids){
                $ids = I('get.id').','.implode(',', $cids);
            }else{
                $ids = I('get.id');
            }
            $isos = $Menu->where('id IN ('.$ids.') AND isos=1')->select();
            if($isos){
                $this->error(L('ISOS_ERROR'));
            }
            $result = $Menu->where('id IN ('.$ids.')')->delete();
            if($result !== FALSE){
                $this->success(L('DEL_OK'),U('Menu/index'));
            }else{
                $this->error(L('DEL_ERROR'));
            }
        }else{
            $this->error(L('_ERROR_ACTION_'));
        }
    }
}
