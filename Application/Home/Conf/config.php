<?php
return array(
    //'配置项'=>'配置值'
    'TAGLIB_BEGIN' => '{',
    'TAGLIB_END' => '}',
    'HTML_CACHE_ON' => FALSE, //开启静态缓存
    'HTML_CACHE_TIME' => 10, //开启静态缓存有效期（秒）
    'TMPL_STRIP_SPACE' => TRUE, // 是否去除模板文件里面的html空格与换行
    'HTML_FILE_SUFFIX' => '.html', //设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(//定义静态缓存规则
        '*'=>array(auto_lang().'/{:module}_{:controller}_{:action}_{id}')
    )
);