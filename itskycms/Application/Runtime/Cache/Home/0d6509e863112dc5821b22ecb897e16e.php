<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>前台首页</title>
<script type="text/javascript" src="/tp/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    var ThinkPHP = {
        'ROOT' : '/tp',    //网站根目录地址
        'APP' : '/tp',  //当前应用（入口文件）地址
        'SELF' : '/tp/',    //当前URL地址
        'PUBLIC' : '/tp/Public',    //项目公共目录地址
        'MODULE' : '<?php echo (MODULE_NAME); ?>',  //当前模块名
        'CONTROLLER' : '<?php echo (CONTROLLER_NAME); ?>',  //当前控制器名
        'ACTION' : '<?php echo (ACTION_NAME); ?>'   //当前操作名
    };
</script>
</head>
<body id="<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>">
<div>Home模块</div>
</body>
</html>