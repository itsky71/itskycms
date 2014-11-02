<?php if (!defined('THINK_PATH')) exit();?><div class="col-xs-6">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?php echo L('USERNAME');?>:</label>
            <div class="col-sm-9">
                <input type="hidden" value="<?php echo ($vo["id"]); ?>" name="id"/>
                <input type="text" class="col-xs-5" value="<?php echo ($vo["username"]); ?>" name="username"/>
            </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?php echo L('EMAIL');?>:</label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10" value="<?php echo ($vo["email"]); ?>" name="email"/>
            </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?php echo L('REALNAME');?>:</label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10" value="<?php echo ($vo["realname"]); ?>" name="realname"/>
            </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?php echo L('QUESTION');?>:</label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10" value="<?php echo ($vo["question"]); ?>" name="question"/>
            </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right"><?php echo L('ANSWER');?>:</label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10" value="<?php echo ($vo["answer"]); ?>" name="answer"/>
            </div>
        </div>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit">
                    <span class="glyphicon glyphicon-ok bigger-110"></span> <?php echo L('SUBMIT');?>
                </button>
                <button class="btn" type="reset">
                    <span class="glyphicon glyphicon-repeat bigger-110"></span> <?php echo L('RESET');?>
                </button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#breadcrumbs .breadcrumb .active').text('<?php echo L($Think.ACTION_NAME);?>');
    $('.page-header h1 small').text(' <?php echo L($Think.ACTION_NAME);?>');
    $('#sidebar .nav-list li.active').removeClass('active');
    $('#sidebar .nav-list li.open .submenu').hide();
    $('#sidebar .nav-list li.open').removeClass('open');
    $('#sidebar .nav-list li:first').addClass('active');
    $('form[role="form"]').validator({
        rules:{
            realname:[/^[\u0391-\uFFE5\w]+$/, "<?php echo L('JS_INPUT_INFO');?>"]
        },
        fields:{
            username:'required;username;remote[<?php echo U('Index/check');?>, id]',
            email:'required;email;remote[<?php echo U('Index/check');?>, id]',
            realname:'realname;length[3~20]',
            question:'length[3~30]',
            answer:'length[~30]'
        },
        valid:function(form){
            $.ajax({
                type: 'POST',
                url: '<?php echo U('Index/profile');?>',
                data:$(form).serialize(),
                success: function(data){
                    show_msg(data);
                }
            });
        }
    });
</script>