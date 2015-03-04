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
use Think\Model;
/**
 * Description of DatabaseController
 * 数据库管理控制器类
 * @author itsky
 */
class DatabaseController extends AdminController{
    public function index() {
        $db = new Model();
        $list = $db->query('SHOW TABLE STATUS LIKE \''.C('DB_PREFIX').'%\'');
        foreach ($list as $row){
            $total['size'] += $row['data_length'];
            $total['free'] += $row['data_free'];
            $total['rows'] += $row['rows'];
        }
        $total['tables'] = count($list);
        $this->assign('list', $list);
        $this->assign('total', $total);
        $this->display();
    }
    //修复表
    public function repair(){
        if(IS_AJAX && IS_POST){
            $sqltables = str_replace(',', '`, `', I('post.tables'));
            $sql = "REPAIR TABLE `".$sqltables."`";
            $db = new Model();
            $res = $db->query($sql);
            $this->assign('list',$res);
            $this->display('manope');
        }else{
            $this->error (L('_ERROR_ACTION_'));
        }
    }
    //优化表
    public function optimize(){
        if(IS_AJAX && IS_POST){
            $sqltables = str_replace(',', '`, `', I('post.tables'));
            $sql = "OPTIMIZE TABLE `".$sqltables."`";
            $db = new Model();
            $res = $db->query($sql);
            $this->assign('list',$res);
            $this->display('manope');
        }else{
            $this->error (L('_ERROR_ACTION_'));
        }
    }
    //检查表
    public function check(){
        if(IS_AJAX && IS_POST){
            $sqltables = str_replace(',', '`, `', I('post.tables'));
            $sql = "CHECK TABLE `".$sqltables."`";
            $db = new Model();
            $res = $db->query($sql);
            $this->assign('list',$res);
            $this->display('manope');
        }else{
            $this->error (L('_ERROR_ACTION_'));
        }
    }
    //分析表
    public function analyze(){
        if(IS_AJAX && IS_POST){
            $sqltables = str_replace(',', '`, `', I('post.tables'));
            $sql = "ANALYZE TABLE `".$sqltables."`";
            $db = new Model();
            $res = $db->query($sql);
            $this->assign('list',$res);
            $this->display('manope');
        }else{
            $this->error (L('_ERROR_ACTION_'));
        }
    }
    //表结构
    public function structure(){
        if(IS_AJAX && IS_POST){
            $tables = explode(',', I('post.tables'));
            $db = new Model();
            foreach ($tables as $value){
                $sqla = 'SELECT table_name as name,table_comment as comment FROM INFORMATION_SCHEMA.TABLES ';
                $sqla .= 'WHERE table_schema=\''.C('DB_NAME').'\' AND table_name=\''.$value.'\'';
                $header = $db->query($sqla);
                $tablesinfo[$value]['header'] = $header[0];
                $tablesinfo[$value]['fields'] = $db->query('SHOW FULL COLUMNS FROM '.$value.' FROM '.C('DB_NAME'));
                $sqlb = 'SELECT * FROM INFORMATION_SCHEMA.STATISTICS ';
                $sqlb .= 'WHERE table_schema=\''.C('DB_NAME').'\' AND table_name=\''.$value.'\'';
                $tablesinfo[$value]['index'] = $db->query($sqlb);
                $info = $db->query('SHOW TABLE STATUS FROM '.C('DB_NAME').' WHERE name=\''.$value.'\'');
                $tablesinfo[$value]['info'] = $info[0];
            }
            $this->assign('tablesinfo',$tablesinfo);
            $this->display();
        }else{
            $this->error (L('_ERROR_ACTION_'));
        }
        //$db = new Model();
//        $res = $db->query("SHOW FULL COLUMNS FROM ta_auth_group");
//        $res = $db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='tadmin'");
//        $res = $db->query("Row statistics");
        //dump($res);
    }
    //备份
    public function backup(){
        
    }
}
