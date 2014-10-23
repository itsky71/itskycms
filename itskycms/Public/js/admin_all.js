$(function(){
    /*  登录页面初始化选中用户名输入框  */
    $(".login_input").find("input[name=username]").focus();
    /*  点击刷新验证码  */
    var verifyimg = $(".verifyimg").attr("src");
    $('.verifyimg').click(function(){
        if( verifyimg.indexOf('?')>0){
            $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
        }else{
            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    });
    //验证输入信息，通过验证时不显示
//    $('#Public_login .n-ok').parent().hide();
});

