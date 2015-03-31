<?php
return array(
    //'配置项'=>'配置值'
//    'DB_DEBUG' => TRUE,
    'TAGLIB_BEGIN' => '{',
    'TAGLIB_END' => '}',
    'HTML_CACHE_ON' => FALSE, //开启静态缓存
    'HTML_CACHE_TIME' => 10, //开启静态缓存有效期（秒）
    'TMPL_STRIP_SPACE' => TRUE, // 是否去除模板文件里面的html空格与换行
    'HTML_FILE_SUFFIX' => '.html', //设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(//定义静态缓存规则
        '*'=>array(auto_lang().'/{:module}_{:controller}_{:action}_{id}')
    ),
    'URL_ROUTER_ON' => TRUE,//开启URL路由
    'URL_ROUTE_RULES' => array(//路由规则
        'avatar/:id'=>'member/avatar/id/:1_small',
        '/^new\/(\d+)$/'        => 'Index/index?hehe=jeg_:1'
    ),
    'URL_MAP_RULES' => array(
        'new/top' => 'index/index'
    )
);