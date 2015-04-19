/*********************************
 * Themes, rules, and i18n support
 * Locale: Chinese; 中文
 *********************************/
(function(factory) {
    if (typeof define === 'function') {
        define(function(require, exports, module){
            var $ = require('jquery');
            $._VALIDATOR_URI = module.uri;
            require('../src/jquery.validator')($);
            factory($);
        });
    } else {
        factory(jQuery);
    }
}(function($) {
    /* Global configuration
     */
    $.validator.config({
        //stopOnError: false,
        theme: 'red_right_effect',
        defaultMsg: "{0}格式不正确",
        loadingMsg: "正在验证...",
        timely:0,
        
        // Custom rules
        rules: {
            digits: [/^\d+$/, "请输入数字"]
            ,letters: [/^[a-z]+$/i, "{0}只能输入字母"]
            ,tel: [/^(?:(?:0\d{2,3}[\- ]?[1-9]\d{6,7})|(?:[48]00[\- ]?[1-9]\d{6}))$/, "电话格式不正确"]
            ,mobile: [/^1[3-9]\d{9}$/, "手机号格式不正确"]
            ,email: [/^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i, "邮箱格式不正确"]
            ,qq: [/^[1-9]\d{4,}$/, "QQ号格式不正确"]
            ,date: [/^\d{4}-\d{1,2}-\d{1,2}$/, "请输入正确的日期,例:yyyy-mm-dd"]
            ,time: [/^([01]\d|2[0-3])(:[0-5]\d){1,2}$/, "请输入正确的时间,例:14:30或14:30:00"]
            ,ID_card: [/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[A-Z])$/, "请输入正确的身份证号码"]
            ,url: [/^(https?|ftp):\/\/[^\s]+$/i, "网址格式不正确"]
            ,postcode: [/^[1-9]\d{5}$/, "邮政编码格式不正确"]
            ,chinese: [/^[\u0391-\uFFE5]+$/, "请输入中文"]
            ,username: [/^\w{3,20}$/, "请输入3-20位数字、字母、下划线"]
            ,password: [/^[0-9a-zA-Z]{6,20}$/, "密码由6-20位数字、字母组成"]
            ,verify: [/^[0-9a-zA-Z]{4}$/, "验证码由4位数字、字母组成"]
            ,zhendig:[/^[\u0391-\uFFE5a-zA-Z\d]+$/, "请输入中文、英文字母、数字"]
            ,enname:[/^\w+$/, "请输入字母、数字、下划线"]
            ,unchar:function(element){
                if(/[`~!@#$%^&*()_+<>?:"{},.\/;'[\]]+/g.test(element.value)){
                    return '包含非法字符';
                }
            }
            ,field: function (element, params){
                var type = $('[name="'+params[0]+'"]').val();
                var name = element.name.slice(6,-1);
                switch(type){
                    case 'title':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }
                        break;
                    case 'text':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 200 || '请最多输入200个字符';
                        }
                        break;
                    case 'textarea':
                        if(name == 'height' || name == 'width'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }
                        break;
                    case 'select':
                        if(name == 'options'){
                            var res = checkOpt(element.value);
                        }else if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 20 || '请最多输入20个字符';
                        }
                        break;
                    case 'editor':
                        if(name == 'height'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'alowuploadexts'){
                            var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正确';
                        }
                        break;
                    case 'radio':
                        if(name == 'options'){
                            var res = checkOpt(element.value);
                        }
                        break;
                    case 'checkbox':
                        if(name == 'options'){
                            var res = checkOpt(element.value);
                        }
                        break;
                    case 'image':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 50 || '请最多输入20个字符';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_allowext'){
                            var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正确';
                        }
                        break;
                    case 'images':
                        if(name == 'upload_maxnum'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_allowext'){
                            var leng = element.value.length;
                            if(leng > 50 ){
                                var res = '请最多输入5个字符';
                            }else{
                                var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正确';
                            }
                        }
                        break;
                    case 'file':
                        if(name == 'size'){
                            if(element.value.length > 1 && element.value.length < 5){
                                var res = '请输入2到4个字符';
                            }else{
                                var res = /^\d+$/.test(element.value) || '请输入数字';
                            }
                        }else if(name == 'default'){
                            if(element.value.length > 5 && element.value.length < 150){
                                var res = '请输入5到150个字符';
                            }
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_allowext'){
                            if(leng > 50 ){
                                var res = '请最多输入50个字符';
                            }else{
                                var res = element.value == '*' || /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正确';
                            }
                        }
                        break;
                    case 'files':
                        if(name == 'upload_maxnum'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'upload_allowext'){
                            if(leng > 50 ){
                                var res = '请最多输入50个字符';
                            }else{
                                var res = element.value == '*' || /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正确';
                            }
                        }
                        break;
                    case 'datetime':
                        if(name == 'default'){
                            // var res = /\S+/.test(element.value) || '呵呵...';
                            var leng = element.value.length;
                            var res = leng < 50 || '请最多输入50个字符';
                        }else if(name == 'dateformat'){
                            var leng = element.value.length;
                            var res = leng < 50 || '请最多输入50个字符';
                        }
                        break;
                    case 'number':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }else if(name == 'default'){
                            var numtype = $('[name="setup['+params[2]+']"]:checked').val();
                            var dec = $('[name="setup['+params[1]+']"]').val();
                            if(numtype == 1){
                                if(dec > 0){
                                    var decs = dec == 1 ? '' : ','+dec;
                                    var res = eval('/^\\d+(\\.\\d{1'+decs+'})?$/').test(element.value) || '格式不正确';
                                }else{
                                    var res = /^\d+$/.test(element.value) || '格式不正确';
                                }
                            }else{
                                if(dec > 0){
                                    var decs = dec == 1 ? '' : ','+dec;
                                    var res = eval('/^(-?)\\d+(\\.\\d{1'+decs+'})?$/').test(element.value) || '格式不正确';
                                }else{
                                    var res = /^(-?)\d+$/.test(element.value) || '格式不正确';
                                }
                            }
                        }
                        break;
                    case 'verify':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '请输入数字';
                        }
                        break;
                    default:
                        break;
                }
                return res;
            }
            ,accept: function (element, params){
                if (!params) return true;
                var ext = params[0];
                return (ext === '*') ||
                       (new RegExp(".(?:" + (ext || "png|jpg|jpeg|gif") + ")$", "i")).test(element.value) ||
                       this.renderMsg("只接受{1}后缀", ext.replace('|', ','));
            }
        }
    });

    function checkOpt(data){
        if($.trim(data) == ''){
            var res = '不能为空';
        }else{
            var lines = data.split("\n");
            var num = 0;
            var newarr = new Array;
            $.each(lines,function(index,value){
                if($.trim(value) != ''){
                    newarr[num] = $.trim(value);
                    num = num + 1;
                }
            });
            if(num < 2){
                var res = '请输入至少2个选项';
            }else{
                var numb = 0,numc = 0;
                $.each(newarr,function(index,value){
                    if(value.indexOf('|') < 1){
                        numc = numc + 1;
                    }else{
                        numb = numb + 1;
                    }
                });
                if(numc > 0){
                    var res = '格式不正确';
                }else{
                    if(numb < 0){
                        var res = '请输入至少2个选项';
                    }
                }
            }
        }
        return res;
    }
    /* Default error messages
     */
    $.validator.config({
        messages: {
            required: "{0}不能为空",
            remote: "{0}已被使用",
            integer: {
                '*': "请输入整数",
                '+': "请输入正整数",
                '+0': "请输入正整数或0",
                '-': "请输入负整数",
                '-0': "请输入负整数或0"
            },
            match: {
                eq: "{0}与{1}不一致",
                neq: "{0}与{1}不能相同",
                lt: "{0}必须小于{1}",
                gt: "{0}必须大于{1}",
                lte: "{0}必须小于或等于{1}",
                gte: "{0}必须大于或等于{1}"
            },
            range: {
                rg: "请输入{1}到{2}的数",
                gte: "请输入大于或等于{1}的数",
                lte: "请输入小于或等于{1}的数"
            },
            checked: {
                eq: "请选择{1}项",
                rg: "请选择{1}到{2}项",
                gte: "请至少选择{1}项",
                lte: "请最多选择{1}项"
            },
            length: {
                eq: "请输入{1}个字符",
                rg: "请输入{1}到{2}个字符",
                gte: "请至少输入{1}个字符",
                lte: "请最多输入{1}个字符",
                eq_2: "",
                rg_2: "",
                gte_2: "",
                lte_2: ""
            }
        }
    });

    /* Themes
     */
    var TPL_ARROW = '<span class="n-arrow"><b>◆</b><i>◆</i></span>';
    $.validator.setTheme({
        'simple_right': {
            formClass: 'n-simple',
            msgClass: 'n-right'
        },
        'simple_bottom': {
            formClass: 'n-simple',
            msgClass: 'n-bottom'
        },
        'yellow_top': {
            formClass: 'n-yellow',
            msgClass: 'n-top',
            msgArrow: TPL_ARROW
        },
        'yellow_right': {
            formClass: 'n-yellow',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW
        },
        'yellow_right_effect': {
            formClass: 'n-yellow',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW,
            msgStyle: 'position:absolute;top:0;right:0',
            msgShow: function($msgbox, type){
                var $el = $msgbox.children();
                if ($el.is(':animated')) return;
                if (type === 'error') {
                    $el.css({
                        left: '20px',
                        opacity: 0
                    }).delay(100).show().stop().animate({
                        left: '-4px',
                        opacity: 1
                    }, 150).animate({
                        left: '3px'
                    }, 80).animate({
                        left: 0
                    }, 80);
                } else {
                    $el.css({
                        left: 0,
                        opacity: 1
                    }).fadeIn(200);
                }
            },
            msgHide: function($msgbox, type){
                var $el = $msgbox.children();
                $el.stop().delay(100).show().animate({
                    left: '20px',
                    opacity: 0
                }, 300, function(){
                    $msgbox.hide();
                });
            }
        },
        'red_right_effect': {
            formClass: 'n-red',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW,
            msgStyle: 'position:absolute;',
            msgShow: function($msgbox, type){
                var $el = $msgbox.children();
                if ($el.is(':animated')) return;
                if (type === 'error') {
                    $el.css({
                        left: '20px',
                        opacity: 0
                    }).delay(100).show().stop().animate({
                        left: '-4px',
                        opacity: 1
                    }, 150).animate({
                        left: '3px'
                    }, 80).animate({
                        left: 0
                    }, 80);
                } else {
                    $el.css({
                        left: 0,
                        opacity: 1
                    }).fadeIn(200);
                }
            },
            msgHide: function($msgbox, type){
                var $el = $msgbox.children();
                $el.stop().delay(100).show().animate({
                    left: '20px',
                    opacity: 0
                }, 300, function(){
                    $msgbox.hide();
                });
            }
        }
    });
}));