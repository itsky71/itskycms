
$(function(){
    $('.select-click').off();
    $('[type="reset"]').off();
    //禁用
    $('.select-click.readonly input').attr('readonly',true);
    $('.select-click.readonly .select-input').css('background-color','#f5f5f5');
    aabb();
});
function aabb(){
   /*
    * select 标签样式
    */
   $('.select-click input').each(function(){
       var text = $('.select-option[data-name="'+$(this).attr('name')+'"] li[data-val="'+$(this).val()+'"]').text();
       $(this).parent('.select-click').find('.select-input').text(text);
   });
   //点击显示选项
   $('.select-click').on('click',function(e){
       if($(this).hasClass('readonly')) return false;
       $('.select-input').removeClass('no-border-right-color').next().removeClass('no-border-left-color');
       $(this).children('.select-input').addClass('no-border-right-color').next().addClass('no-border-left-color');
       var ul = $('.select-option[data-name="'+$(this).children('input').attr('name')+'"]').parent('.select-choices');
       if(ul.is(':hidden')){
           ul.find('li').removeClass('select-active');
           var defval = $(this).children('input').val();
           var there = ul.find('li[data-val="'+defval+'"]');
           there.addClass('select-active');
           $('.select-choices:visible').hide();
           ul.show();
           if(defval != ''){
               var lt = there.position();
               var maxheight = parseInt($(this).next().find('.select-choices').attr('data-height'));
               if(maxheight){
                   if(lt.top>(maxheight-10)) ul.scrollTop(lt.top-(maxheight-25));
               }else{
                   if(lt.top>420) ul.scrollTop(lt.top-400);
               }
           }
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
   $('.select-option li').on('click',function(e){
       var name = $(this).parent().attr('data-name');
       var value = $(this).attr('data-val');
       var text = $(this).text();
       $('input[name="'+name+'"]').val(value).parent('.select-click').find('.select-input').html(text);
       $(this).parent('ul').parent('.select-choices').scrollTop(0).hide();
       e.stopPropagation();
   });
   //点击其它空白处隐藏选项
   $(document).on('click',function(){
       $('.select-choices:visible').hide();
       $('.select-input').removeClass('no-border-right-color').next().removeClass('no-border-left-color');
   });
   //重置
   $('[type="reset"]').on('click',function(e){
       $(this).parents('form[role="form"]')[0].reset();
       $(this).parents('form[role="form"]').find('.select-click input').each(function(){
           var res = $(this).val();
           var name = $(this).attr('name');
           var text = $('.select-option[data-name="'+name+'"] li[data-val="'+res+'"]').text();
           $(this).nextAll('.select-input').text(text);
       });
       e.stopPropagation();
   });
}