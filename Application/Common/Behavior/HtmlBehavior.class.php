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
use Think\Storage;
use Common\Lib\Jsmin;
use Common\Lib\Cssmin;
/**
 * Description of HtmlBehavior
 * 去除模板文件里面的html空格与换行行为扩展
 * @author itsky
 */
class HtmlBehavior extends \Think\Behavior{
    public function run(&$content) {
        if(C('TMPL_STRIP_SPACE')){
            preg_match_all("/<script[\s\S]*?>([\s\S]*?)<\/script>/i", $content, $scripta);
            preg_match_all("/<style[\s\S]*?>([\s\S]*?)<\/style>/i", $content, $stylea);
            $comhtml = $this->delHtml($content);
            preg_match_all("/<script[\s\S]*?>([\s\S]*?)<\/script>/i", $comhtml, $scriptb);
            preg_match_all("/<style[\s\S]*?>([\s\S]*?)<\/style>/i", $comhtml, $styleb);
            foreach ($stylea[0] as $k=>$v){
                $cssmin[$k] = Cssmin::minify($v);
            }
            foreach ($scripta[0] as $key=>$value){
                if(empty(Jsmin::minify($scripta[1][$key]))){
                    $jsmin[$key] = $scriptb[0][$key];
                }else{
                    $jsmin[$key] = Jsmin::minify($value);
                }
            }
            $content = str_replace($scriptb[0], $jsmin, $comhtml);
            $content = str_replace($styleb[0], $cssmin, $content);
            if (C('HTML_CACHE_ON') && defined('HTML_FILE_NAME')
                && !preg_match('/Status.*[345]{1}\d{2}/i', implode(' ', headers_list()))
                && !preg_match('/(-[a-z0-9]{2}){3,}/i',HTML_FILE_NAME)) {
                //静态文件写入
                Storage::put(HTML_FILE_NAME, $content, 'html');
            }
        }
    }

    public function delHtml($htmlstr){
        $htmlstr = str_replace(PHP_EOL, '', $htmlstr); //清除换行符
        $htmlstr = str_replace("\t", '', $htmlstr); //清除制表符
        $pattern = array (
            "/> *([^ ]*) *</", //去掉注释标记
            "/[\s]+/",
            "/<!--[^!]*-->/",
            //"/\" /",
            //"/ \"/",
            "'/\*[^*]*\*/'"
        );
        $replace = array (
            ">\\1<",
            " ",
            "",
            //"\"",
            //"\"",
            ""
        );
        return preg_replace($pattern, $replace, $htmlstr);
    }
}
