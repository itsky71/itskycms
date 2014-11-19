<?php
/**
 * Description of Tree
 * 数类
 * @author itsky
 */
namespace Common\Lib;
class Tree {
    public $arr = array();
    public $icon = array('│','├','└');
    public $nbsp = "&nbsp;";
    public $ret = '';
    public $level = 0;
    /**
     * 将数组转换成树形
     * @param array $arr 输入数组
     * @return string
     */
    public function __construct($arr = array()) {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }

    public function getchild($bid){
        $arr = $newarr = array();
        if(is_array($this->arr)){
            foreach ($this->arr as $id => $arr){
                if($arr['pid'] == $bid) $newarr[$id] = $arr;
            }
        }
        return $newarr ? $newarr : FALSE;
    }

    /**
     * 获得树形字符串
     * @param number $bid 父ID
     * @param string $str 基础字符串
     * @param number $sid 默认选中ID
     * @param string $adds 每个数支添加的字符串
     * @param string $strgroup 分组字符串
     * @return string
     */
    public function get_tree($bid, $str, $sid = 0, $adds = '', $strgroup = ''){
        $number = 1;
        $child = $this->getchild($bid);
        if(is_array($child)){
            $total = count($child);
            foreach ($child as $id => $arr){
                $j = $k = '';
                if($number == $total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds.$j : '';
                extract($arr);
                if(empty($arr['selected'])){
                    $selected = $id == $sid ? 'selected' : '';
                }
                $pid == 0 && $strgroup ? eval("\$newstr = \"$strgroup\";") : eval("\$newstr = \"$str\";");
                $this->ret .= $newstr;
                $nbsp = $this->nbsp;
                $this->get_tree($id, $str, $sid, $adds.$k.$nbsp, $strgroup);
                $number++;
            }
        }
        return $this->ret;
    }
}
