<?php
/**
 * Description of IndexController
 * 后台首页控制器类
 * @author itsky
 */
namespace Admin\Controller;
class IndexController extends AdminController {
    public function index(){
        $Menu = M('Menu');
        $indexchild = $Menu->where('pid=1')->order('listorder,id')->select();
        $index = $Menu->where('id=1')->find();
        $list = $Menu->where('id<>1 AND pid<>1')->order('listorder,id')->select();
        foreach ($list as $item){
            $item['name'] = L($item['name']);
            $newarr[] = $item;
        }
        $tree = new \Common\Lib\Tree($newarr);
        $this->assign('indexchild', $indexchild);
        $this->assign('index', $index);
        $this->assign('list', $tree->get_treeview(0));
        $this->display();
    }
    //个人信息
    public function profile(){
        if(IS_POST){
            $Member = D('Member');
            if($Member->create()){
                $Member->save();
                $this->success('修改成功！',U('Index/profile'));
            }else{
                $this->error($Member->getError());
            }
        }else{
            $Member = M('Member');
            $vo = $Member->getById(session(C('USER_AUTH_KEY')));
            $this->assign('vo', $vo);
            $this->display();
        }
    }
    //验证用户名和邮箱的唯一性
    public function check(){
        $Member = D('Member');
        $res = $Member->checkFiledOne(I('post.'));
        if(!$res['res']){
            $data = array('error'=>L($res['vfiled']).'已被占用！');
            $this->ajaxReturn($data);
        }
    }
}