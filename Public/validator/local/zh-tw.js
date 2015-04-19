/*********************************
 * Themes, rules, and i18n support
 * Locale: Chinese; 中文; TW (Taiwan)
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
        defaultMsg: "{0}格式不正確",
        loadingMsg: "正在驗證...",
        timely:0,
        
        // Custom rules
        rules: {
            digits: [/^\d+$/, "請輸入數字"]
            ,letters: [/^[a-z]+$/i, "{0}只能輸入字母"]
            ,tel: [/^(?:(?:0\d{2,3}[\- ]?[1-9]\d{6,7})|(?:[48]00[\- ]?[1-9]\d{6}))$/, "電話格式不正確"]
            ,mobile: [/^1[3-9]\d{9}$/, "手機號碼格式不正確"]
            ,email: [/^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i, "郵箱格式不正確"]
            ,qq: [/^[1-9]\d{4,}$/, "QQ號格式不正確"]
            ,date: [/^\d{4}-\d{1,2}-\d{1,2}$/, "請輸入正確的日期,例:yyyy-mm-dd"]
            ,time: [/^([01]\d|2[0-3])(:[0-5]\d){1,2}$/, "請輸入正確的時間,例:14:30或14:30:00"]
            ,ID_card: [/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[A-Z])$/, "請輸入正確的身份證號碼"]
            ,url: [/^(https?|ftp):\/\/[^\s]+$/i, "網址格式不正確"]
            ,postcode: [/^[1-9]\d{5}$/, "郵政編碼格式不正確"]
            ,chinese: [/^[\u0391-\uFFE5]+$/, "請輸入中文"]
            ,username: [/^\w{3,20}$/, "請輸入3-20位數字、字母、下劃線"]
            ,password: [/^[0-9a-zA-Z]{6,16}$/, "密碼由6-16位數字、字母組成"]
            ,verify: [/^[0-9a-zA-Z]{4}$/, "驗證碼由4位數字、字母組成"]
            ,zhendig:[/^[\u0391-\uFFE5a-zA-Z\d]+$/, "請輸入中文、英文字母、數字"]
            ,enname:[/^\w+$/, "請輸入字母、數字、下劃線"]
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
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }
                        break;
                    case 'text':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 200 || '請最多輸入200個字符';
                        }
                        break;
                    case 'textarea':
                        if(name == 'height' || name == 'width'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }
                        break;
                    case 'select':
                        if(name == 'options'){
                            var res = checkOpt(element.value);
                        }else if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 20 || '請最多輸入20個字符';
                        }
                        break;
                    case 'editor':
                        if(name == 'height'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'alowuploadexts'){
                            var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正確';
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
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'default'){
                            var leng = element.value.length;
                            var res = leng < 50 || '請最多輸入20個字符';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_allowext'){
                            var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正確';
                        }
                        break;
                    case 'images':
                        if(name == 'upload_maxnum'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_allowext'){
                            var leng = element.value.length;
                            if(leng > 50 ){
                                var res = '請最多輸入5個字符';
                            }else{
                                var res = /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正確';
                            }
                        }
                        break;
                    case 'file':
                        if(name == 'size'){
                            if(element.value.length > 1 && element.value.length < 5){
                                var res = '請輸入2到4個字符';
                            }else{
                                var res = /^\d+$/.test(element.value) || '請輸入數字';
                            }
                        }else if(name == 'default'){
                            if(element.value.length > 5 && element.value.length < 150){
                                var res = '請輸入5到150個字符';
                            }
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_allowext'){
                            if(leng > 50 ){
                                var res = '請最多輸入5個字符';
                            }else{
                                var res = element.value == '*' || /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正確';
                            }
                        }
                        break;
                    case 'files':
                        if(name == 'upload_maxnum'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_maxsize'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'upload_allowext'){
                            if(leng > 50 ){
                                var res = '請最多輸入5個字符';
                            }else{
                                var res = element.value == '*' || /^[0-9a-zA-Z,]{1,100}$/.test(element.value) || '格式不正確';
                            }
                        }
                        break;
                    case 'datetime':
                        if(name == 'default'){
                            // var res = /\S+/.test(element.value) || '呵呵...';
                            var leng = element.value.length;
                            var res = leng < 50 || '請最多輸入50個字符';
                        }else if(name == 'dateformat'){
                            var leng = element.value.length;
                            var res = leng < 50 || '請最多輸入50個字符';
                        }
                        break;
                    case 'number':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
                        }else if(name == 'default'){
                            var numtype = $('[name="setup['+params[2]+']"]:checked').val();
                            var dec = $('[name="setup['+params[1]+']"]').val();
                            if(numtype == 1){
                                if(dec > 0){
                                    var decs = dec == 1 ? '' : ','+dec;
                                    var res = eval('/^\\d+(\\.\\d{1'+decs+'})?$/').test(element.value) || '格式不正確';
                                }else{
                                    var res = /^\d+$/.test(element.value) || '格式不正確';
                                }
                            }else{
                                if(dec > 0){
                                    var decs = dec == 1 ? '' : ','+dec;
                                    var res = eval('/^(-?)\\d+(\\.\\d{1'+decs+'})?$/').test(element.value) || '格式不正確';
                                }else{
                                    var res = /^(-?)\d+$/.test(element.value) || '格式不正確';
                                }
                            }
                        }
                        break;
                    case 'verify':
                        if(name == 'size'){
                            var res = /^\d+$/.test(element.value) || '請輸入數字';
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
                       this.renderMsg("只接受{1}後綴", ext.replace('|', ','));
            }
        }
    });

    function checkOpt(data){
        if($.trim(data) == ''){
            var res = '不能為空';
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
                var res = '請輸入至少2個選項';
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
                    var res = '格式不正確';
                }else{
                    if(numb < 0){
                        var res = '請輸入至少2個選項';
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
            required: "{0}不能為空",
            remote: "{0}已被使用",
            integer: {
                '*': "請輸入整數",
                '+': "請輸入正整數",
                '+0': "請輸入正整數或0",
                '-': "請輸入負整數",
                '-0': "請輸入負整數或0"
            },
            match: {
                eq: "{0}與{1}不一致",
                neq: "{0}與{1}不能相同",
                lt: "{0}必須小於{1}",
                gt: "{0}必須大於{1}",
                lte: "{0}必須小於或等於{1}",
                gte: "{0}必須大於或等於{1}"
            },
            range: {
                rg: "請輸入{1}到{2}的數",
                gte: "請輸入大於或等於{1}的數",
                lte: "請輸入小於或等於{1}的數"
            },
            checked: {
                eq: "請選擇{1}項",
                rg: "請選擇{1}到{2}項",
                gte: "請至少選擇{1}項",
                lte: "請最多選擇{1}項"
            },
            length: {
                eq: "請輸入{1}個字符",
                rg: "請輸入{1}到{2}個字符",
                gte: "請至少輸入{1}個字符",
                lte: "請最多輸入{1}個字符",
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