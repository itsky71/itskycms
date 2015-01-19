/*
 * select 标签样式
 */
$('.select-click input').each(function(){
    var text = $('.select-option[data-name="'+$(this).attr('name')+'"] li[data-val="'+$(this).val()+'"]').text();
    $(this).parent('.select-click').find('.select-input').text(text);
});
//点击显示选项
$('.select-click').click(function(e){
    $('.select-input').removeClass('no-border-right-color').next().removeClass('no-border-left-color');
    $(this).children('.select-input').addClass('no-border-right-color').next().addClass('no-border-left-color');
    var ul = $('.select-option[data-name="'+$(this).children('input').attr('name')+'"]').parent('.select-choices');
    if(ul.is(':hidden')){
        ul.find('li').removeClass('select-active');
        var there = ul.find('li[data-val="'+$(this).children('input').val()+'"]');
        there.addClass('select-active');
        $('.select-choices:visible').hide();
        ul.show();
        var lt = there.position();
        if(lt.top>420) ul.scrollTop(lt.top-400);
    }else{
        ul.scrollTop(0);
        ul.hide();
    }
    e.stopPropagation();
});
$('.select-option li').hover(function(e){
    $(this).parent().children('li').removeClass('select-active');
    $(this).toggleClass('select-active');
    e.stopPropagation();
});
//选择选项
$('.select-option li').click(function(e){
    var name = $(this).parent().attr('data-name');
    var value = $(this).attr('data-val');
    var text = $(this).text();
    $('input[name="'+name+'"]').val(value).parent('.select-click').find('.select-input').html(text);
    $(this).parent('ul').parent('.select-choices').scrollTop(0).hide();
    e.stopPropagation();
});
//点击其它空白处隐藏选项
$(document).click(function(){
    $('.select-choices:visible').hide();
    $('.select-input').removeClass('no-border-right-color').next().removeClass('no-border-left-color');
});
//重置
$('[type="reset"]').click(function(e){
    $(this).parents('form[role="form"]')[0].reset();
    $(this).parents('form[role="form"]').find('.select-click input').each(function(){
        var res = $(this).val();
        var name = $(this).attr('name');
        var text = $('.select-option[data-name="'+name+'"] li[data-val="'+res+'"]').text();
        $(this).nextAll('.select-input').text(text);
    });
    e.stopPropagation();
});