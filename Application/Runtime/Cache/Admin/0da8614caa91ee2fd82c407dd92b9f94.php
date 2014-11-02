<?php if (!defined('THINK_PATH')) exit();?><div class="col-sm-12">
    <div class="widget-box">
        <div class="widget-header header-color-green">
            <h4 class="lighter smaller">Browse Files</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main padding-8">
                <div id="menu-tree" class="tree"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/itskycms/Public/bootstrap/js/fuelux.tree.js"></script><script type="text/javascript" src="/itskycms/Public/bootstrap/js/fuelux.data.js"></script>
<script type="text/javascript">
    $('#menu-tree').ace_tree({
            dataSource: treeDataSource,
            loadingHTML:'<div class="tree-loading"><i class="glyphicon glyphicon-refresh icon-spin blue"></i></div>',
            'open-icon' : 'glyphicon-folder-open',
            'close-icon' : 'glyphicon-folder-close',
            'selectable' : false,
            'selected-icon' : null,
            'unselected-icon' : null
    });
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