$(function(){
    //滚动条样式
    $(document.body).scrollator();
    //判断:当前元素是否是被筛选元素的子元素
    $.fn.isChildOf = function(b){
        return (this.parents(b).length > 0);
    };
    //判断:当前元素是否是被筛选元素的子元素或者本身
    $.fn.isChildAndSelfOf = function(b){
        return (this.closest(b).length > 0);
    };
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
            $(document.body).scrollator('refresh');
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
                    $(document.body).scrollator('refresh');
                }
            }
        });
        $('#sidebar .nav-list li.active').removeClass('active');
        $('#sidebar .nav-list li.open').addClass('active');
        $('#sidebar .nav-list').find(this).parent('li').addClass('active');
        e.preventDefault();
    });
    //ajax请求开始时显示加载中样式
    $(document).ajaxStart(function(){
        $('#loading').removeClass('hide');
        $('#loadimg').removeClass('hide');
    });
    //ajax请求结束时结束加载中样式
    $(document).ajaxComplete(function(){
        $('#loading').addClass('hide');
        $('#loadimg').addClass('hide');
    });
    //ajax全局默认设置
    $.ajaxSetup({
        global:false
    });
    //侧栏导航style
    $('.nav-list li:first').addClass('active');
    $('.nav-list ul').addClass('submenu');
    //语言切换
    $('#navbar-container .btn-group .dropdown-menu li a').click(function(){
        $(this).parents('ul.dropdown-menu').prev('button.dropdown-toggle').children('.lang-qie').text($(this).text());
    });
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
        var msg = ITskyLang.DEL_MSG_ONE;
    }else if(a=='p'){
        var msg = ITskyLang.DEL_MSG_ALL;
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

//删除所选
function delcheck(e,t){
    e.preventDefault();
    var vid = new Array();
    $('input[name="id"]:checked').each(function(i){
        vid[i] = $(this).val();
    });
    if(vid == ''){
        show_msg($.parseJSON('{"info":"'+ITskyLang.DEL_CHECK_MSG+'","status":"0"}'));
        return false;
    }else{
        bootbox.confirm('<span class="glyphicon glyphicon-question-sign yellow bigger-120"></span>'+ITskyLang.DEL_CHECK_MSG_CONFIRM,function(result){
            if(result){
                $.ajax({
                    type:'post',
                    url:$(t).attr('href'),
                    global:true,
                    data:'ids='+vid.join(','),
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
}

//管理数据库表
function manope(e,t,o){
    e.preventDefault();
    var tables = new Array();
    $('input[name="table"]:checked').each(function(i){
        tables[i] = $(this).val();
    });
    if(tables == ''){
        show_msg($.parseJSON('{"info":"'+ITskyLang.CHECK_MSG+'","status":"0"}'));
        return false;
    }else{
        var msg = '';
        switch (o){
            case 'repair':
                msg = ITskyLang.REPAIR_CHECK_MSG_CONFIRM;
                break;
            case 'optimize':
                msg = ITskyLang.OPTIMIZATION_CHECK_MSG_CONFIRM;
                break;
            case 'check':
                msg = ITskyLang.CHECK_CHECK_MSG_CONFIRM;
                break;
            case 'analyze':
                msg = ITskyLang.ANALYZE_CHECK_MSG_CONFIRM;
                break;
            default :
                msg = '';
        }
        bootbox.confirm('<span class="glyphicon glyphicon-question-sign yellow bigger-120"></span>'+msg,function(result){
            if(result){
                $.ajax({
                    type:'post',
                    url:$(t).attr('href'),
                    global:true,
                    data:'tables='+tables.join(','),
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
}