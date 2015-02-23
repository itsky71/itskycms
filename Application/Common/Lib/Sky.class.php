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
        'db'    =>  array('attr'=>'table,where,order,limit,item,page,sql,field,key,mod,debug','level'=>3),
        'assign'    =>  array('attr'=>'name,value','close'=>0)
    );
    /**
     * 模板调用数据库的数据
     * 格式：<sky:db table="" where=""></sky:db>
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function _db($tag,$content){
        $table  =   !empty($tag['table'])?$tag['table']:'';
        $order  =   !empty($tag['order'])?$tag['order']:'';
        $limit  =   !empty($tag['limit'])?intval($tag['limit']):'';
        $item   =   !empty($tag['item'])?$tag['item']:'v';
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
            $fieldstr = $field ? '->field("'.$field.'")' : '';
            $wherestr = $where ? '->where("'.$where.'")' : '';
            $orderstr = $order ? '->order("'.$order.'")' : '';
            $limitstr = $limit ? '->limit("'.$limit.'")' : '';
            if($page){
                $limit = $limit ? $limit : 10;//如果有page，没有输入limit则默认为10
                $parsestr .= '$count=$m->where("'.$where.'")->count();';
                $parsestr .= '$p = new \Think\Page( $count, '.$limit.' );';
                $parsestr .= '$ret=$m'.$fieldstr.$wherestr.$orderstr.'->limit($p->firstRow.",".$p->listRows)->select();';
                $parsestr .= '$pages=$p->show();';
            }else{
                $parsestr .= '$ret=$m'.$fieldstr.$wherestr.$orderstr.$limitstr.'->select();';
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

    /**
     * assign标签解析
     * 在模板中给某个变量赋值 支持变量赋值 添加支持函数
     * 格式： <assign name="" value="" />
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _assign($tag,$content) {
        $name       =   $this->autoBuildVar($tag['name']);
        if('$'==substr($tag['value'],0,1)) {
            //$value  =   $this->autoBuildVar(substr($tag['value'],1));
            $varStr     =   trim(substr($tag['value'],1));
            if(!empty($varStr)){
                $varArray = explode('|',$varStr);
                //取得变量名称
                $var = array_shift($varArray);
                if('Think.' == substr($var,0,6)){
                    // 所有以Think.打头的以特殊变量对待 无需模板赋值就可以输出
                    $ming = $this->parseThinkVar($var);
                }elseif(FALSE !== strpos($var,'.')){
                    //支持 {$var.property}
                    $vars = explode('.', $var);
                    $var = array_shift($vars);
                    switch (strtolower(C('TMPL_VAR_IDENTIFY'))){
                        case 'array':// 识别为数组
                            $ming = '$'.$var;
                            foreach ($vars as $key=>$val)
                                $ming .= '["'.$val.'"]';
                            break;
                        case 'obj':// 识别为对象
                            $ming = '$'.$var;
                            foreach ($vars as $key=>$val)
                                $ming .= '->'.$val;
                            break;
                        default :// 自动判断数组或对象 只支持二维
                            $ming = 'is_array($'.$var.')?$'.$var.'["'.$vars[0].'"]:$'.$var.'->'.$vars[0];
                    }
                }elseif(FALSE !== strpos($var,'[')){
                    //支持 {$var['key']} 方式输出数组
                    $ming = '$'.$var;
                    preg_match('/(.+?)\[(.+?)\]/is',$var,$match);
                    $var = $match[1];
                }elseif(false !==strpos($var,':') && false ===strpos($var,'(') && false ===strpos($var,'::') && false ===strpos($var,'?')){
                    //支持 {$var:property} 方式输出对象的属性
                    $vars = explode(':',$var);
                    $var  =  str_replace(':','->',$var);
                    $name = "$".$var;
                    $var  = $vars[0];
                }else{
                    $ming = '$'.$var;
                }
                //对变量使用函数
                if(count($varArray)>0){
                    //$ming = parsev ($ming,$varArray);
                    //对变量使用函数
                    $length = count($varArray);
                    //取得模板禁止使用函数列表
                    $template_deny_funs = explode(',',C('TMPL_DENY_FUNC_LIST'));
                    for($i=0;$i<$length;$i++){
                        $args = explode('=',$varArray[$i],2);
                        //模板函数过滤
                        $fun = trim($args[0]);
                        switch ($fun){
                            case 'default':// 特殊模板函数
                                $ming = '(isset('.$ming.') && ('.$ming.' !== ""))?('.$ming.'):'.$args[1];
                                break;
                            default :// 通用模板函数
                                if(!in_array($fun,$template_deny_funs)){
                                    if(isset($args[1])){
                                        if(strstr($args[1],'###')){
                                            $args[1] = str_replace('###',$ming,$args[1]);
                                            $ming = "$fun($args[1])";
                                        }else{
                                            $ming = "$fun($ming,$args[1])";
                                        }
                                    }else if(!empty($args[0])){
                                        $ming = "$fun($ming)";
                                    }
                                }
                        }
                    }
                    $value = $ming;
                }
            }
        }elseif(':'==substr($tag['value'],0,1)){
            $value  =   substr($tag['value'],1);
        }else{
            $value  =   '\''.$tag['value']. '\'';
        }
        $parseStr   =   '<?php '.$name.' = '.$value.'; ?>';
        return $parseStr;
    }
}
