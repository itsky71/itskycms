<?php if (!defined('THINK_PATH')) exit();?><div>TODO write content</div>

<script type="text/javascript">
    var pan = '<li><a class="tarmain" href="<?php echo U(CONTROLLER_NAME.'/'.ACTION_NAME);?>"><?php echo L($Think.ACTION_NAME);?></a></li>\n\
<li class="active"><?php echo L('SHOW');?></li>';
    $('#breadcrumbs .breadcrumb li:gt(0)').remove();
    $('#breadcrumbs .breadcrumb').append(pan);
    $('.page-header h1').empty();
    $('.page-header h1').append('<?php echo L($Think.ACTION_NAME);?><small class="glyphicon glyphicon-chevron-right"> <?php echo L('SHOW');?></small>');
    
    
    $('a.tarmain').click(function(e){
        $.get( $(this).attr('href'),function(data){
            if($.isPlainObject(data)){
                show_msg(data);
            }else{
                $('#new_content').html(data);
            }
        });
        e.preventDefault();
    });
</script>