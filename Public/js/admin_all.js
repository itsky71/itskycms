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
        $.ajax({
            type:'get',
            url:$(this).attr('href'),
            global:true,
            success:function(data){
                if($.isPlainObject(data)){
                    show_msg(data);
                }else{
                    $('#new_content').html(data);
                }
            }
        });
        $('#sidebar .nav-list li.active').removeClass('active');
        $('#sidebar .nav-list li.open').addClass('active');
        $('#sidebar .nav-list').find(this).parent('li').addClass('active');
        e.preventDefault();
    });
    //ajax请求开始时显示加载中样式
    $('#loading').ajaxStart(function(){
        $(this).removeClass('hide');
    });
    //ajax请求结束时结束加载中样式
    $('#loading').ajaxComplete(function(){
        $(this).addClass('hide');
    });
    //ajax全局默认设置
    $.ajaxSetup({
        global:false
    });
    //侧栏导航style
    $('.nav-list li:first').addClass('active');
    $('.nav-list ul').addClass('submenu');
});

//弹出提示信息
function show_msg(data){
    $('#msg_modal .alert').removeClass('alert-warning').removeClass('alert-success');
    $('#msg_modal .glyphicon').removeClass('glyphicon-warning-sign').removeClass('glyphicon-ok');
    if(data.status == 1){
        $('#msg_modal .alert').addClass('alert-success');
        $('#msg_modal .glyphicon').addClass('glyphicon-ok');
    }else if(data.status == 0){
        $('#msg_modal .alert').addClass('alert-warning');
        $('#msg_modal .glyphicon').addClass('glyphicon-warning-sign');
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
//ajax页面加载ajax页面
function load(e,t){
    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(t).attr('href'),
        global:true,
        success:function(data){
            if($.isPlainObject(data)){
                show_msg(data);
            }else{
                $('#new_content').html(data);
            }
        }
    });
}
//删除记录
function del(e,t,a){
    e.preventDefault();
    if(a=='c'){
        var msg = ' 确定要删除吗?';
    }else if(a=='p'){
        var msg = ' 确定要删除该栏目及其所有子栏目吗?';
    }
    bootbox.confirm('<span class="glyphicon glyphicon-question-sign yellow"></span>'+msg,function(result){
        if(result){
            $.ajax({
                type:'get',
                url:$(t).attr('href'),
                global:true,
                success:function(data){
                    if($.isPlainObject(data)){
                        show_msg(data);
                    }else{
                        $('#new_content').html(data);
                    }
                }
            });
        }
    });
    $('.bootbox .modal-footer .btn').addClass('btn-sm');
    $('.bootbox .modal-dialog').addClass('modal-sm');
}