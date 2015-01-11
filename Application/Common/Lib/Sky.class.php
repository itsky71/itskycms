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
namespace Common\Lib;
use Think\Template\TagLib;
/**
 * Description of Sky
 * Sky标签库驱动
 * @author itsky
 */
class Sky extends TagLib{
    // 标签定义
    protected $tags = array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'db'      =>  array('attr'=>'table,where,order,limit,item,page,sql,field,key,mod,debug','level'=>3)
    );
    /**
     * 
     * @param type $tag
     * @param type $content
     * @return string
     */
    public function _db($tag,$content){
        $table  =   !empty($tag['table'])?$tag['table']:'';
        $order  =   !empty($tag['order'])?$tag['order']:'';
        $limit  =   !empty($tag['limit'])?intval($tag['limit']):'';
        $item     =   !empty($tag['item'])?$tag['item']:'';
        $where  =   !empty($tag['where'])?$tag['where']:' 1 ';
        $key    =   !empty($tag['key'])?$tag['key']:'i';
        $mod    =   !empty($tag['mod'])?$tag['mod']:'2';
        $page   =   !empty($tag['page'])?$tag['page']:FALSE;
        $sql    =   !empty($tag['sql'])?$tag['sql']:'';
        $field  =   !empty($tag['field'])?$tag['field']:'';
        $debug  =   !empty($tag['debug'])?$tag['debug']:FALSE;
        $this->comparison['noteq'] = '<>';
        $this->comparison['sqleq'] = '=';
        $where = $this->parseCondition($where);
        $sql = $this->parseCondition($sql);
        $parsestr .= '<?php $m=M("'.$table.'");';
        if($sql){
            if($page){
                $limit = $limit ? $limit : 10;//如果有page，没有输入limit则默认为10
                $parsestr .= '$count=count($m->query("'.$sql.'"));';
                $parsestr .= '$p=new \Think\Page($count,'.$limit.');';//分页类引用
                $parsestr .= '$sql.="'.$sql.'";';
                $parsestr .= '$sql.=" limit ".$p->firstRow.",".$p->listRows."";';
                $parsestr .= '$ret=$m->query($sql);';
                $parsestr .= '$pages=$p->show();';
            }else{
                $sql .= $limit ? (' limit '.$limit) : '';
                $parsestr .= '$ret=$m->query("'.$sql.'");';
            }
        }else{
            if($page){
                $limit = $limit ? $limit : 10;//如果有page，没有输入limit则默认为10
                $parsestr .= '$count=$m->where("'.$where.'")->count();';
                $parsestr .= '$p = new \Think\Page( $count, '.$limit.' );';
                $parsestr .= '$ret=$m->field("'.$field.'")->where("'.$where.'")->limit($p->firstRow.",".$p->listRows)->order("'.$order.'")->select();';
                $parsestr .= '$pages=$p->show();';
            }else{
                $parsestr .= '$ret=$m->field("'.$field.'")->where("'.$where.'")->order("'.$order.'")->limit("'.$limit.'")->select();';
            }
        }
        if($debug != FALSE){
            $parsestr .= 'dump($ret);dump($m->getLastSql());';
        }
        $parsestr .= 'if($ret): $'.$key.'=0;';
        $parsestr .= 'foreach($ret as $key=>$'.$item.'):';
        $parsestr .= '++$'.$key.';$mod = ($'.$key.' % '.$mod.' );?>';
        $parsestr .= $this->tpl->parse($content);
        $parsestr .= '<?php endforeach;endif;?>';
        return $parsestr;
    }
}
