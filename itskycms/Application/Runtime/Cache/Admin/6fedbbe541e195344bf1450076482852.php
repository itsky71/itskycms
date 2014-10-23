<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>后台管理</title>
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/tp/Public/bootstrap/css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="/tp/Public/bootstrap/css/bootstrap-theme.min.css" /><link rel="stylesheet" type="text/css" href="/tp/Public/validator/jquery.validator.css" /><link rel="stylesheet" type="text/css" href="/tp/Public/css/admin_all.css" />
<script type="text/javascript" src="/tp/Public/js/jquery.min.js"></script><script type="text/javascript" src="/tp/Public/bootstrap/js/bootstrap.min.js"></script><script type="text/javascript" src="/tp/Public/validator/jquery.validator.js"></script><script type="text/javascript" src="/tp/Public/validator/local/zh_CN.js"></script><script type="text/javascript" src="/tp/Public/js/admin_all.js"></script>
<script type="text/javascript">
    var ThinkPHP = {
        'ROOT' : '/tp',    //网站根目录地址
        'APP' : '/tp',  //当前应用（入口文件）地址
        'SELF' : '/tp/Admin',    //当前URL地址
        'PUBLIC' : '/tp/Public',    //项目公共目录地址
        'MODULE' : '<?php echo (MODULE_NAME); ?>',  //当前模块名
        'CONTROLLER' : '<?php echo (CONTROLLER_NAME); ?>',  //当前控制器名
        'ACTION' : '<?php echo (ACTION_NAME); ?>'   //当前操作名
    };
</script>
</head>
<body id="<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>">
<div class="main">
    
</div>
</body>
</html>