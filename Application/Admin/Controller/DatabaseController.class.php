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
            $total += $row['data_length'];
        }
        $this->assign('list', $list);
        $this->assign('totalsize', $total);
        $this->display();
    }
}
