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
    /* 返回顶部 */
    $("#btn-scroll-up").hide();
    $(window).scroll(function(){
        if ($(window).scrollTop()>100){
                $("#btn-scroll-up").show();
        }else{
            $("#btn-scroll-up").hide();
        }
    });
    //ajax加载页面到主页面显示
    $('a.tarmain').click(function(e){
        $.get( $(this).attr('href'),function(data){
            if($.isPlainObject(data)){
                show_msg(data);
            }else{
                $('#new_content').html(data);
            }
        });
        $('#sidebar .nav-list li.active').removeClass('active');
        $('#sidebar .nav-list li.open').addClass('active');
        $('#sidebar .nav-list').find(this).parent('li').addClass('active');
        e.preventDefault();
    });
});

//弹出提示信息
function show_msg(data){
    if(data.status===0){
        $('#msg_modal .alert').addClass('alert-warning');
        $('#msg_modal .glyphicon').addClass('glyphicon-warning-sign');
    }else if(data.status===1){
        $('#msg_modal .alert').addClass('alert-success');
        $('#msg_modal .glyphicon').addClass('glyphicon-ok');
    }
    $('#msg_modal .info').text(data.info);
    $('#msg_modal').modal('show');
    setTimeout(function(){
        $('#msg_modal').modal('hide');
        if(data.url!==''){
            $('#new_content').load(data.url);
        }
    },2000);
}