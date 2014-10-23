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
        'SELF' : '/tp/Admin/Public/login',    //当前URL地址
        'PUBLIC' : '/tp/Public',    //项目公共目录地址
        'MODULE' : '<?php echo (MODULE_NAME); ?>',  //当前模块名
        'CONTROLLER' : '<?php echo (CONTROLLER_NAME); ?>',  //当前控制器名
        'ACTION' : '<?php echo (ACTION_NAME); ?>'   //当前操作名
    };
</script>
</head>
<body id="<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>">
<div class="container">
    <div class="login_logo">
        <h1>
            <span class="glyphicon glyphicon-leaf green"></span>
            <span class="red">xxx</span>
            <span class="white">后台管理</span>
        </h1>
        <h4 class="blue">&COPY; 公司名称</h4>
    </div>
    <div class="login_box">
        <div class="login_body">
            <div class="login_main">
                <h4 class="blue">
                    <span class="glyphicon glyphicon-road green"></span>
                    请输入你的信息
                </h4>
                <form id="admin_login"><!--action="<?php echo U('Public/login');?>" method="post"-->
                    <label class="login_input">
                        <input type="text" name="username" placeholder="用户名/邮箱"/>
                        <span class="glyphicon glyphicon-user"></span>
                    </label>
                    <label class="login_input">
                        <input type="password" name="password" placeholder="密码" />
                        <span class="glyphicon glyphicon-lock"></span>
                    </label>
                    <label class="login_input">
                        <input type="text" name="verify" placeholder="验证码"/>
                        <img class="verifyimg" src="<?php echo U('Public/verify');?>" alt="验证码"/>
                    </label>
                    <div class="login_send">
                        <label class="inline">
                            <input type="checkbox" name="keep"/><span class="chb">记住我</span>
                        </label>
                        <button class="pull-right btn btn-sm btn-primary" type="submit">
                            <span class="glyphicon glyphicon-log-in"></span>
                            &emsp;登 录
                        </button>
                    </div>
                </form>
            </div>
            <div class="login_floot">
                <a class="forgot_pwd" href="#"><span class="glyphicon glyphicon-arrow-left"></span> 忘记密码</a>
                <a class="want_reg" href="#">我要注册 <span class="glyphicon glyphicon-arrow-right"></span></a>
            </div>
        </div>
    </div>
</div>
<div id="login_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="alert alert-warning" role="alert">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <span class="info"></span>
        </div>
    </div>
  </div>
</div>
<!--[if IE 8]>
<script type="text/javascript">
$(function(){
    $('.chb').toggle(function(){
        $(this).before('<b><span class="glyphicon glyphicon-ok"></span><input type="hidden" name="keep" value="on"/></b>');
    },function(){
        $(this).parent().find('b').remove();
    });
});
</script>
<style type="text/css">
.inline b{
    width:15px;
    height:15px;
    border:1px solid #c8c8c8;
    background-color:#fff;
    color: #32a3ce;
    font-size:10px;
    display:inline-block;
    margin-right:5px
}
</style>
<![endif]-->
<script type="text/javascript">
$('#admin_login').validator({
    rules:{
        loginName : function(element){
            return this.test(element, "username")===true || this.test(element, "email")===true || '请填写用户名或者邮箱';
        }
    },
    fields:{
        'username':'required;loginName',
        'password':'required;password',
        'verify':'required;verify'
    },
    valid : function(form){
        var me = this;
        me.holdSubmit();
        $.post('<?php echo U('Public/login');?>',$(form).serialize(),success,'json');
        function success(data){
            if(data.status){
                $('#login_modal .alert').removeClass('alert-warning').addClass('alert-success');
                $('#login_modal .glyphicon').removeClass('glyphicon-warning-sign').addClass('glyphicon glyphicon-ok');
                $('#login_modal .info').text(' '+data.info+'正在跳转，请稍后...');
                $('#login_modal').modal('show');
                setTimeout(function(){
                    window.location.href = data.url;
                },1000);
            }else{
                $('#login_modal .info').text(' '+data.info);
                $('#login_modal').modal('show');
                setTimeout(function(){
                    $('#login_modal').modal('hide');
                    var verifyimg = $(".verifyimg").attr("src");
                    if( verifyimg.indexOf('?')>0){
                        $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                    }else{
                        $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                    }
                    me.holdSubmit(false);
                    $(".login_input").find("input[name=verify]").focus();
                },1000);
            }
        }
    }
});
</script>
</body>
</html>