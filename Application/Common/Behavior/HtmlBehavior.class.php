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
namespace Common\Behavior;
/**
 * Description of HtmlBehavior
 * 去除模板文件里面的html空格与换行行为扩展
 * @author itsky
 */
class HtmlBehavior extends \Think\Behavior{
    public function run(&$content) {
        if(C('TMPL_STRIP_SPACE')){
            preg_match_all("/<script[\s\S]*?>([\s\S]*?)<\/script>/i", $content, $scripta);
            $comhtml = $this->delHtml($content);
            preg_match_all("/<script[\s\S]*?>([\s\S]*?)<\/script>/i", $comhtml, $scriptb);
            $content = str_replace($scriptb[0], $scripta[0], $comhtml);
        }
    }
    
    public function delHtml($htmlstr){
        $htmlstr = str_replace(PHP_EOL, '', $htmlstr); //清除换行符
        $htmlstr = str_replace("\t", '', $htmlstr); //清除制表符
        $pattern = array (
            "/> *([^ ]*) *</", //去掉注释标记
            "/[\s]+/",
            "/<!--[^!]*-->/",
            "/\" /",
            "/ \"/",
            "'/\*[^*]*\*/'"
        );
        $replace = array (
            ">\\1<",
            " ",
            "",
            "\"",
            "\"",
            ""
        );
        return preg_replace($pattern, $replace, $htmlstr);
    }
}
