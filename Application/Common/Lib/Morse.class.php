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
/**
 * 将英文字符转换莫尔斯电码
 */
class Morse {
    //分割字符默认为空格
    protected $cut = ' ';
    //摩尔斯电码表
    private $_table = array(
        'A' => '·－',
        'B' => '－···',
        'C' => '－·－·',
        'D' => '－··',
        'E' => '·',
        'F' => '··－·',
        'G' => '－－·',
        'H' => '····',
        'I' => '··',
        'J' => '·－－－',
        'K' => '－·－',
        'L' => '·－··',
        'M' => '－－',
        'N' => '－·',
        'O' => '－－－',
        'P' => '·－－·',
        'Q' => '－－·－',
        'R' => '·－·',
        'S' => '···',
        'T' => '－',
        'U' => '··－',
        'V' => '···－',
        'W' => '·－－',
        'X' => '－··－',
        'Y' => '－·－－',
        'Z' => '－－··',
        '0' => '－－－－－',
        '1' => '·－－－－',
        '2' => '··－－－',
        '3' => '···－－',
        '4' => '····－',
        '5' => '·····',
        '6' => '－····',
        '7' => '－－···',
        '8' => '－－－··',
        '9' => '－－－－·',
        '.' => '·－·－·－',
        ':' => '－－－···',
        ',' => '－－··－－',
        ';' => '－·－·－·',
        '?' => '··－－··',
        '=' => '－···－',
        '\'' => '·－－－－·',
        '/' => '－··－·',
        '!' => '－·－·－－',
        '-' => '－····－',
        '_' => '··－－·－',
        '"' => '·－··－·',
        '(' => '－·－－·',
        ')' => '－·－－·－',
        '$' => '···－··－',
        '&' => '·－···',
        '@' => '·－－·－·',
        '+' => '·－·－·',
        '*' => '－－－－',
        '^' => '·－－·－',
        '#' => '··－－'
    );
    /**
     * 构造方法
     * @access public
     * @param string 分割字符
     */
    public function __construct($cut=''){
        $this->cut = empty($cut) ? $this->cut : $cut;
    }
    /**
     * 加密字符串
     * @param string 字符串
     * @return string 返回摩尔斯电码
     */
    public function encode($str){
        $upper_str = strtoupper($str);
        $split_arr = explode('æ', chunk_split($upper_str,1,'æ'));
        $morse_str = '';
        foreach ($split_arr as $value) {
            $morse_str .= $this->_table[$value].$this->cut;
        }
        return trim($morse_str);
    }
    /**
     * 解码字符串
     * @param string 摩尔斯电码
     * @return string 返回解码字符串
     */
    public function decode($morse){
        $morse_arr = explode($this->cut, $morse);
        $morse_flip = array_flip($this->_table);
        $str = '';
        foreach ($morse_arr as $value) {
            if($value === ''){
                $str .= ' ';
            }else{
                $str .= $morse_flip[$value];
            }
        }
        return $str;
    }
}