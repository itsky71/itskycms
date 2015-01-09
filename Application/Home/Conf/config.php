<?php
return array(
    //'配置项'=>'配置值'
    'HTML_CACHE_ON' => FALSE, //开启静态缓存
    'HTML_CACHE_TIME' => 60, //开启静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.phtml', //设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(//定义静态缓存规则
        '*'=>array('{:module}_{:controller}_{:action}_{id|md5}')
    )
);