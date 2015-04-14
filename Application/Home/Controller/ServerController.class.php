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
namespace Home\Controller;
use Common\Controller\HproseController;
/**
 * Description of ServerController
 * 
 * @author itsky
 */
class ServerController extends HproseController{
    protected $allowMethodList  =   array();
    protected $crossDomain      =   true;
    protected $get              =   true;
    protected $p3p              =   true;
    //格式化时间、日期
    public function date($format,$timestamp='',$id='',$date=''){
        if(!empty($date)){
            $datearr = explode(',', $date);
            $timestamp = mktime($datearr[3], $datearr[4], $datearr[5], $datearr[1], $datearr[2], $datearr[0]);
        }
        if(empty($timestamp)) $timestamp = time();
        $result = array(
            'date' => date($format, $timestamp),
            'elem' => $id
        );
        return json_encode($result);
    }

    public function mktime($year='',$month='',$day='',$hour='',$minute='',$second='',$id=''){
        if(empty($year)) $year = date('Y');
        if(empty($month)) $month = date('n');
        if(empty($day)) $day = date('j');
        if($hour === '') $hour = date('H');
        if($minute === '') $minute = date('i');
        if($second === '') $second = date('s');
        $result = array(
            'timestamp' => mktime($hour,$minute,$second,$month,$day,$year),
            'elem' => $id
        );
        return json_encode($result);
    }
//    public function testa($aa=''){
//        return md5($aa);
//    }
//    public function testb(){
//        return FALSE;
//    }
//    public function testc($c){
//        return $c;
//    }
}
